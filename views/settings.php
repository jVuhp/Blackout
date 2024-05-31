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
$pagename = 'settings';
$pageicon = 'settings';
$position = '4';
$pageview = '0';
$auth = '0';
if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) echo '<script>location.href="' . URI . '/auth";</script>'; }
?>
	<div class="card fadeIn mb-2">
		<div class="card-body">
			<div class="media align-items-center">
                <a href="#" class="mr-3">
                    <img alt="Vuhp" style="width: 128px; border-radius: 15px !important;" src="<?php echo userDev('avatar'); ?>">
                </a>
                <div class="media-body">
                    <h2 class="mb-0 text-sm"><b><?php echo userDev('username', $_COOKIE['dbb_user']); ?></b> 
					<?php echo hasStatus('<span class="text-success" style="font-size: 16px;">' . lang($messages, $pagename, 'content', 'status', 'online') . '</span>', 
					'<span class="text-danger" style="font-size: 16px;">' . lang($messages, $pagename, 'content', 'status', 'offline') . '</span>'); ?></h2>
					<h6 class="text-muted"><button class="btn-a" onclick="logoutSession();"><?php echo lang($messages, $pagename, 'content', 'buttons', 'logout'); ?></button></h6>
                </div>
            </div>
		</div>
	</div>
<div class="row fadeIn">
	<div class="col-lg-6 col-md-12 col-sm-12 mb-2">
		<div class="card mb-2">
			<div class="card-body">
				<h4><?php echo lang($messages, $pagename, 'content', 'card', 'language'); ?></h4>
				<div class="d-flex flex-wrap align-items-start">
					<?php
					
					foreach (langList() as $list_lang) {
						$select = ($list_lang['data'] == $_SESSION['lang']) ? 'active' : '';
						echo '<img src="https://flagcdn.com/w160/' . $list_lang['flag'] . '.png" alt="' . $list_lang['name'] . '" style="width: 64px;" class="languages btn-a rounded-circle border shadow icon-btn mb-2" data-toggle="tooltip" data-placement="bottom" title="' . $list_lang['name'] . '" data-id="' . $list_lang['data'] . '">';
					}
					
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-12 col-sm-12 mb-2">
		<div class="card mb-2">
			<div class="card-body">
				<h4><?php echo lang($messages, $pagename, 'content', 'card', 'theme', 'title'); ?></h4>
				<div class="d-flex flex-wrap align-items-start">
					<?php $icon_btn = 'flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle border icon-btn'; ?>
					<a href="#" class="btn-a <?php echo $icon_btn; ?> theme_select <?php echo ($_COOKIE['theme_button'] == 'light') ? 'ib-active' : ''; ?> mb-2" style="background-color: #fff;" onclick="toggleTheme(event, 'light');" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'card', 'theme', 'light'); ?>">
						<i class="fa fa-sun"></i>
					</a>
					<a href="#" class="btn-a <?php echo $icon_btn; ?> icon-btn theme_select <?php echo ($_COOKIE['theme_button'] == 'dark') ? 'ib-active' : ''; ?> mb-2" style="background-color: #000;" onclick="toggleTheme(event, 'dark');" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'card', 'theme', 'dark'); ?>">
						<i class="fa fa-moon"></i>
					</a>
					<a href="#" class="btn-a <?php echo $icon_btn; ?> icon-btn theme_select <?php echo ($_COOKIE['theme_button'] == 'auto') ? 'ib-active' : ''; ?> mb-2" style="background-color: transparent;" onclick="toggleTheme(event, 'auto');" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'card', 'theme', 'auto'); ?>">
						<i class="fa fa-rotate"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="col-lg-4 col-md-6 col-sm-12 mb-2">
		<div class="card">
			<div class="card-body">
				<h4 class="mb-2"><?php echo lang($messages, $pagename, 'content', 'card', 'information', 'title'); ?></h4>
					<label for="secret_key" class="d-flex justify-content-between align-items-lg-center mb-2">
						<span><?php echo lang($messages, $pagename, 'content', 'card', 'information', 'secret', 'label'); ?></span> 
						<span>
							<a href="#" class="btn-a mr-2" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'card', 'information', 'secret', 'tooltip', 'copy'); ?>" onclick="copyText('<?php echo userDev('secret_key', '1'); ?>');"><i class="fa fa-copy"></i></a>
							<a href="#" class="btn-a mr-2" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'card', 'information', 'secret', 'tooltip', 'refresh'); ?>"><i class="fa fa-rotate"></i></a>
						</span>
					</label>
					<div class="input-container mb-3 w-100">
						<input type="password" disabled class="form-control input-with-icon" placeholder="<?php echo lang($messages, $pagename, 'content', 'card', 'information', 'secret', 'placeholder'); ?>" name="secret_key" id="secret_key" value="<?php echo userDev('secret_key', $_SESSION['dbb_user']['id']); ?>">
						<div class="icon-input" id="viewsecret_key"><i class="bi opacity-50 theme-icon fa fa-eye fa-flip-both" id="secret_key_icon" aria-hidden="true"></i></div>
					</div>
					
					<label for="token" class="d-flex justify-content-between align-items-lg-center mb-2">
						<span><?php echo lang($messages, $pagename, 'content', 'card', 'information', 'token', 'label'); ?></span> 
						<span>
							<a href="#" class="btn-a mr-2" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'card', 'information', 'token', 'tooltip'); ?>" onclick="copyText('<?php echo $_COOKIE['dbb_token']; ?>');"><i class="fa fa-copy"></i></a>
						</span>
					</label>
					<div class="input-container mb-3 w-100">
						<input type="password" disabled class="form-control input-with-icon" placeholder="<?php echo lang($messages, $pagename, 'content', 'card', 'information', 'token', 'placeholder'); ?>" name="token" id="token" value="<?php echo $_COOKIE['dbb_token']; ?>">
						<div class="icon-input" id="viewtoken"><i class="bi opacity-50 theme-icon fa fa-eye fa-flip-both" id="token_icon" aria-hidden="true"></i></div>
					</div>
				<p class="text-muted"><?php echo lang($messages, $pagename, 'content', 'card', 'information', 'note'); ?></p>
			</div>
		</div>
	</div>
	
	<div class="col-lg-4 col-md-6 col-sm-12 mb-3">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-lg-center">
					<h4><?php echo lang($messages, $pagename, 'content', 'card', 'update_password', 'title'); ?></h4>
					<button class="btn-a-suave"><i class="fa fa-check"></i> <?php echo lang($messages, $pagename, 'content', 'card', 'update_password', 'button'); ?></button>
				</div>
				<div class="mb-2">
					<label for="opassword"><?php echo lang($messages, $pagename, 'content', 'card', 'update_password', 'current', 'label'); ?></label>
					<input type="password" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'card', 'update_password', 'current', 'placeholder'); ?>" id="opassword" name="opassword" value="">
				</div>
				<div class="mb-2">
					<label for="password"><?php echo lang($messages, $pagename, 'content', 'card', 'update_password', 'new', 'label'); ?></label>
					<input type="password" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'card', 'update_password', 'new', 'placeholder'); ?>" id="password" name="password">
				</div>
				<div class="mb-2">
					<label for="cpassword"><?php echo lang($messages, $pagename, 'content', 'card', 'update_password', 'confirm', 'label'); ?></label>
					<input type="password" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'card', 'update_password', 'confirm', 'placeholder'); ?>" id="cpassword" name="cpassword">
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-lg-4 col-md-6 col-sm-12 mb-3">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-lg-center">
					<h4><?php echo lang($messages, $pagename, 'content', 'card', 'change_email', 'title'); ?></h4>
				</div>
				
				<label for="email_new"><?php echo lang($messages, $pagename, 'content', 'card', 'change_email', 'new', 'label'); ?></label>
				<div class="input-group mb-2">
					<input type="email" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'card', 'change_email', 'new', 'placeholder'); ?>" id="email_new" name="email_new">
					<button type="button" class="btn-a-suave"><i class="fa fa-paper-plane"></i></button>
				</div>
				
				<div class="mb-2">
					<label for="verify_code"><?php echo lang($messages, $pagename, 'content', 'card', 'change_email', 'confirm', 'label'); ?></label>
					<input type="text" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'card', 'change_email', 'confirm', 'placeholder'); ?>" id="verify_code" name="verify_code">
				</div>
				<div class="mb-2">
					<p class="text-muted"><?php echo lang($messages, $pagename, 'content', 'card', 'change_email', 'note'); ?></p>
				</div>
				<div class="mb-2">
					<button class="btn-a-suave"><i class="fa fa-check"></i> <?php echo lang($messages, $pagename, 'content', 'card', 'change_email', 'button'); ?></button>
				</div>
			</div>
		</div>
	</div>
</div>


	

<script>
var vPasss = document.getElementById("viewsecret_key");
var pass_input = document.getElementById("secret_key");
var vPasssIcon = document.getElementById("secret_key_icon");

vPasss.addEventListener("click", function() {
	if (pass_input.type === 'password') {
        pass_input.type = 'text';
        vPasssIcon.classList.remove("fa-eye");
        vPasssIcon.classList.add("fa-eye-slash");
    } else {
        pass_input.type = 'password';
        vPasssIcon.classList.remove("fa-eye-slash");
        vPasssIcon.classList.add("fa-eye");
    }
});

var vtoken = document.getElementById("viewtoken");
var view_token = document.getElementById("token");
var token_icon = document.getElementById("token_icon");

vtoken.addEventListener("click", function() {
	if (view_token.type === 'password') {
        view_token.type = 'text';
        token_icon.classList.remove("fa-eye");
        token_icon.classList.add("fa-eye-slash");
    } else {
        view_token.type = 'password';
        token_icon.classList.remove("fa-eye-slash");
        token_icon.classList.add("fa-eye");
    }
});

</script>