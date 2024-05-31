<?php
/*
===========================================================================

	Powered by: DevByBit
	Site: devbybit.com
	Date: 2/18/2024 22:31 PM
	Author: Vuhp
	Documentation: docs.devbybit.com

===========================================================================
*/
$pagename = 'basket';
$pageicon = 'basket';
$position = '9';
$pageview = '1';
$permission = (!TEBEX_PAYMENT) ? 'dbb.admin.without.tebex' : '';

if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) echo '<script>location.href="' . URI . '/auth";</script>'; }
$code = explode('=', $codeAuth[1]);
if ($code[0] != 'txn-id') {
	if (!$page[1]) {
?>

<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'title'); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'subtitle'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<a href="#" id="puchase_items" class="<?php echo (!isset($_SESSION['basket_id'])) ? '' : 'change-page'; ?> btn-a-suave" <?php echo (!isset($_SESSION['basket_id'])) ? '' : 'onclick="removeCache();"'; ?>><i class="ti ti-paywall"></i> <?php echo lang($messages, $pagename, 'content', 'button'); ?></a>
		<span class="basket_quantity">Total: $<span id="total_price_in_basket">0.00</span> USD</span>
	</div>
</div>
<p></p>
<?php if (!isset($_SESSION['basket_id'])) { ?>
<div class="icon-demo-message">
	<div class="icon-demo-message-icon"><span><img class="icon icon-tabler icon-tabler-key-off" style="width: 40px !important; height: 40px !important;" src="https://devlicense.devbybit.com/parent/img/tebex.png" alt="DevByBit"></span></div>
	<div class="icon-demo-message-text"><b class="text-primary">Tebex Auth</b><br><?php echo lang($messages, $pagename, 'content', 'auth', 'description'); ?> <a href="#" class="change-page btn-a-suave" id="create_basket_tebex"><i class="ti ti-external-link"></i> <?php echo lang($messages, $pagename, 'content', 'auth', 'button'); ?></a></div>
</div>
<?php } ?>

<section class="card fadeIn">
	<div class="card-body" id="group">
		<div class="row d-flex align-items-center mb-3">
			<div class="col-md-8">
				<input type="text" class="form-control w-50" placeholder="Searching..." id="search">
				<input type="hidden" value="group" id="tabPage">
				<input type="hidden" value="1" id="paginationID">
				<input type="hidden" value="id#DESC" id="option">
			</div>
			<div class="col-md-4 d-none d-md-inline" align="right">
				<select class="form-control w-20" id="total">
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="500">500</option>
				</select>
			</div>
		</div>
		<div class="table-responsive table-container mb-3 packages" id="load_index_result"></div>
	</div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
	window.activeTab = 'basket';
	basketCall();
	totalBasket();
});
</script>

<?php
	} else if ($page[1] == 'complete') {
?>
<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="fa fa-circle-check"></i> <?php echo lang($messages, $pagename, 'content', 'payments', 'title'); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'payments', 'subtitle'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
	</div>
</div>
<p></p>
<div class="row d-flex align-items-start mb-2 fadeIn">
	<h3><?php echo lang($messages, $pagename, 'content', 'payments', 'list'); ?></h3>
<?php
$basketSQL = $connx->prepare("SELECT * FROM `dbb_basket_checkout` WHERE `user` = ? AND `transaction_id` = ?;");
$basketSQL->execute([$_SESSION['dbb_user']['id'], $_SESSION['txnId']]);
$basket = $basketSQL->fetch(PDO::FETCH_ASSOC);

$data = json_decode($basket['data'], true);
$products = $data['subject']['products'];
foreach ($products as $product) {

	$productSQL = $connx->prepare("SELECT * FROM `dbb_product` WHERE `tebex` = ?;");
	$productSQL->execute([$product['id']]);
	$product_blackout = $productSQL->fetch(PDO::FETCH_ASSOC);
	?>
    <div class="col-md-4 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<?php echo ($product_blackout['icon_type']) ? '<img src="' . $product_blackout['icon'] . '" class="' . $product_blackout['icon_bg'] . '" width="48px" height="48px" alt="DevByBit" style="padding: 3px; border-radius: 5px;">' : '<h5 class="' . $product_blackout['icon_bg'] . '" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;">' . $product_blackout['icon'] . '</h5>'; ?>
					<div class="media-body">
						<div class="row d-flex align-items-center mb-3">
							<div class="col-md-12">
								<h4 class="mb-0 text-sm"><b><?php echo $product_blackout['name']; ?></b></h4>
								<h6 class="text-muted">Quantity: <?php echo $product['quantity']; ?> - $<?php echo $product['paid_price']['amount']; ?> <?php echo $product['paid_price']['currency']; ?></h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php
}
?>
	<p class="text-muted"><?php echo lang($messages, $pagename, 'content', 'payments', 'note'); ?></p>
</div>
<?php
	}
} else {
	require_once(__DIR__ . '/../parent/tebex/api.php');
	unset($_SESSION['basket_id']);	
	$_SESSION['txnId'] = $code[1];
	echo '<script> location.href = "' . URI . '/basket/complete"; removeCache(); </script>';

}

?>