<?php 
if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
}

include '../conf/config.php';

require("./../lib/PayPal/vendor/autoload.php");
require("./../lib/PayPal/vendor/paypal/rest-api-sdk-php/sample/bootstrap.php");


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

// ### Approval Status
// Determine if the user approved the payment or not
if (isset($_GET['success']) && $_GET['success'] == 'true') {

    // Get the payment Object by passing paymentId
    // payment id was previously stored in session in
    // CreatePaymentUsingPayPal.php

    $apiContext = new \PayPal\Rest\ApiContext(
      new \PayPal\Auth\OAuthTokenCredential(
        PAYPAL_CLIENT_ID,
        PAYPAL_CLIENT_SECRET
      )
    );

    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);

    try {
        // Execute the payment
        // (See bootstrap.php for more on `ApiContext`)
        $result = $payment->execute($execution, $apiContext);

        try {
            $payment = Payment::get($paymentId, $apiContext);

            if ( $payment->state == "approved" ) {

                $updateLog = $pdo->prepare("UPDATE tb_paypal_payments SET cart = :cart, payer_id = :payer_id, amount = :amount, invoice_number = :invoice_number, update_time = :update_time, state = :state WHERE id = :id");
                $updateLog->execute(array(
                    ":cart" => $payment->cart ,
                    ":payer_id" => $payment->payer->payer_info->payer_id ,
                    ":amount" => $payment->transactions[0]->amount->total ,
                    ":invoice_number" => $payment->transactions[0]->invoice_number ,
                    ":update_time" => $payment->update_time ,
                    ":state" => $payment->state ,
                    ":id" => $payment->id 
                    ));

                $getCart = $pdo->prepare("SELECT * FROM tb_cart WHERE user_id = :id");
                $getCart->execute(array(":id" => $_SESSION['user_id']));

                if ( $getCart->rowCount() > 0 ) {
                    $cartItems = $getCart->fetchAll();

                    foreach ( $cartItems as $item ) {
                        $itemInfo = getItemInfo($item['product_id']);

                        $category = $pdo->prepare("SELECT category FROM categories WHERE id = :id");
                        $category->execute(array(":id" => $itemInfo['category']));

                        if ( $category->rowCount() > 0 ) {
                            $category = $category->fetch(PDO::FETCH_ASSOC)['category'];

                            $updateItem = $pdo->prepare("UPDATE `". $category ."` SET pieces_in_stock = pieces_in_stock - :quantity WHERE unique_key = :key");
                            $updateItem->execute(array(":quantity" => $item['quantity'], ":key" => $item['product_id']));
                        }
                    }
                }

                $deleteCart = $pdo->prepare("DELETE FROM tb_cart WHERE user_id = :id");
                $deleteCart->execute(array(":id" => $_SESSION['user_id']));
            }



            header("Location: ". DOMAIN);
        } catch (Exception $ex) {
            //echo var_dump($ex);
            header("Location: ". DOMAIN);
            exit(1);
        }
    } catch (Exception $ex) {
        /* Payment Already Done */
        //echo var_dump($ex);
        header("Location: ". DOMAIN);
        exit(1);
    }
} else {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    //ResultPrinter::printResult("User Cancelled the Approval", null);
    

    header("Location: ". DOMAIN);
    exit;
}

header("Location: ". DOMAIN);


?>