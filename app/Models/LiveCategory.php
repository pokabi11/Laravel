<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveCategory extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        "name",
        "icon",
        "status"
    ];

    public function Products(){
        return $this->hasMany(LiveProduct::class);
    }
}
