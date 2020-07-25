<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\User;
use App\Order;
use App\OrderProduct;
use DB;

class SiteController extends Controller
{
    public function index($type = NULL, $value = NULL){
    	$set_value = "";
        $category_id = '';
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
    	return view('shop',['products' => $products, 'data' => $data, 'categories' => $categories,'value' => $set_value, 'category_id' => $category_id]);
    }

    public function save_order(Request $request){

    	$data = User::where('role','=','admin')->first();
    	$errors = 0;
    	$whatsapp_message = "";
    	$pedido = "";

    	DB::beginTransaction();

    	$order = new Order();
    	$order->customer_order = $request->input('customer_name');
    	$order->customer_email = $request->input('customer_email');
    	$order->customer_phone = $request->input('customer_phone');
    	$order->total = $request->input('grandtotal');

    	$products = $request->input('order_details');

    	if($order->save()){
    		foreach($products as $product){
    			$expl = explode("#", $product);

    			$order_product = new OrderProduct();
    			$order_product->order_id = $order->id;
    			$order_product->product_id = $expl[0];
    			$order_product->qty = $expl[1];
    			$order_product->total = $expl[2];

    			if(!$order_product->save()){
    				$errors++;
    			}else{
    				$product = Product::findorfail($expl[0]);
    				$pedido.= $expl[1]." (".$product->uom->name.") de ".$product->name." as Precio de ".$product->prices." con un total de ".$expl[2]."%0a";
    			}
    		}
    		
    	}else{
    		$errors++;
    	}

    	if($errors > 0){
    		DB::rollback();
    		return redirect()->route('site.home')->with('msg','error');
    	}else{
    		DB::commit();
    		$whatsapp_message.="Nombre del Cliente: ".$order->customer_order."%0a";
    		$whatsapp_message.="Email del Cliente: ".$order->customer_email."%0a";
    		$whatsapp_message.="Telfono del Cliente: ".$order->customer_phone."%0a";
    		$whatsapp_message.="---------Pedido---------------%0a";
    		$whatsapp_message.=$pedido;
    		return redirect()->to('https://wa.me/'.$data->phone.'?text='.$whatsapp_message);
    		//return redirect()->route('site.home')->with('msg','success');	
    	}
    }
}
