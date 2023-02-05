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
        Schema::create('pagesettings', function (Blueprint $table) {
            $table->id();

            $table->boolean('topbar')->default(true);
            $table->boolean('bottombar')->default(true);
            
            $table->string('topheader')->nullable();
            $table->string('bottomfooter')->nullable();

            $table->string('component')->nullable();
            $table->string('status')->default(true);

            $table->boolean('popular_products')->default(false);
            $table->boolean('flash_deal')->default(false);
             $table->boolean('deal_of_the_day')->default(false);
             $table->boolean('best_sellers')->default(false);
              $table->boolean('brands')->default(false);
             $table->boolean('top_big_trending',)->default(false);
             $table->boolean('top_brand')->default(false);

            $table->foreignId('featured_banner_id')->nullable()->constrained('featured_banners')->nullOnDelete();
            $table->foreignId('page_id')->nullable()->constrained('pages')->nullOnDelete();
            $table->foreignId('language_id')->nullable()->constrained('languages')->nullOnDelete();

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
