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
        Schema::create('pagesettings', function (Blueprint $table) {
            $table->id();
            $table->string('contact_email')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('home')->default('1');
            $table->string('blog')->default('1');
            $table->string('faq')->default('1');
            $table->string('contact')->default('1');
            $table->string('category')->default('1');
            $table->string('arrival_section')->default('1');
            $table->string('our_services')->default('1');
            $table->string('popular_products')->default('1');
            $table->string('slider')->default('1');
            $table->string('section')->default('1');
            $table->string('flash_deal')->default('1');
            $table->string('deal_of_the_day')->default('1');
            $table->string('best_sellers')->default('1');
            $table->string('brands')->default('1');
            $table->string('top_big_trending')->default('1');
            $table->string('top_brand')->default('1');
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
        Schema::dropIfExists('pagesettings');
    }
};
