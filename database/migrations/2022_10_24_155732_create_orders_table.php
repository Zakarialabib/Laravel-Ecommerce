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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->foreignId('shipping_id')->nullable()->constrained('shippings')->nullOnDelete();
            $table->foreignId('packaging_id')->nullable()->constrained('packagings')->nullOnDelete();
            $table->string('reference');
            $table->string('status')->default(true);
            $table->json('cart')->nullable();
            $table->string('delivery_method');
            $table->string('payment_method');
            $table->integer('totalQty')->default(false);
            $table->string('payment_status')->default(false);
            $table->text('order_note')->nullable();
            $table->json('products')->nullable();
            $table->decimal('total', 10, 2)->default(false);
            $table->decimal('subtotal', 10, 2)->default(false);
            $table->decimal('tax', 10, 2)->default(false);
            $table->string('shipping_name')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_zip')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_country')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
