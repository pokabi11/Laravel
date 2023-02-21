<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function home(){
        $orders_count = Order::count();
        $orders_sum_grand_total = Order::sum("grand_total");
        $products_count = Product::count();
        $total_qty = DB::table("order_products")->sum("qty");

        $categories_data = Category::withCount("Products")->limit(6)->get();
        $category_names = [];
        $category_products_counts = [];
        foreach ($categories_data as $item){
            $category_names[] = $item->name;
            $category_products_counts[] = $item->products_count;
        }
        $category_names = json_encode($category_names);
        $category_products_counts = json_encode($category_products_counts);
        return view("welcome",compact('orders_count','orders_sum_grand_total',
        'products_count','total_qty','category_names','category_products_counts'));
    }

    public function aboutUs(){
        return view("about-us");
    }
}
