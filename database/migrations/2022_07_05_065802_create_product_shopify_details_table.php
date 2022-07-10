<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductShopifyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shopify_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_shopify_detail')->nullable();
            $table->integer('id_products_shopify');
            $table->integer('id_image_shopify');
            $table->string('title')->nullable();
            $table->integer('price')->default(0);
            $table->integer('quantity')->default(0);
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
        Schema::dropIfExists('product_shopify_details');
    }
}
