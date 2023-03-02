<?php

namespace App\Http\Controllers;

use App\Mail\MailOrder;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        foreach ($cart as $key=>$item){
            if($item->id == $product->id){
                unset($cart[$key]);
            }
        }
        session(["cart"=>$cart]);
        return redirect()->to("cart");
    }

    public function checkout(){
        $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
        $grand_total = 0;
        $can_checkout = true;
        foreach ($cart as $item){
            $grand_total+= $item->price * $item->buy_qty;
            if($item->qty < $item->buy_qty){
                $can_checkout= false;
            }
        }
        if(!$can_checkout && count($cart) > 0){
            return redirect()->to("cart");
        }
        return view("guest.checkout",compact('cart','grand_total'));
    }

    public function placeOrder(Request $request){
        $request->validate([
            "firstname"=> "required",
            "lastname"=> "required",
            "country"=> "required",
            "address"=> "required",
            "city"=> "required",
            "state"=> "required",
            "postcode"=> "required|numeric",
            "phone"=> "required",
            "email"=> "required",
        ]);
        $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
        $grand_total = 0;
        $can_checkout = true;
        foreach ($cart as $item){
            $grand_total+= $item->price * $item->buy_qty;
            if($item->qty < $item->buy_qty){
                $can_checkout= false;
            }
        }
        if(!$can_checkout && count($cart) > 0){
            return redirect()->to("cart");
        }
        $order = Order::create(
            [
                "grand_total"=> $grand_total,
                "status"=>Order::PENDING,
                "shipping_address"=>$request->get("address"),
                "telephone"=>$request->get("phone"),
                "fullname"=>$request->get("firstname"). $request->get("lastname"),
                "country"=>$request->get("country"),
                "city"=>$request->get("city"),
                "state"=>$request->get("state"),
                "postcode"=>$request->get("postcode"),
                "email"=>$request->get("email"),
                "note"=>$request->get("note"),
            ]
        );
        foreach ($cart as $item){
            DB::table("order_products")->insert([
                "order_id"=>$order->id,
                "product_id"=>$item->id,
                "qty"=>$item->buy_qty,
                "price"=>$item->price
            ]);
            $item->decrement("qty",$item->buy_qty);
        }
//        session()->forget("cart");
        Mail::to("hlong2k1@gmail.com")->send(new MailOrder($order));
        // to  checkout-success
        return redirect()->to("cart");
    }
}
