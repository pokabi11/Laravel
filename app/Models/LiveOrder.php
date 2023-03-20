<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveOrder extends Model
{
    use HasFactory;
    protected $table = "orders";

    protected $fillable = [
        "grand_total",
        "status",
        "shipping_address",
        "telephone",
        "fullname",
        "country",
        "city",
        "state",
        "postcode",
        "email",
        "note",
        "paid"
    ];
    const PENDING = 0;
    const CONFIRM = 1;
    const SHIPPING = 2;
    const COMPLETE = 3;
    const CANCEL = 4;
    const REFUND = 5;

    public function Products(){
        return $this -> belongsToMany(LiveProduct::class,"order_products") -> withPivot();
    }
}
