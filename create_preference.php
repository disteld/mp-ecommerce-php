<?php
	require __DIR__ .  '/vendor/autoload.php';
	$basedir = 'https://' . dirname($_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);
	MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');
        MercadoPago\SDK::setIntegratorId('dev_24c65fb163bf11ea96500242ac130004');
	$preference = new MercadoPago\Preference();

	// Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();

    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->id = "1234";
    $item->title = $_POST['title'];
    $item->quantity = 1;
    $item->picture_url = $_POST['img'];
    $item->unit_price = $_POST['price']; //Detalle aca, si tu previamente tienes configurado en tu cuenta que eres de algun pais que no maneje decimales en el valor, el valor debe ser entero, sino mercadopago arrojara error
    $preference->items = array($item);
	
	$preference->payment_methods = array(
  "excluded_payment_methods" => array(
    array("id" => "amex")
  ),
  "excluded_payment_types" => array(
    array("id" => "atm")
  ),
  "installments" => 6
);

	$preference->back_urls = array(
                        "success" => "$basedir/success.php",
                        "failure" => "$basedir/failure.php",
                        "pending" => "$basedir/pending.php"
                    );
	 $preference->external_reference = "ddistel@jotafi.com.ar";
	 $preference->notification_url = "https://ddistel-mp-commerce-php.herokuapp.com/webhook.php"
		
	$payer = new MercadoPago\Payer();
	$payer->name = "Lalo Landa";
	$payer->email = "test_user_63274575@testuser.com";
	
	$payer->phone = array(
                        "area_code" => "11",
                        "number" => "22223333"
                    );
	$payer->address = array(
                        "zip_code" => "111",
                        "street_name" => "False",
                       "street_number" => "123"
                    );
	
	$preference->payer = $payer;	
			
         $preference->save();
