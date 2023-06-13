<?php

declare(strict_types=1);

use App\Models\Order;
use App\Models\PaymentGateway;
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
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->index()->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(PaymentGateway::class)->index()->nullable()->constrained()->nullOnDelete();
            $table->decimal('amount', 8, 2); // this will store the payment amount
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('order_payments');
    }
};
