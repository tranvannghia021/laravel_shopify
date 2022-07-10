<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductShopifysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shopifys', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_shopify')->nullable();
            $table->string('name_category')->nullable();
            $table->string('title');
            $table->text('body_html')->nullable();
            $table->string('vendor');
            $table->enum('status',['active','draft'])->default('active');
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
        Schema::dropIfExists('product_shopifys');
    }
}
