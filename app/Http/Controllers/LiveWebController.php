<?php

namespace App\Http\Controllers;

class LiveWebController extends Controller
{
    public function home(){
        return view("homepage");
    }
}
