@extends('layouts.master')

@section('title', 'Kasa - FootShop!')

@section('products')
        <div class="col-lg-12">
        <!-- ko if: products().length == 0 -->
            <center>Twój koszyk jest pusty.</center>
        <!-- /ko -->
        <!-- ko ifnot: products().length == 0 -->
            <table class="table">
                <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Ilość</th>
                    <th>Cena</th>
                    <th>+</th>
                    <th>-</th>
                    <th>x</th>
                </tr>
                </thead>
                <tbody data-bind="foreach: products()">
                <tr>
                    <td data-bind="text: name"></td>
                    <td data-bind="text: qt"></td>
                    <td data-bind="text: price()*qt() + 'zł'"></td>
                    <td data-bind="click: increaseQt()">+</td>
                    <td data-bind="click: decreaseQt()">-</td>
                    <td data-bind="click: $parent.removeFromCart">X</td>
                </tr>
                </tbody>
            </table>

            <table class="table">
                <tr>
                    <td>
                        <p><b>Koszt zamówienia:</b> <span class="total" data-bind="text: subtotal"></span>zł</p>
                        Kod rabatowy: <input type="text" id="coupon_code" name="coupon_code">
                        <button type="submit" class="btn btn-primary" data-bind="click: addCouponCode()">Dodaj kod</button><br><br>
                        <form class="col-lg-9" method="POST" action="{{ route('order') }}">
                            {{ csrf_field() }}
                            <?php

                            $products = json_decode($_COOKIE['koszyk'], true);
                            $numItems = count($products);
                            $i = 0;
                            $productsIds = "";
                            $productsNames = "";
                            $price = 0;

                            foreach ($products as $product) {
                                if (++$i === $numItems) {
                                    $productsIds .= $product[0];
                                    $productsNames .= $product[1];
                                } else {
                                    $productsIds .= $product[0] . ", ";
                                    $productsNames .= $product[1] . ", ";
                                }
                                $price += (double)$product[3];
                            }

                            ?>
                            <input type="hidden" id="products_ids" name="products_ids[]" value="<?php echo $productsIds; ?>">
                            <input type="hidden" id="products_names" name="products_names[]" value="<?php echo $productsNames; ?>">
                            <input type="hidden" id="price" name="price" value="<?php echo $price; ?>">
                            <button @if(!session()->get('name')) disabled @endif class="btn btn-primary" type="submit" data-bind="click: eraseCookie('koszyk')">Złóż zamówienie</button>
                            @if(!session()->get('name')) <br> Zaloguj się, aby złożyć zamówienie! @endif
                        </form>

                    </td>
                </tr>
            </table>
        <!-- /ko -->
        </div>
@endsection