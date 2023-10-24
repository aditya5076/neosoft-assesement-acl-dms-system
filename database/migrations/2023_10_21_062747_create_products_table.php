<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->comment('Product Name ( Text Field )');
            $table->text('description')->comment('Product Description ( Textarea )');
            $table->integer('price')->comment('Product Price ( Number )');
            $table->string('image')->comment('Product Image ( Note: Image should be <= 2 Mb & should be accepted in only these formats -> jpeg, jpg, png )');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
