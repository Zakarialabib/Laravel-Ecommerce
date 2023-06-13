<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        PaymentGateway::insert([
            [
                'id'            => 1,
                'name'          => 'cash_on_delivery',
                'description'   => 'Pay with cash upon delivery',
                'api_key'       => null,
                'api_secret'    => null,
                'api_client_id' => null,
                'api_sandbox'   => null,
            ],
            [
                'id'            => 2,
                'name'          => 'stripe',
                'description'   => 'Pay with credit card using Stripe',
                'api_key'       => 'pk_test_123456',
                'api_secret'    => 'sk_test_123456',
                'api_client_id' => null,
                'api_sandbox'   => '1',
            ],
            [
                'id'            => 3,
                'name'          => 'paypal',
                'description'   => 'Pay with PayPal',
                'api_key'       => null,
                'api_secret'    => null,
                'api_client_id' => 'ABCDEFGHIJKLMNOP',
                'api_sandbox'   => '1',
            ],
            [
                'id'            => 4,
                'name'          => 'postpay',
                'description'   => 'Pay with PostPay',
                'api_key'       => null,
                'api_secret'    => null,
                'api_client_id' => 'ABCDEFGHIJKLMNOP',
                'api_sandbox'   => '1',
            ],
        ]);
    }
}
