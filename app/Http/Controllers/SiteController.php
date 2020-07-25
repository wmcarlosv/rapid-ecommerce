<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\User;
use App\Order;
use DB;

class SiteController extends Controller
{
    public function index($type = NULL, $value = NULL){
    	$set_value = "";
    	if($type == NULL){
    		$products = Product::all();
    	}else if($type == 'category'){
    		$category_id = explode("-", $value)[1];
    		$products = Product::where('category_id','=',$category_id)->get();
    	}else if($type == 'search'){
    		$products = Product::where('name','LIKE','%'.$value.'%')->get();
    		$set_value = $value;
    	}
    	
    	$data = User::where('role','=','admin')->first();
    	$categories = Category::all();
    	return view('shop',['products' => $products, 'data' => $data, 'categories' => $categories,'value' => $set_value]);
    }

    public function save_order(Request $request){

    	$order = new Order();
    	$order->customer_order = $request->input('customer_name');
    	$order->customer_email = $request->input('customer_email');
    	$order->customer_phone = $request->input('customer_phone');
    	$order->total = $request->input('grandtotal');

    	if($order->save()){
    		return redirect()->route('site.home')->with('msg','success');
    	}else{
    		return redirect()->route('site.home')->with('msg','error');
    	}
    }
}
