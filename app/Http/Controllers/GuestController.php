<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(){
        $latest_products = Product::orderBy("created_at","desc")->limit(8)->get();
        return view("guest.home",compact('latest_products'));
    }

    public function product(Product $product){
        $related_products = Product::where("category_id",$product->category_id)
            ->where('id','<>',$product->id)
            ->orderBy("created_at","desc")->limit(4)->get();
        return view("guest.detail",compact('product','related_products'));
    }

    public function addToCart(Product $product,Request $request){
        $request->validate([
            "buy_qty"=>"required|numeric|min:1|max:".$product->qty
        ]);
        $buy_qty = $request->get("buy_qty");
        $product->buy_qty = $buy_qty;
        $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
        // kiem tra san pham da co trong gio hang hay chua
        $f =  true;
        foreach ($cart as $item){
            if($item->id == $product->id){
                $item->buy_qty += $buy_qty;
                $f= false;
                break;
            }
        }
        if($f)
            $cart[] = $product;

        session(["cart"=>$cart]);
        return redirect()->to("cart");
    }

    public function cart(){
        $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
        $grand_total = 0;
        $can_checkout = true;
        foreach ($cart as $item){
            $grand_total+= $item->price * $item->buy_qty;
            if($item->qty < $item->buy_qty){
                $can_checkout= false;
            }
        }
        return view("guest.cart",compact('cart','grand_total','can_checkout'));
    }

    public function removeItem(Product $product){
        $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
        foreach($cart as $key=>$item){
            if($item->id==$product->id){
                unset($cart[$key]);
            }
        }
        session(["cart"=>$cart]);
        return redirect()->to("cart");
    }
}
