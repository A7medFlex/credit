<?php

namespace App\Http\Controllers;

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function index(Request $request)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AQxXfn6MBY61taTTcds_0VnSKiYh1Z99ibG7Sc8iOZMkEh2yf0fj_8fywjb0GSE0LCD2s8SADN7BLqX1',     // ClientID
                'EILw7lrpyhSSFKQGimO_L3vRLDk_Gl8c7YupntcaggOClVYBIo-p13DsuXR_nKtbtZPCc1i-wRExLv_q'      // ClientSecret
            )
        );

        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal($request->money);
        $amount->setCurrency('USD');

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal-return'))
            ->setCancelUrl(route('paypal-cancel'));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($apiContext);
            echo $payment;

            echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";

            return redirect($payment->getApprovalLink());

        }
        catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            // echo $ex->getData();
            return redirect('/donation')->with('fail','failed donation');
        }

    }

    public function return()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AQxXfn6MBY61taTTcds_0VnSKiYh1Z99ibG7Sc8iOZMkEh2yf0fj_8fywjb0GSE0LCD2s8SADN7BLqX1',     // ClientID
                'EILw7lrpyhSSFKQGimO_L3vRLDk_Gl8c7YupntcaggOClVYBIo-p13DsuXR_nKtbtZPCc1i-wRExLv_q'      // ClientSecret
            )
        );
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try{
            $result = $payment->execute($execution, $apiContext);
            // dd($result->state);
            // dd($payment->payer);
            // here the payment passed so return him if approvied state
            // and else not aproved then return another page
            // dd($payment);
            if($payment->state == 'approved'){
                return redirect('/donation')->with('approved','approved donation');
            }else{
                return redirect('/donation')->with('notapproved','notapproved donation');
            }

        }catch (\PayPal\Exception\PaypalConnectionException $ex) {
            // catch means the payment fail
            return redirect('/donation')->with('fail','failed donation');
        }
    }
    public function cancel()
    {
        // if the person cancel the payment just return him
        return redirect('/donation')->with('cancel' ,'You canceled the donation');
    }
}
