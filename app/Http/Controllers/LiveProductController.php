<?php

namespace App\Http\Controllers;

use App\Models\LiveCategory;
use App\Models\LiveProduct;
use Illuminate\Http\Request;

class LiveProductController extends Controller
{
    public function list(Request $request){
        $search=$request->get("search");
        $category_id=$request->get("category_id");
        $orderColumn=$request->has("orderColumn")?$request->get("orderColumn"):"id";
        $sortBy=$request->has("sortBy")?$request->get("sortBy"):"desc";
        $data=LiveProduct::with("Category")->CategoryFilter($category_id)->Search($search)->orderBy($orderColumn,$sortBy)->paginate(20);
        $categories=LiveCategory::all();
        return view("")
    }
}
