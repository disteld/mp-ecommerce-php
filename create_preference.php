<?php
	// SDK de Mercado Pago
	require __DIR__ .  '/vendor/autoload.php';

	// URL
	$basedir = 'https://' . dirname($_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);

	// Agrega credenciales
	MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-090914-5c508e1b02a34fcce879a999574cf5c9-469485398');

	// Crea un objeto de preferencia
	$preference = new MercadoPago\Preference();

	// Crea un ítem en la preferencia
	$item = new MercadoPago\Item();
	$item->id = "1234";
	$item->title = $_POST['title'];
	$item->description = "Dispositivo móvil de Tienda e-commerce";
	$item->picture_url = $basedir . '/' . str_replace('./', '', $_POST['img']);
	$item->quantity = intval($_POST['unit']);
	$item->unit_price = floatval($_POST['price']);
	$preference->items = array($item);

	// Crear payer
	$payer = new MercadoPago\Payer();
	$payer->name = "Lalo";
	$payer->surname = "Landa";
	$payer->email = "test_user_63274575@testuser.com";
	$payer->phone = array(
		"area_code" => "011",
		"number" => "22223333"
	);
	$payer->identification = array(
		"type" => "DNI",
		"number" => "22333444"
	);
	$payer->address = array(
		"street_name" => "Falsa",
		"street_number" => 123,
		"zip_code" => "1111"
	);
	$preference->payer = $payer;

	// Excluir pagos
	$preference->payment_methods = array(
		'excluded_payment_methods'=>array(
			array('id'=>'amex'),
		),
		'excluded_payment_types'=>array(
			array('id'=>'atm'),
		),
		'installments'=>6
	);

	// Back urls
	$preference->back_urls = array(
		'failure'=>"$basedir/failure.php",
		'pending'=>"$basedir/pending.php",
		'success'=>"$basedir/success.php"
	);

	// Notification URL
	$preference->notification_url = "$basedir/log.php";
	
	// Configurar preferencia
	$preference->auto_return = "approved";
	$preference->external_reference = "ABCD1234";

	$preference->save();
