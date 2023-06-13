<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;

class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function payWithPaypal()
    {
        return view('front.checkout');
    }

    public function postPaymentWithPaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Watch')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(session()->get('checkout')['total']);

        $item_list = new ItemList();
        $item_list->setItems([$item_1]);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Test');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('status'))
            ->setCancelUrl(route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection Timeout');
                return Redirect::route('paywithpaypal');
            }
            \Session::put('error', 'Some Error occur');
            return Redirect::route('paywithpaypal');
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() === 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        \Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown Error');

        return Redirect::route('paywithpaypal');
    }
    public function getPaymentStatus(Request $request)
    {
        $payment_id = \Session::get('paypal_payment_id');
        \Session::forget('paypal_payment_id');

        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::route('paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() === 'approved') {
            \Session::put('success', 'Payment success');
            return Redirect::route('paywithpaypal');
        }
        \Session::put('error', 'Payment failed');
        return Redirect::route('paywithpaypal');
    }
}
