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
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // this will store the payment gateway name (e.g. "cash_on_delivery", "stripe", "paypal")
            $table->string('description'); // this will store a description of the payment gateway
            $table->string('api_key')->nullable(); // this will store the API key for the payment gateway (if applicable)
            $table->string('api_secret')->nullable(); // this will store the API secret for the payment gateway (if applicable)
            $table->string('api_client_id')->nullable(); // this will store the API secret for the payment gateway (if applicable)
            $table->string('api_sandbox')->nullable(); // this will store the API secret for the payment gateway (if applicable)

            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_gatways');
    }
};
