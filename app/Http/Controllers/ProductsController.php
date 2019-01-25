<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductsController extends Controller
{
    /**
     * Fetch last 6 products from database and display them.
     *
     * @param Product $products
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Product $products)
    {
        $products = $products->orderBy('created_at', 'desc')->take(6)->get();

        return view('index', compact('products'));
    }

    /**
     * Fetch all products from a specific category and display them.
     *
     * @param $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($category)
    {
        $category = Category::where('name', "{$category}")->first();
        $products = $category->products()->orderBy('created_at', 'desc')->get();

        return view('category', compact('products'));
    }


    /**
     * Fetch product from database and display it.
     *
     * @param $category
     * @param $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function product($category, $product)
    {
        $product = str_replace("-", " ", $product);
        $products = Product::where('name', 'LIKE', "{$product}")->first();
        return view('product', compact('products'));
    }
}
