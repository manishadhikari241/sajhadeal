<?php

namespace App\Http\Controllers\admin;

use App\Order;
use App\OrderPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PayPal\Api\InputFields;
use PayPal\Api\PaymentExecution;
use PayPal\Api\WebProfile;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Stripe\Error\Card;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use Symfony\Component\HttpFoundation\Session\Session;

class PaymentController extends Controller
{
    public function index($code){
        $order = Order::where('order_track',$code)->first();
        return view('front.payment.payment_page',compact('order'));
    }
    public function payment()
    {
        return view('admin.payment');
    }

    public function stripe_payment(Request $request)
    {
        dd($request);
    }

    public function test()
    {
        return view('front.payment.stripe');
    }

    public function test_post(Request $request,$order_id)
    {
//        dd($request->all());
        $order=Order::findOrFail($order_id);
//        dd($order);
//        $money = $request->price;
        // Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_Gg8eU9SYs3RXUeWjXTCaDyeG00QjZRQvrd');

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
        try {
            $charge = \Stripe\Charge::create([
                'amount' => $order->final_total*100,
                'currency' => 'usd',
                'description' => 'Description',
                'source' => $token,
                'statement_descriptor' => $order->order_track,
            ]);
//            dd($charge->id);
        } catch (Card $exception) {
            return redirect('/')->with('error', 'Your Credit Card has been declined');
        }
        $order_payment = new OrderPayment();
        $order_payment->order_id = $order->id;
        $order_payment->token = $charge->id;
        $order_payment->type = "Stripe";
        $order_payment->save();

        $order->paid = 1;
        $order->payment_id =$order_payment->id;
        $order->payment_date = date('Y-m-d');
        $order->save();
//        Make Cart EMPTY HERR

        return redirect('/user/orders')->with('success', 'Your Payment was Successful');

    }

//    paypal

    public function paypal(Request $request,$order_id)
    {
//            Get all the Cart Contents here
        $order = Order::findOrFail($order_id);
//        dd($order);
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
//                env('PAYPAL_CLIENT_ID'),
//                env('PAYPAL_SECRET_ID')
                'AT5r0phN62MB46-HjTfCOEUqC60LVaGkHYLNBjmZOlmJmP50aZmubdV10ZeZRlUJl0FUfM_Bry2TtJ--',
                'EBWsHt10-LNYbtUg0iEckVgGRojop68wHq-I2_sBJ2RvJ4ZzMgH-oFyHgAOC4kfy3YHJ_nYaw1sEPo-j'

            )
        );
        // Create new payer and method
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

// Set redirect URLs
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('process.paypal',$order_id))
            ->setCancelUrl(route('cancel.paypal'));

// Set payment amount
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($order->final_total);

// Set transaction object
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription($order->order_track);


//NO Shipping
        $inputFields=new InputFields();
        $inputFields->setNoShipping(1);

        //WebProfile
        $webProfile = new WebProfile();
        $webProfile->setName('test_1'.uniqid())->setInputFields($inputFields);

        $webProfileId= $webProfile->create($apiContext)->getId();

// Create the full payment object
        $payment = new Payment();
        $payment->setExperienceProfileId($webProfileId);
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($apiContext);

            // Get PayPal redirect URL and redirect the customer
             $approvalUrl = $payment->getApprovalLink();
//            $customer = ['nepal', 'pakistan'];
//            Session::put('customer', json_encode($customer));
            return redirect($approvalUrl);
            // Redirect the customer to $approvalUrl
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }
//        else{
//            return redirect('/')->with('message','InvalidActivity')
//}
    public function returnPaypal(Request $request,$order_id)
    {
// Get payment object by passing paymentId
        $order = Order::find($order_id);
        $order_payment = new OrderPayment();
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
//                env('PAYPAL_CLIENT_ID'),
//                env('PAYPAL_SECRET_ID')
                'AT5r0phN62MB46-HjTfCOEUqC60LVaGkHYLNBjmZOlmJmP50aZmubdV10ZeZRlUJl0FUfM_Bry2TtJ--',
                'EBWsHt10-LNYbtUg0iEckVgGRojop68wHq-I2_sBJ2RvJ4ZzMgH-oFyHgAOC4kfy3YHJ_nYaw1sEPo-j'

            )
        );
        $paymentId = $request->paymentId;
        $payment = Payment::get($paymentId, $apiContext);
        $payerId = $request->PayerID;
//        dd($payerId);
// Execute payment with payer ID
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
//        dd($execution);

        try {
            // Execute payment
            $result = $payment->execute($execution, $apiContext);
//            dd($result);
            if(isset($result) && strtolower($result->state == "approved")){
                $order_payment->token = $result->payer->payer_info->payer_id;
                $order_payment->order_id = $order_id;
                $order_payment->type = "Paypal";
                $order_payment->save();
            if($order_payment){
                $order->paid = 1;
                $order->payment_id = $order_payment->id;
                $order->payment_date = date('Y-m-d');
                $order->save();
                return redirect('/order_confirmed')->with(['track_code'=> $order->order_track],['success'=>'Payment Successfully Made']);
            }
            else{
                return redirect('/')->with('error', 'Invalid');

            }
            }else{
                return redirect('/')->with('error','Invalid');
            }


        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }

    public function cancelPayPal()
    {
    }
    public function best(){
        return view('admin.paypal');
    }
}
