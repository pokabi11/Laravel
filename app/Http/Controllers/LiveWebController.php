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
        $
        return view("live.home");
    }
}
