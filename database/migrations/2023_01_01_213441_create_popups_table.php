<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create(config('laravelpopups.popup.table_name'), function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('width')->nullable();
            $table->string('background_color')->nullable();
            $table->string('frequency')->nullable();
            $table->string('timing')->nullable();
            $table->integer('delay')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('visits')->nullable();
            $table->text('content')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_default')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('laravelpopups.popup.table_name'));
    }
};
