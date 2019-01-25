<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Football Shop 2018</p>
    </div>
</footer>
<script src="https://blackrockdigital.github.io/startbootstrap-shop-homepage/vendor/jquery/jquery.min.js"></script>
<script src="https://blackrockdigital.github.io/startbootstrap-shop-homepage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.2/knockout-min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function eraseCookie(name) {
        document.cookie = name + '=; Max-Age=-99999999;';
    }

    var Product = function (id, name, price, quantity = 1) {
        this.id = ko.observable(id);
        this.name = ko.observable(name);
        this.qt = ko.observable(quantity);
        this.price = ko.observable(price);
        this.setQt = function (n) {
            this.qt(n);
        };

        this.increaseQt = function () {
            this.qt(this.qt() + 1);
        };

        this.decreaseQt = function () {
            if (this.qt() > 1) {
                this.qt(this.qt() - 1);
            }
        };

        this.getCount = ko.computed(function () {
            return this.qt();
        }, this);

        this.getFullPrice = ko.computed(function () {
            return this.price() * this.getCount();
        }, this);

    };

    var Cart = function (products) {
        var self = this;
        self.test = ko.observable(5);
        self.products = ko.observableArray(products);

        self.addProduct = function (product) {
            self.products().push(product);
        };

        self.removeFromCart = function () {
            console.log('removing from cart');
            self.products.remove(this);
            self.products.valueHasMutated();
        };

        self.subtotal = ko.computed(function () {
            var i = 0;
            var retval = 0.0;
            if (self.products().length < 1) {
                return retval;
            }
            for (; i < self.products().length; i++) {
                retval += self.products()[i].getFullPrice();
            }
            self.products.valueHasMutated();
            return retval;
        }, self);

        self.getProductCount = ko.computed(function () {
            var sum = 0;

            if (self.products().length < 1) {
                return sum;
            }

            for (var i in self.products()) {
                sum += self.products()[i].getCount();
            }
            self.products.valueHasMutated();
            return sum;

        }, self);

        self.newProductPrice = ko.observable(null);
        self.newProductQt = ko.observable(null);
        self.newProductName = ko.observable(null);

        self.addNewProduct = function () {
            self.addNewProductToList($(".card-id").text(), $(".card-title").text(), parseFloat($(".card-price").text()), 1);
            self.newProductPrice(null);
            self.newProductName(null);
            self.newProductQt(null);
        };


        self.addNewProductToList = function (id, name, price, qt) {
            var flaga=1;
            var prod=new Product(id, name, price, qt);
            for(var i in self.products()){
                if(prod.name() === self.products()[i].name()){
                    self.products()[i].increaseQt();
                    flaga=0;
                    break;
                }

            }
            if(flaga){
                self.products().push(prod);
            }
            self.products.valueHasMutated();
        };

        self.updateCookies = ko.computed(function () {
            var tmpArray = [];
            for (var i in this.products()) {
                tmpArray.push([this.products()[i].id(), this.products()[i].name(), this.products()[i].price(), this.products()[i].qt()]);
            }
            setCookie('koszyk', JSON.stringify(tmpArray));
        }, self);

        self.isReadyToAdd = ko.computed(function () {
            return self.newProductQt() !== null && self.newProductName() !== null && self.newProductPrice() !== null;
        }, self);
    };

    var products = [];
    var productList = getCookie('koszyk');
    if (productList) {
        var parsedProductList = JSON.parse(productList);
        for (var i in parsedProductList) {
            products.push(new Product(parsedProductList[i][0], parsedProductList[i][1], parsedProductList[i][2]));
        }
    }
    var cart = new Cart(products);

    ko.applyBindings(cart);

</script>
</body>
</html>