<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLiveProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liveproducts', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("thumbnail")->nullable();
            $table->decimal("price",12,4)->default();
            $table->unsignedInteger("qty")->default(0);
            $table->text("description")->nullable();
            $table->string("unit",50);
            $table->boolean("status")->default(true);
            $table->unsignedBigInteger("category_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liveproducts');
    }
}
