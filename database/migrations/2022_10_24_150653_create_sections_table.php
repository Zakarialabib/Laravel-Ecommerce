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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('image')->nullable();
            $table->text('featured_title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('label')->nullable();
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->string('bg_color')->nullable();
            $table->string('page')->nullable();
            $table->string('position')->nullable();
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
        Schema::dropIfExists('sections');
    }
};
