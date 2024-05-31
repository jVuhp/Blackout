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
$pagename = 'auth';
$pageicon = 'auth';
$position = '10';
$pageview = '0';
$auth = '1';

?>
<link rel="stylesheet" href="<?php echo URI; ?>/css/auth.css?<?php echo time(); ?>">

<section class="subcontent">
	<?php if (isset($_COOKIE['dbb_user'])) {
	
	?>

	<div class="mb-3" id="alerts" hidden>
		<h5 style="background: #c45454; border-radius: 10px; padding: 15px; width: 100%;"><i class="fa fa-circle-xmark"></i> <span id="alert_message">...</span></h5>
	</div>
	<div></div>
	<div class="mb-3" align="center">
		<img src="<?php echo userDev('avatar', $_COOKIE['dbb_user']); ?>" style="width: 256px; border-radius: 50%;" alt="User Avatar">
	</div>
	<div></div>
    <div class="w-30">
		<div class="mb-3" align="center">
			<h1><?php echo userDev('username', $_COOKIE['dbb_user']); ?></h1>
		</div>
		<form id="loginToMyAccount" method="POST" class="mb-3">
			<input type="hidden" name="result" value="login">
			<input type="hidden" class="form-control" placeholder="Username" value="<?php echo userDev('username', $_COOKIE['dbb_user']); ?>" name="username" id="username">
			<div class="checkbox-wrapper-4 mb-1">
				<input type="checkbox" class="inp-cbx" id="remember" name="remember" value="1" <?php echo (isset($_COOKIE['dbb_user_password'])) ? 'checked' : ''; ?> />
				<label class="cbx" for="remember"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span><?php echo lang($messages, $pagename, 'content', 'old', 'remember'); ?></span></label>
				<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
			</div>
			<div class="input-group">
				<input type="password" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'old', 'placeholder'); ?>" name="password" id="password" value="<?php echo (isset($_COOKIE['dbb_user_password'])) ? $_COOKIE['dbb_user_password'] : ''; ?>">
				<button type="submit" class="btn btn-primary"><i class="fa fa-lock-open"></i></button>
			</div>
		</form>
		<form id="closeThisAccount" method="POST" align="center"><input type="hidden" name="result" value="closelogout"><button class="change-page btn-a" type="submit" name="closeThisAccount"><i class="fa fa-arrow-right-from-bracket"></i> <?php echo lang($messages, $pagename, 'content', 'old', 'close'); ?></button></form>
	</div>
	<div><hr></div>
	
		<div align="center">
			<div class="relative inline-block text-left">
				<div class="group text-white rounded-md text-xs font-semibold bg-black/30 hover:bg-black/70 transition-all">
				  <button type="button" class="inline-flex justify-start items-center w-full gap-x-2 px-3 py-2 snipcss0-0-0-1" aria-expanded="true" aria-haspopup="true">
					<img src="https://flagcdn.com/w160/<?php echo lang($messages, 'location', 'flag'); ?>.png" alt="<?php echo lang($messages, 'location', 'name'); ?>" style="width: 24px; height: 24px; border-radius: 7px;">
					<?php echo lang($messages, 'location', 'name'); ?> 
					<svg class="-mr-1 h-5 w-5 text-white group-hover:rotate-180 transition-all duration-200 snipcss0-1-1-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd">
					  </path>
					</svg>
				  </button>
				  <ul class="group-hover:block group-hover:animate-fade-down group-hover:animate-duration-200 hidden pt-0.5 absolute w-full">

					<?php
								
					foreach (langList() as $list_lang) {
						echo '
					<li class="py-[2px]">
					  <a class="languages rounded-md bg-black/30 hover:bg-black/70 whitespace-no-wrap inline-flex justify-start items-center w-full gap-x-2 px-3 py-2" href="#" data-id="' . $list_lang['data'] . '">
					  <img src="https://flagcdn.com/w160/' . $list_lang['flag'] . '.png" alt="' . $list_lang['name'] . '" style="width: 16px; height: 16px; border-radius: 7px;">' . $list_lang['name'] . '</a>
					</li>';
					}
								
					?>
				  </ul>
				</div>
			</div>
			<div class="relative inline-block text-left">
				<div class="text-white rounded-md text-xs font-semibold bg-black/30 hover:bg-black/70 transition-all">
				  <button type="button" class="inline-flex justify-start items-center w-full gap-x-2 px-3 py-2 snipcss0-0-0-1" aria-expanded="true" aria-haspopup="true" id="toggle_theme">
					<?php echo ($_COOKIE['theme'] == 'dark') ? $theme_is_light : $theme_is_dark; ?>
					<?php echo ($_COOKIE['theme'] == 'dark') ? 'Dark Mode' : 'Light Mode'; ?>
				  </button>
				</div>
			</div>
			<div class="relative inline-block text-left">
				<div class="text-dropdown rounded-md text-xs font-semibold bg-black/30 hover:bg-black/70 transition-all">
				  <button type="button" onclick="location.href='<?php echo lang($messages, $pagename, 'content', 'community', 'link'); ?>';" class="inline-flex justify-start items-center w-full gap-x-2 px-3 py-2 snipcss0-0-0-1">
					<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-discord" style="width: 24px !important; height: 24px !important;" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 12a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M14 12a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M15.5 17c0 1 1.5 3 2 3c1.5 0 2.833 -1.667 3.5 -3c.667 -1.667 .5 -5.833 -1.5 -11.5c-1.457 -1.015 -3 -1.34 -4.5 -1.5l-.972 1.923a11.913 11.913 0 0 0 -4.053 0l-.975 -1.923c-1.5 .16 -3.043 .485 -4.5 1.5c-2 5.667 -2.167 9.833 -1.5 11.5c.667 1.333 2 3 3.5 3c.5 0 2 -2 2 -3" /><path d="M7 16.5c3.5 1 6.5 1 10 0" /></svg>
					<?php echo lang($messages, $pagename, 'content', 'community', 'name'); ?>
				  </button>
				</div>
			</div>
		</div>
	<div align="center">Powered by <a href="https://devbybit.com" target="_BLANK" style="text-decoration: none;">DevByBit 💘</a>!</div>
<script>
$(document).ready(function() {
    $('#loginToMyAccount').submit(function(e) {
		e.preventDefault();
		var alert_msg = $('#alerts');
		var alert_message = $('#alert_message');
        $.ajax({
            type: "POST",
            url: site_domain + '/execute/action.php',
            data: $(this).serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.type == 'success') {
                    swal(jsonData.title, jsonData.subtitle, jsonData.type);
					location.href = site_domain;
                } else {
                    alert_msg.removeAttr("hidden");
                    alert_message.text(jsonData.message);
                }
           }
       });

    });

    $('#closeThisAccount').submit(function(e) {
		e.preventDefault();
        $.ajax({
            type: "POST",
            url: site_domain + '/execute/action.php',
            data: $(this).serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);
                swal(jsonData.title, jsonData.subtitle, jsonData.type);
				location.reload();
           }
       });

    });
});
</script>
	<?php } else { ?>

		<form method="POST" class="card">
			<div class="card-body">
				<div class="mb-3" align="center">
					<img src="<?php echo lang($messages, $pagename, 'content', 'new', 'logo'); ?>" style="width: 200px; border-radius: 50%;" alt="DevByBit">
				</div>
				<h4><?php echo str_replace('{site:name}', SOFTWARE, lang($messages, $pagename, 'content', 'new', 'title')); ?></h4>
				<button class="change-page btn btn-primary w-100 d-flex justify-content-center align-items-center lh-1 text-reset" style="font-size: 20px !important;" type="submit" name="login">
					<i class="ti ti-brand-discord mr-2" style="font-size: 32px !important;"></i>
					<?php echo lang($messages, $pagename, 'content', 'new', 'button'); ?>
				</button>
			</div>
		</form>
		<div align="center">
			<div class="relative inline-block text-left">
				<div class="group text-dropdown rounded-md text-xs font-semibold bg-black/30 hover:bg-black/70 transition-all">
				  <button type="button" class="inline-flex justify-start items-center w-full gap-x-2 px-3 py-2 snipcss0-0-0-1" aria-expanded="true" aria-haspopup="true">
					<img src="https://flagcdn.com/w160/<?php echo lang($messages, 'location', 'flag'); ?>.png" alt="<?php echo lang($messages, 'location', 'name'); ?>" style="width: 24px; height: 24px; border-radius: 7px;">
					<?php echo lang($messages, 'location', 'name'); ?> 
					<svg class="-mr-1 h-5 w-5 text-dropdown group-hover:rotate-180 transition-all duration-200 snipcss0-1-1-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd">
					  </path>
					</svg>
				  </button>
				  <ul class="group-hover:block group-hover:animate-fade-down group-hover:animate-duration-200 hidden pt-0.5 absolute w-full">

					<?php
								
					foreach (langList() as $list_lang) {
						echo '
					<li class="py-[2px]">
					  <a class="languages rounded-md bg-black/30 hover:bg-black/70 whitespace-no-wrap inline-flex justify-start items-center w-full gap-x-2 px-3 py-2" href="#" data-id="' . $list_lang['data'] . '">
					  <img src="https://flagcdn.com/w160/' . $list_lang['flag'] . '.png" alt="' . $list_lang['name'] . '" style="width: 16px; height: 16px; border-radius: 7px;">' . $list_lang['name'] . '</a>
					</li>';
					}
								
					?>
				  </ul>
				</div>
			</div>
			<div class="relative inline-block text-left">
				<div class="text-dropdown rounded-md text-xs font-semibold bg-black/30 hover:bg-black/70 transition-all">
				  <button type="button" class="inline-flex justify-start items-center w-full gap-x-2 px-3 py-2 snipcss0-0-0-1" aria-expanded="true" aria-haspopup="true" id="toggle_theme">
					<?php echo ($_COOKIE['theme'] == 'dark') ? $theme_is_light : $theme_is_dark; ?>
					<?php echo ($_COOKIE['theme'] == 'dark') ? lang($messages, 'theme', 'mode', 'dark') : lang($messages, 'theme', 'mode', 'light'); ?>
				  </button>
				</div>
			</div>
			<div class="relative inline-block text-left">
				<div class="text-dropdown rounded-md text-xs font-semibold bg-black/30 hover:bg-black/70 transition-all">
				  <button type="button" onclick="location.href='<?php echo lang($messages, $pagename, 'content', 'community', 'link'); ?>';" class="inline-flex justify-start items-center w-full gap-x-2 px-3 py-2 snipcss0-0-0-1">
					<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-discord" style="width: 24px !important; height: 24px !important;" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 12a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M14 12a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M15.5 17c0 1 1.5 3 2 3c1.5 0 2.833 -1.667 3.5 -3c.667 -1.667 .5 -5.833 -1.5 -11.5c-1.457 -1.015 -3 -1.34 -4.5 -1.5l-.972 1.923a11.913 11.913 0 0 0 -4.053 0l-.975 -1.923c-1.5 .16 -3.043 .485 -4.5 1.5c-2 5.667 -2.167 9.833 -1.5 11.5c.667 1.333 2 3 3.5 3c.5 0 2 -2 2 -3" /><path d="M7 16.5c3.5 1 6.5 1 10 0" /></svg>
					<?php echo lang($messages, $pagename, 'content', 'community', 'name'); ?>
				  </button>
				</div>
			</div>
		</div>

		
		
	<div align="center">Powered by <a href="https://devbybit.com" target="_BLANK" style="text-decoration: none;">DevByBit 💘</a>!</div>
	<?php } ?>
</section>

<?php

if (isset($_POST['login'])) {
	$discord_url = "https://discord.com/api/oauth2/authorize?client_id=" . CLIENT_ID . "&redirect_uri=" . URI . "/" . $page[0] . "&response_type=code&scope=identify+guilds.join+email";
	echo '<script> location.href = "' . $discord_url . '"; </script>';
}
$code = explode('=', $codeAuth[1]);
if (isset($code[1])) {
	$discord_code = $code[1];
	$payload = [
		'code'=>$discord_code,
		'client_id'=> CLIENT_ID,
		'client_secret'=> CLIENT_SECRET,
		'grant_type'=>'authorization_code',
		'redirect_uri'=> URI . '/auth',
		'scope'=>'identify+guilds.join+email',
	];
	$payload_string = http_build_query($payload);
	$discord_token_url = "https://discordapp.com/api/oauth2/token";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $discord_token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSLVERSION, 6); // Utiliza el número de versión SSL adecuado
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // No verificar el host SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // No verificar el certificado SSL del servidor

$result = curl_exec($ch);
	if (DEBUGG) {
		echo curl_error($ch);
	}

	$result = json_decode($result,true);
	print_r($result);
	$access_token = $result['access_token'];
	
	curl_close($ch);

	$discord_users_url = "https://discordapp.com/api/users/@me";
	$header = array("Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded");

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_URL, $discord_users_url);
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$result = curl_exec($ch);

	$result = json_decode($result, true);

	$date = date('Y-m-d h:i:s');
	
	$ip = getUserIp();
	$country_api = json_decode(file_get_contents('https://api.country.is/'. $ip));
	$country_dec = $country_api->country;
	
	$variable = array("A", "S", "D", "F", "G", "H", "J", "K", "L", "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "Z", "X", "C", "V", "B", "N", "M");
	$str_variable = array("a", "s", "d", "f", "g", "h", "j", "k", "l", "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "z", "x", "c", "v", "b", "n", "m");
	$country = str_replace($variable, $str_variable, $country_dec);
	
	if (!isset($result['avatar'])) {
		$avatar = 'https://archive.org/download/discordprofilepictures/discordred.png';
	} else {
		$avatar = is_animated($result['avatar']);
		$avatar = 'https://cdn.discordapp.com/avatars/' . $result['id'] . '/' . $result['avatar'] . $avatar;
	}
	getDBConnection();
	if (isset($connx) && !is_null($connx)) {
	try {
	$docsSQL = $connx->prepare("SELECT * FROM `dbb_user` WHERE `udid` = ?;");
	$docsSQL->execute([$result['id']]);
	
	if ($docsSQL->RowCount() > 0) {
		$docs = $docsSQL->fetch(PDO::FETCH_ASSOC);
		$last_token = randomCode(32, 'ASDFGHJKLQWERTYUIOPZXCVBNM0123456789asdfghjklqwertyuiopzxcvbnm.-_');
		if (TOKEN_STATUS) {
		$tokenSQL = $connx->prepare("SELECT * FROM `dbb_token` WHERE `token` = ?;");
		$tokenSQL->execute([$_COOKIE['dbb_token']]);
		$token = $tokenSQL->fetch(PDO::FETCH_ASSOC);
		
		if ($tokenSQL->RowCount() > 0) {
			$deletetokenSQL = $connx->prepare("DELETE FROM `dbb_token` WHERE `dbb_token`.`id` = ?;");
			$deletetokenSQL->execute([$token['id']]);
		}
		
		$inserttokenSQL = $connx->prepare("INSERT INTO `dbb_token`(`user`, `ip`, `country`, `token`, `activity`, `status`) VALUES (?, ?, ?, ?, NOW(), '1');");
		$inserttokenSQL->execute([$docs['id'], $ip, $country, $last_token]);
		}
		
		$updateSQL = $connx->prepare("UPDATE `dbb_user` SET `avatar` = ?,`last_token` = ?,`token` = ? WHERE `id` = ?;");
		$updateSQL->execute([$avatar, $last_token, $access_token, $docs['id']]);

		
		ipHistory($ip, $docs['id'], $country, $last_token);
		session_start();
		$_SESSION['dbb_user'] = [
			'id' => $docs['id'],
			'last_token' => $docs['last_token']
		];
		setcookie('dbb_user', $docs['id'], time() + 3600*24*30, '/');
		if (TOKEN_STATUS) setcookie('dbb_token', $last_token, time() + 3600*24*30, '/');
	} else {
		$secret_key = randomCode(32, 'ASDFGHJKLQWERTYUIOPZXCVBNM0123456789asdfghjklqwertyuiopzxcvbnm.-_');
		$last_token = randomCode(32, 'ASDFGHJKLQWERTYUIOPZXCVBNM0123456789asdfghjklqwertyuiopzxcvbnm.-_');
		
		$insetSQL = $connx->prepare("INSERT INTO `dbb_user`(`username`, `password`, `email`, `udid`, `avatar`, `secret_key`, `last_token`, `token`) VALUES (?, '', ?, ?, ?, ?, ?, ?);");
		$insetSQL->execute([$result['username'], $result['email'], $result['id'], $avatar, $secret_key, $last_token, $access_token]);
		
		$user_id = $connx->lastInsertId();
		if (TOKEN_STATUS) {
		$tokenSQL = $connx->prepare("SELECT * FROM `dbb_token` WHERE `token` = ?;");
		$tokenSQL->execute([$_COOKIE['dbb_token']]);
		$token = $tokenSQL->fetch(PDO::FETCH_ASSOC);
		
		if ($tokenSQL->RowCount() > 0) {
			$deletetokenSQL = $connx->prepare("DELETE FROM `dbb_token` WHERE `dbb_token`.`id` = ?;");
			$deletetokenSQL->execute([$token['id']]);
		}
		
		$inserttokenSQL = $connx->prepare("INSERT INTO `dbb_token`(`user`, `ip`, `country`, `token`, `activity`, `status`) VALUES (?, ?, ?, ?, NOW(), '1');");
		$inserttokenSQL->execute([$user_id, $ip, $country, $last_token]);
		}
		ipHistory($ip, $user_id, $country, $last_token);

		session_start();
		$_SESSION['dbb_user'] = [
			'id' => $user_id,
			'last_token' => $last_token
		];
		setcookie('dbb_user', $user_id, time() + 3600*24*30, '/');
		if (TOKEN_STATUS) setcookie('dbb_token', $last_token, time() + 3600*24*30, '/');
	}
	deleteOldTokens();
	closeDBConnection();
	print_r($_SESSION['dbb_user']);
	echo '<script> location.href="' . URI . '/license"; </script>';
	} catch(PDOException $e) {
		echo (DEBUGG) ? $e->getMessage() : 'Error connection in MySQL.';
	}
	} else {
		echo "Database error.";
	}
}

?>
