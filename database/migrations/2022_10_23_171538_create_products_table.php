<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
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
            $table->string('price');
            $table->string('old_price')->nullable();
            $table->string('image');
            $table->text('gallery')->nullable();
            $table->string('code');
            $table->string('slug');
            $table->tinyInteger('stock_status')->default(true);
            $table->tinyInteger('status')->default(true);
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->tinyInteger('featured')->default(false);
            $table->tinyInteger('hot')->default(false);
            $table->tinyInteger('best')->default(false);
            $table->tinyInteger('top')->default(false);
            $table->tinyInteger('latest')->default(false);
            $table->tinyInteger('big')->default(false);
            $table->tinyInteger('trending')->default(false);
            $table->tinyInteger('sale')->default(false);
            $table->tinyInteger('is_discount')->default(false);
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
