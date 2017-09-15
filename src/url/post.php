<?php
if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
}

include '../conf/config.php';

require("./../lib/PayPal/vendor/autoload.php");
require("./../lib/PayPal/vendor/paypal/rest-api-sdk-php/sample/bootstrap.php");
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

if ( isset($_POST['Paypal']['Checkout']) ) {
    loginRequired();

    $cart = $pdo->prepare("SELECT * FROM `tb_cart` WHERE `user_id` = :user");
    $cart->execute(array(":user" => $_SESSION['user_id']));

    if ( $cart->rowCount() > 0 ) {
        $cart = $cart->fetchAll();

        $apiContext = new \PayPal\Rest\ApiContext(
          new \PayPal\Auth\OAuthTokenCredential(
            PAYPAL_CLIENT_ID,
            PAYPAL_CLIENT_SECRET
          )
        );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $itemArray = array();
        $subTotal = 0;
        $shipping = 0;
        $tax = 0;

        foreach ( $cart as $cartItem ) {

            $itemInfo = getItemInfo($cartItem['product_id']);

            $totalValue = getTotalValue($cartItem['product_id']);

            $item = new Item();
            $item->setName($itemInfo['product_name'])
                ->setCurrency('EUR')
                ->setQuantity($cartItem['quantity'])
                ->setSku($cartItem['product_id'])
                ->setPrice($totalValue);

            array_push($itemArray, $item);
            $subTotal += $totalValue * $cartItem['quantity'];
        }

        $itemList = new ItemList();
        $itemList->setItems($itemArray);

        $details = new Details();
        $details->setShipping($shipping)
            ->setTax($tax)
            ->setSubtotal($subTotal);
        
        $amount = new Amount();
        $amount->setCurrency("EUR")
            ->setTotal($subTotal + $shipping + $tax)
            ->setDetails($details);
        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment for User ". $_SESSION['username'] ."'s Cart")
            ->setInvoiceNumber(uniqid());
        
        $baseUrl = getBaseUrl();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
            ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
            $request = clone $payment;

            /*
            echo '<pre>';
            echo $payment;
            echo '</pre>';
            */

        try {
            $payment->create($apiContext);


            if ( $payment->state == "created" ) {

                $logPayment = $pdo->prepare("INSERT INTO `tb_paypal_payments` (id, token, state, cart, user, billing_address, shipping_address, payer_id, amount, invoice_number, create_time, update_time) VALUES (:id, :token, :state, :cart, :user, :billing_address, :shipping_address, :payer_id, :amount, :invoice_number, :create_time, :update_time)");
                $logPayment->execute(array(
                    ":id" => $payment->id ,
                    ":token" => '' ,
                    ":state" => $payment->state ,
                    ":cart" => "" ,
                    ":user" => $_SESSION['user_id'] ,
                    ":billing_address" => $_POST['Paypal']['BillingAddress'] ,
                    ":shipping_address" => $_POST['Paypal']['ShippingAddress'] ,
                    ":payer_id" => "" ,
                    ":amount" => "" ,
                    ":invoice_number" => "" ,
                    ":create_time" => $payment->create_time ,
                    ":update_time" => "" 
                    ));

                foreach ( $payment->links AS $links ) {
                    if ( $links->method == "REDIRECT" && $links->rel == "approval_url" ) {
                        header("Location: ". $links->href);
                    }
                }
            }
        } catch (Exception $ex) {
            //ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            //echo var_dump($ex);
            exit(1);
        }
        
        
    }
}

function loginRequired() {
    if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {

    } else {
        die();
    }
}
?>