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

            $table->string('header')->nullable();
            $table->string('footer')->nullable();
            $table->string('bottomBar')->nullable();
            $table->string('topHeader')->nullable();
            $table->string('bottomFooter')->nullable();
            
            $table->boolean('themeColor')->default(false);
            $table->boolean('popularProducts')->default(false);
            $table->boolean('flashDeal')->default(false);
            $table->boolean('bestSellers')->default(false);
            $table->boolean('topBrands')->default(false);
            
            $table->string('status')->default(true);
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
