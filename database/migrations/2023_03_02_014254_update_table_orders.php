<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string("fullname");
            $table->string("country");
            $table->string("city");
            $table->string("state");
            $table->string("postcode");
            $table->string("email");
            $table->string("note");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                "fullname",
                "country",
                "city",
                "state",
                "postcode",
                "email",
                "note"
            ]);
        });
    }
}
