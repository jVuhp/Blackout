<?php
$json = file_get_contents('php://input');

if(empty($json)) {
    http_response_code(400);
    die("Fatal error.");
}

$data = json_decode($json, true);

if($data['type'] === 'validation.webhook') {
	require_once('../../config.php');
	$secret = TEBEX_WEBHOOK_SECRET;
	$calculated_signature = hash_hmac('sha256', $json, $secret);
	$signature = $_SERVER['HTTP_X_SIGNATURE'];
	
	echo $json;
} else if($data['type'] === 'payment.completed') {
	require_once('../../config.php');
	require_once('../../function.php');
	$pay_type = explode('.', $data['type']);
	$transaction_id = $data['subject']['transaction_id'];
	$status = $data['subject']['status']['id'];
	$price = $data['subject']['price']['amount'];
	$payment_method = $data['subject']['payment_method']['name'];
	$user_custom = $data['subject']['custom']['user_id'];
	
	$basketSQL = $connx->prepare("SELECT * FROM `$dbb_basket` WHERE `user` = ?;");
	$basketSQL->execute([$user_custom]);
	if ($basketSQL->RowCount() > 0) {
		$basket = $basketSQL->fetch(PDO::FETCH_ASSOC);
		
		$insertSQL = $connx->prepare("INSERT INTO `$dbb_basket_checkout`(`user`, `type`, `transaction_id`, `payment_method`, `price`, `status`, `data`) 
		VALUES (?, ?, ?, ?, ?, ?, ?);");
		$insertSQL->execute([$user_custom, $pay_type[1], $transaction_id, $payment_method, $price, $status, $json]);
	
	}
		$products = $data['subject']['products'];
		foreach ($products as $product) {
			$productSQLs = $connx->prepare("SELECT * FROM `$dbb_product` WHERE `tebex` = ?;");
			$productSQLs->execute([$product['id']]);
			$productUse = $productSQLs->fetch(PDO::FETCH_ASSOC);
			$product_id = $product['id'];
			
			$productSQL = $connx->prepare("INSERT INTO `$dbb_basket_payment`(`product`, `user`, `transaction_id`, `product_id`, `quantity`, `b_price`, `p_price`, `currency`) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
			$productSQL->execute([$productUse['id'], $user_custom, $transaction_id, $product_id, $product['quantity'], $product['base_price']['amount'], $product['paid_price']['amount'], $product['paid_price']['currency']]);
		}
	
    $file_name = 'payment_info_' . time() . '.txt';
    $file_path = __DIR__ . '/../tebex_payments/' . $file_name;
    $file_content = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($file_path, $file_content);

    http_response_code(200);
	echo $json;
} else {
    http_response_code(400);
    echo "Error.";
}
?>