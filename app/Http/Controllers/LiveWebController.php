<?php

namespace App\Http\Controllers;

use App\Models\LiveCategory;
use App\Models\LiveOrder;
use App\Models\LiveProduct;
use Illuminate\Support\Facades\DB;

class LiveWebController extends Controller
{
    public function home(){
        $orders_count = LiveOrder::count();
        $orders_sum_grand_total = LiveOrder::sum("grand_total");
        $products_count = LiveProduct::count();
        $total_qty = DB::table("order_products") -> sum("qty");

        $categories_data = LiveCategory::withCount("Products")->limit(6)->get();
        $categories_names = [];
        $categories_products_counts = [];
        foreach ($categories_data as $item){
            $categories_names = $item -> name;
            $categories_products_counts[] = $item -> products_count;
        }
        $category_names= json_encode($categories_names);
        $category_products_counts= json_decode($category_products_counts);

        $productIds=DB::table("order_products")->groupBy("product_id")->select(DB::raw("product_id, sum(qty) as total_qty"))->orderBy("total_qty")->limit(5)->get()->pluck("product_id")->toArray();
        $bestsellers=LiveProduct::find($productIds);
        return view("live.home",compact("orders_count","orders_sum_grand_total","products_count","total_qty","category_names","category_products_counts"));
    }
}
