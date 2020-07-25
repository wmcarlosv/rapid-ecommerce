<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = DB::table('orders')->count();
        $products = DB::table('products')->count();
        $categories = DB::table('categories')->count();
        $orderss = Order::where('read','=','N')->get();

        return view('home',['orders' => $orders, 'products' => $products, 'categories' => $categories, 'orderss' => $orderss]);
    }
}
