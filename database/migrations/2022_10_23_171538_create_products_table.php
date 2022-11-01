<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->text('description');
            $table->float('price');
            $table->float('old_price')->nullable();
            $table->string('image');
            $table->text('gallery')->nullable();
            $table->string('code');
            $table->string('slug');
            $table->tinyInteger('status')->default(1);
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('hot')->default(0);
            $table->tinyInteger('best')->default(0);
            $table->tinyInteger('top')->default(0);
            $table->tinyInteger('latest')->default(0);
            $table->tinyInteger('big')->default(0);
            $table->tinyInteger('trending')->default(0);
            $table->tinyInteger('sale')->default(0);
            $table->tinyInteger('is_discount')->default(0);
            $table->date('discount_date')->nullable();
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
};
