<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLiveOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liveorders', function (Blueprint $table) {
            $table->id();
            $table->decimal("grand_total",12,4);
            $table->tinyInteger("status");
            $table->string("shipping_address");
            $table->string("telephone",20);

            $table->string("fullname");
            $table->string("country");
            $table->string("city");
            $table->string("state");
            $table->integer("postcode");
            $table->string("email");
            $table->string("note")->nullable();
            $table->boolean("paid")->default(false);
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
        Schema::dropIfExists('liveorders');
    }
}
