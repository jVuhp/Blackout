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
$pagename = 'Installation';
$pageicon = 'list-check';
$position = '1';
$pageview = '0';
$permission = '';
$install = '1';
$success = '<b class="text-success"><svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 32 32"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l3 3l8 -8" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg></b>';
$xmark = '<b class="text-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 32 32"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></b>';
$warning = '<b class="text-warning"><svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 32 32"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg></b>';

if (!INSTALL_MODE) {
	echo '<script> location.href = site_domain + "/auth"; </script>';
}

if (INSTALL_MODE) {
?>
<div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="<?php echo URI . '/' . $page[0]; ?>" class="navbar-brand navbar-brand-autodark">
            <img src="<?php echo ICON; ?>" width="64" height="64" alt="Tabler" class="navbar-brand-image">
          </a>
        </div>

<?php
	if (!$page[1]) {
?>
        <div class="card card-md">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">0-Step Dependencies</h2>
            <div class="mb-4">
              <label class="form-label">Dependencies</label>
              <div class="">
					<?php
					$php_version = phpversion();
					if ($php_version) {
						echo $success . 'PHP Installed - Version: <b class="text-muted">' . $php_version . '</b> <br>';
					} else {
						$i++;
						echo $xmark . 'PHP not Installed<br>';
					}

					if (function_exists('curl_version')) {
						$curl_version = curl_version();
						echo $success . 'cURL Installed - Version: <b class="text-muted">' . $curl_version['version'] . '</b> <br>';
					} else {
						$i++;
						echo $xmark . 'cURL not Installed on PHP. <br>';
					}


					?>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">URL</label>
              <div class="">
				<input type="text" class="form-control" placeholder="https://blackout.devbybit.com" value="https://<?php echo $_SERVER['SERVER_NAME'] . str_replace('/install', '', $_SERVER['REQUEST_URI']); ?>" id="uri_url">
              </div>
            </div>
			<p id="test_database"></p>
			<?php if ($i > 0) { ?>
            <div class="text-secondary">
				There are problems with the installed dependencies. It is necessary to have all the dependencies installed to continue. Otherwise Blackout Software will not be able to work.
            </div>
			<?php } else { ?>
            <div class="form-footer">
              <a href="<?php echo URI . '/' . $page[0] . '/1'; ?>/continue" onclick="event.preventDefault(); updateConfig();" id="button_continue" class="btn btn-primary w-100">
                Continue
              </a>
            </div>
			<?php } ?>
          </div>
        </div>
<script>

var success = '<?php echo $success; ?>';
var xmark = '<?php echo $xmark; ?>';
var warning = '<?php echo $warning; ?>';
    var spinner_pulse = '<i class="text-warning fa-solid fa-spinner fa-spin-pulse"></i>';
    var warning_icon = '<i class="text-warning fa-solid fa-warning fa-fade"></i>';
    var success_icon = '<i class="text-success fa-solid fa-check fa-shake"></i>';
function updateConfig() {
	var result = 'updateConfig';
	var url_link = document.getElementById('uri_url').value;
    $.post('../execute/action.php', { result: result, url: url_link },
        function (response) {
			var jsonData = JSON.parse(response);
			if (jsonData.success === 1) {
				document.getElementById("test_database").innerHTML = success_icon + ' ' + jsonData.message;
				document.getElementById("button_continue").innerHTML = spinner_pulse;
				setTimeout(function() {
					document.getElementById("button_continue").innerHTML = 'Continue';
					location.href = "/install/2";
				}, 1500);
			} else {
				document.getElementById("test_database").innerHTML = warning_icon + ' ' + jsonData.message;
			}
        }
    );
}
</script>
<?php 
	} else if($page[1] == 1) {
?>

        <div class="card card-md">
          <div class="card-body">
            <h2 class="card-title text-center mb-1">1-Step Permissions</h2>
			<h6 class="text-center text-muted mb-4">Start by giving the appropriate permissions to this list and its corresponding file or folder displayed in the list.</h6>
            <div class="mb-4">
              <label class="form-label">Required Permissions</label>
              <div class="">
				<ul>
					<li id="config_input"><i class="text-warning fa-solid fa-spinner fa-spin-pulse"></i> config.php</li>
					<li id="parent_upload_input"><i class="text-warning fa-solid fa-spinner fa-spin-pulse"></i> parent/upload</li>
					<li id="parent_tebex_payments_input"><i class="text-warning fa-solid fa-spinner fa-spin-pulse"></i> parent/tebex_payments</li>
				</ul>
				<b class="text-warning">Test Verify: </b><span id="test_verify_perms"><i class="text-warning fa-solid fa-spinner fa-spin-pulse"></i></span>

              </div>
            </div>
            <div class="mb-4">
              <label class="form-label">Verify </label>
              <div class="">
				<ul>
					<li id="htaccess"><?php echo $warning; ?>.htaccess</li>
				</ul>
				<b class="text-warning">Test Verify: </b><span id="test_verify">Please, Click on button 'Verify'.</span>

              </div>
            </div>
            <div class="mb-3">
			</div>
			<?php if ($i2 > 0) { ?>
            <div class="text-secondary">
				There are problems with the installed dependencies. It is necessary to have all the dependencies installed to continue. Otherwise Blackout Software will not be able to work.
            </div>
			<?php } else { ?>
            <div class="">
              <a href="<?php echo URI . '/' . $page[0] . '/1/verify'; ?>" onclick="event.preventDefault(); verifyPermissions(); verifyStatusOfHtaccess();" class="btn btn-warning">
                Verify
              </a>
            </div>
			<?php } ?>
          </div>
        </div>
<script>
var success = '<?php echo $success; ?>';
var xmark = '<?php echo $xmark; ?>';
var warning = '<?php echo $warning; ?>';
    var spinner_pulse = '<i class="text-warning fa-solid fa-spinner fa-spin-pulse"></i>';
    var warning_icon = '<i class="text-warning fa-solid fa-warning fa-fade"></i>';
    var success_icon = '<i class="text-success fa-solid fa-check fa-shake"></i>';
var ix = 0;
function verifyPermissions() {
	var result = 'verifyPermissions';
	document.getElementById('test_verify_perms').innerHTML = spinner_pulse;
    $.post(site_domain + '/execute/action.php', { result: result },
        function (response) {
			var jsonData = JSON.parse(response);
			var configStatus = jsonData.config;
			var parentUploadStatus = jsonData.parent_upload;
			var tebex_payments = jsonData.tebex_payments;
			
			if (configStatus === 1) {
				document.getElementById('config_input').innerHTML = success_icon + ' config.php';
			} else {
				document.getElementById('config_input').innerHTML = warning_icon + ' config.php';
				ix++;
			}
			if (parentUploadStatus === 1) {
				document.getElementById('parent_upload_input').innerHTML = success_icon + ' parent/upload';
			} else {
				document.getElementById('parent_upload_input').innerHTML = warning_icon + ' parent/upload';
				ix++;
			}
			if (tebex_payments === 1) {
				document.getElementById('parent_tebex_payments_input').innerHTML = success_icon + ' parent/tebex_payments';
			} else {
				document.getElementById('parent_tebex_payments_input').innerHTML = warning_icon + ' parent/tebex_payments';
				ix++;
			}
			
			if (ix > 0) {
				document.getElementById('test_verify_perms').innerHTML = 'Permissions are required on files with the ' + warning_icon + ' icon.';
			}
        }
    );
}


function verifyStatusOfHtaccess() {
    var result = 'testVerifyHtaccess';
    var type_one = '0';
    var type_two = '0';

    $.post(site_domain + '/execute/action.php', { result: result },
        function (response) {
            type_one = '1';
            result_one = 50;
        }
    );

    $.post(site_domain + '/execute/action', { result: result },
        function (response) {
            type_two = '1';
            result_two = 50;
        }
    );

    $.when(
        $.post(site_domain + '/execute/action.php', { result: result }),
        $.post(site_domain + '/execute/action', { result: result })
    ).done(function (responseOne, responseTwo) {
        if (type_one === '0') {
            document.getElementById('htaccess').innerHTML = xmark + ' .htaccess';
        }
        if (type_two === '0') {
            document.getElementById('htaccess').innerHTML = xmark + ' .htaccess';
        }

        if (type_one === '1' || type_two === '1') {
            var result_end = result_one + result_two;
            document.getElementById('htaccess').innerHTML = success + ' .htaccess';
            document.getElementById('test_verify').innerHTML = 'The test has passed with <b style="color: red;">(' + result_end + '%)</b> Of success';
			if (ix === 0) {
				location.href = site_domain + '/install/2';
			}
        } else {
            document.getElementById('test_verify').innerHTML = 'The verification attempt with the ".htaccess" file has failed. Please verify that both the file and your server or website are configured correctly.';
        }
    });
}

</script>
<?php
	} else if($page[1] == 2) {
?>


        <div class="card card-md">
          <div class="card-body">
            <h2 class="card-title text-center mb-1">2-Step Databases</h2>
			<h6 class="text-center text-muted mb-4">Start by giving the appropriate permissions to this list and its corresponding file or folder displayed in the list.</h6>
			<?php 
			
			try {
				$connx = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATA, DB_USER, DB_PASSWORD);
				$connx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$database_valid = 1;
			} catch(PDOException $e) {
				$database_valid = 0;
			}
			if (empty(DB_TYPE) OR empty(DB_HOST) OR empty(DB_PORT) OR empty(DB_DATA) OR empty(DB_USER)) $database_valid = 0;
			
			if (!$database_valid) { 
			
					if (extension_loaded('pdo')) {
						try {
							$connx = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATA, DB_USER, DB_PASSWORD);
							$mysql_version = $connx->getAttribute(PDO::ATTR_SERVER_VERSION);
							echo $success . 'MySQL Installed - Version: <b class="text-muted">' . $mysql_version . '</b> <br>';
						} catch (PDOException $e) {
							echo $xmark . 'MySQL problems on Execute<br>';
						}
					} else {
						$i++;
						echo $xmark . 'PDO not Installed <br>';
					}
			?>
            <div class="mb-3">
              <label class="form-label">Type</label>
              <div class="">
				<select class="form-select" id="db_type">
                    <option value="MYSQL">MySQL</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Host</label>
              <div class="">
				<input type="text" class="form-control" placeholder="localhost" id="db_host" value="<?php echo DB_HOST; ?>">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Database Name</label>
              <div class="">
				<input type="text" class="form-control" placeholder="devbybit_blackout" id="db_data" value="<?php echo DB_DATA; ?>">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <div class="">
				<input type="text" class="form-control" placeholder="root" id="db_username" value="<?php echo DB_USER; ?>">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <div class="">
				<input type="text" class="form-control" placeholder="PUT_YOUR_PASSWORD" id="db_password" value="<?php echo DB_PASSWORD; ?>">
              </div>
            </div>
			<p id="test_database"></p>
			
			<?php if ($i > 0) { ?>
            <div class="text-secondary">
				There are problems with the installed dependencies. It is necessary to have all the dependencies installed to continue. Otherwise Blackout Software will not be able to work.
            </div>
			<?php } else { ?>
            <div class="form-footer">
              <a href="<?php echo URI . '/' . $page[0] . '/2/verify'; ?>" onclick="event.preventDefault(); verifyDBStatus();" id="button_verify" class="btn btn-warning">
                Verify
              </a>
              <a href="<?php echo URI . '/' . $page[0] . '/2/continue'; ?>" onclick="event.preventDefault(); insertDBInfo();" id="button_continue" class="btn btn-success">
                Continue
              </a>
            </div>
			<?php } ?>
			<?php } else { ?>
			
            <div class="mb-4">
              <label class="form-label">Databases</label>
              <div class="">
				<ul id="tables_list">
					<?php
					
					$tables = [
						'dbb_user' => $dbb_user,
						'dbb_token' => $dbb_token,
						'dbb_product_update' => $dbb_product_update,
						'dbb_product_actions' => $dbb_product_actions,
						'dbb_product' => $dbb_product,
						'dbb_logs' => $dbb_logs,
						'dbb_license' => $dbb_license,
						'dbb_history_ip' => $dbb_history_ip,
						'dbb_group_user' => $dbb_group_user,
						'dbb_group_permission' => $dbb_group_permission,
						'dbb_group' => $dbb_group,
						'dbb_download' => $dbb_download,
						'dbb_code' => $dbb_code,
						'dbb_basket_payment' => $dbb_basket_payment,
						'dbb_basket_checkout' => $dbb_basket_checkout,
						'dbb_basket' => $dbb_basket
					];

					foreach ($tables as $id => $name) {
						echo "<li id=\"$id\"><i class=\"text-warning fa-solid fa-spinner fa-spin-pulse\"></i> $name</li>";
					}
					
					?>
				</ul>
				<p id="test_tables"></p>
              </div>
            </div>
			
            <div class="mb-3">
			</div>
			<?php if ($i2 > 0) { ?>
            <div class="text-secondary">
				There are problems with the installed dependencies. It is necessary to have all the dependencies installed to continue. Otherwise Blackout Software will not be able to work.
            </div>
			<?php } else { ?>
            <div class="">
              <a href="<?php echo URI . '/' . $page[0] . '/2/verify'; ?>" onclick="event.preventDefault(); verifyDBTable();" class="btn btn-warning">
                Verify
              </a>
              <a href="<?php echo URI . '/' . $page[0] . '/2/insert'; ?>" onclick="event.preventDefault(); uploadSQLFiles();" class="btn btn-success">
                Insert Databases
              </a>
            </div>
			<?php } ?>
			<?php } ?>
          </div>
        </div>
<script>


    var spinner_pulse = '<i class="text-warning fa-solid fa-spinner fa-spin-pulse"></i>';
    var warning_icon = '<i class="text-warning fa-solid fa-warning fa-fade"></i>';
    var success_icon = '<i class="text-success fa-solid fa-check fa-shake"></i>';
function verifyDBStatus() {
	document.getElementById("test_database").innerHTML = spinner_pulse;
    var db_type = document.getElementById('db_type').value;
    var db_host = document.getElementById('db_host').value;
    var db_data = document.getElementById('db_data').value;
    var db_username = document.getElementById('db_username').value;
    var db_password = document.getElementById('db_password').value;
	var result = 'verify_database';
    $.post(site_domain + '/execute/action.php', { result: result, type: db_type, hosting: db_host, database: db_data, username: db_username, password: db_password },
        function (response) {
			if (response == 1) {
				document.getElementById("test_database").innerHTML = success_icon + ' ' + 'The database works correctly. Click "continue"';
			} else {
				document.getElementById("test_database").innerHTML = warning_icon + ' ' + response;
			}
        }
    );
}
function insertDBInfo() {
	document.getElementById("test_database").innerHTML = spinner_pulse;
    var db_type = document.getElementById('db_type').value;
    var db_host = document.getElementById('db_host').value;
    var db_data = document.getElementById('db_data').value;
    var db_username = document.getElementById('db_username').value;
    var db_password = document.getElementById('db_password').value;
	
	var result = 'config_database';
    $.post(site_domain + '/execute/action.php', { result: result, type: db_type, hosting: db_host, database: db_data, username: db_username, password: db_password },
        function (response) {
			var jsonData = JSON.parse(response);
			if (jsonData.success === 1) {
				document.getElementById("test_database").innerHTML = success_icon + ' ' + jsonData.message;
				document.getElementById("button_continue").innerHTML = spinner_pulse;
				setTimeout(function() {
					document.getElementById("button_continue").innerHTML = 'Perfect!';
					location.reload();
				}, 1000);
			} else {
				document.getElementById("test_database").innerHTML = warning_icon + ' ' + jsonData.message;
			}
        }
    );
}

function uploadSQLFiles() {
    var result_log = document.getElementById('test_tables');
	var spinner_pulse = '<i class="text-warning fa-solid fa-spinner fa-spin-pulse"></i>';
	var success_icon = '<i class="text-success fa-solid fa-check fa-shake"></i>';
	result_log.innerHTML = 'Result: ' + spinner_pulse;
	var result = 'uploadSQLFiles';
    $.post(site_domain + '/execute/action.php', { result: result },
        function (response) {
			result_log.innerHTML = 'Result: ' + success_icon + ' The tables have been created, click verify and it will automatically continue to the next step.';
        }
    );
}
function verifyDBTable() {
    var result_log = document.getElementById('test_tables');
    var tables = <?php echo json_encode($tables); ?>;
    var tables_list = document.getElementById('tables_list');

    // Limpiar la lista de tablas antes de agregar nuevas entradas
    tables_list.innerHTML = '';

    // Iterar sobre el array de tablas y actualizar el contenido de la lista
    Object.keys(tables).forEach(function(id) {
        tables_list.innerHTML += '<li id="' + id + '">' + spinner_pulse + ' ' + tables[id] + '</li>';
    });

    // Actualizar el estado del resultado
    result_log.innerHTML = 'Result: ' + spinner_pulse;

    // Realizar la solicitud AJAX para verificar las tablas
    var result = 'testTableList';
    $.post(site_domain + '/execute/action.php', { result: result },
        function (response) {
            var jsonData = JSON.parse(response);
            if (jsonData.success == 1) {
                result_log.innerHTML = 'Result: ' + success_icon + jsonData.message;
                // Actualizar el estado de cada tabla en la lista
				tables_list.innerHTML = '';
                Object.keys(tables).forEach(function(id) {
                    var status = jsonData[id] === 0 ? ' (Undefined)' : ' (Success)';
					var status_icon = jsonData[id] === 0 ? warning_icon : success_icon;
                    tables_list.innerHTML += '<li id="' + id + '">' + status_icon + ' ' + tables[id] + status + '</li>';
                });
                location.href = site_domain + '/install/3';
            } else {
				tables_list.innerHTML = '';
                result_log.innerHTML = 'Result: ' + warning_icon + jsonData.message;
                // Actualizar el estado de cada tabla en la lista
                Object.keys(tables).forEach(function(id) {
					var status = jsonData[id] === 0 ? ' (Undefined)' : ' (Success)';
					var status_icon = jsonData[id] === 0 ? warning_icon : success_icon;
                    tables_list.innerHTML += '<li id="' + id + '">' + status_icon + ' ' + tables[id] + status + '</li>';
                });
            }
        }
    );
}


</script>
<?php
	} else if($page[1] == 3) {
?>

        <div class="card card-md">
          <div class="card-body">
            <h2 class="card-title text-center mb-1">3-Step License Key</h2>
			<h6 class="text-center text-muted mb-4">Start by giving the appropriate permissions to this list and its corresponding file or folder displayed in the list.</h6>
            <div class="mb-4">
				<p>
				To generate a key with just a secret key given by DevByBit.<br>
				<br>
				<b class="text-secondary">Steps:</b><br>
				1. Log in to "<a href="https://devlicense.devbybit.com/" target="_BLANK">admin panel</a>".<br>
				2. Go to "<a href="https://devlicense.devbybit.com/settings" target="_BLANK">My Profile</a>".<br>
				3. Find the "Secret Information" section and copy the key from the "secret" text box<br>
				4. Paste it in the text box below.<br>
				</p>
			</div>
            <div class="mb-4">
              <label class="form-label">Paste here</label>
              <div class="input-group">
                <span class="input-group-text"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class=""><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg></span>
                <input type="text" class="form-control" placeholder="O9RKhsXego3ggmKapl2q4flE2aOSLFZ5" value="" id="license_key">
              </div>
			  <p>Please note that when skipping, you will have to open the config.php and insert the key manually and if you do not have a key for the software, you will have to open a ticket in discord and wait until we give you a key.</p>
            </div>
			
			
			<?php if ($i2 > 0) { ?>
            <div class="text-secondary">
				There are problems with the installed dependencies. It is necessary to have all the dependencies installed to continue. Otherwise Blackout Software will not be able to work.
            </div>
			<?php } else { ?>
            <div class="">
              <a href="<?php echo URI . '/' . $page[0] . '/3/Continue'; ?>" onclick="event.preventDefault(); placeLicenseKey();" class="btn btn-success">
                Save and Continue
              </a>
              <a href="<?php echo URI . '/' . $page[0] . '/3/Skip'; ?>" onclick="event.preventDefault(); location.href = site_domain + '/install/4';" class="btn btn-danger">
                Skip
              </a>
            </div>
			<?php } ?>
          </div>
        </div>
<script>

function placeLicenseKey() {
	var result = 'placeLicenseKey';
    var key = document.getElementById('license_key').value;
    $.post(site_domain + '/execute/action.php', { result: result, key : key },
        function (response) {
			var jsonData = JSON.parse(response);
			if (jsonData.success == 1) {
				var url = "https://devlicense.devbybit.com/license/" + jsonData.id;
				window.open(url, "_blank");
				location.href = site_domain + '/install/4';
			} else {
				alert(jsonData.message);
			}
        }
    );
}

</script>
<?php
	} else if($page[1] == 4) {
?>


        <div class="card card-md">
          <div class="card-body">
            <h2 class="card-title text-center mb-1">4-Step Configuration</h2>
			<h6 class="text-center text-muted mb-4">Start by giving the appropriate permissions to this list and its corresponding file or folder displayed in the list.</h6>
            
			
			<p class="text-warning">You have a detailed guide for installing the system in "<a href="https://docs.devbybit.com/blackout-license-software/installation" target="_BLANK">docs</a>", Review it to check that all the data is correct.</p>
			
            <div class="mb-3">
              <label class="form-label">Name</label>
              <div class="">
				<input type="text" class="form-control" placeholder="Your software name" id="software_name" value="<?php echo SOFTWARE; ?>">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Secret Key</label>
              <div class="">
				<input type="text" class="form-control" placeholder="Use random code and secure." id="secret_key" value="<?php echo randomCodes(32); ?>">
              </div>
            </div>
			
			<hr>
			<h3>Discord Configuration</h3>
            <div class="mb-3">
              <label class="form-label">BOT Token</label>
              <div class="">
				<input type="text" class="form-control" placeholder="<?php echo BOT_TOKEN; ?>" id="BOT_TOKEN">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Client Secret</label>
              <div class="">
				<input type="text" class="form-control" placeholder="<?php echo CLIENT_SECRET; ?>" id="CLIENT_SECRET">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Client ID</label>
              <div class="">
				<input type="text" class="form-control" placeholder="<?php echo CLIENT_ID; ?>" id="CLIENT_ID">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Guild ID</label>
              <div class="">
				<input type="text" class="form-control" placeholder="<?php echo GUILD_ID; ?>" id="GUILD_ID">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Member Role ID</label>
              <div class="">
				<input type="text" class="form-control" placeholder="<?php echo MEMBER_ROLE_ID; ?>" id="MEMBER_ROLE_ID">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">License Actions Webhook (Admin.)</label>
              <div class="">
				<input type="text" class="form-control" placeholder="<?php echo LICENSE_CREATED_WEBHOOK; ?>" id="LICENSE_CREATED_WEBHOOK">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Product Actions Webhook (Admin.)</label>
              <div class="">
				<input type="text" class="form-control" placeholder="<?php echo PRODUCT_CREATED_WEBHOOK; ?>" id="PRODUCT_CREATED_WEBHOOK">
              </div>
            </div>
			
			<hr>
			<h3>Tebex Configuration</h3>
            <div class="mb-3">
              <label class="form-label">Public Key</label>
              <div class="">
				<input type="text" class="form-control" placeholder="<?php echo TEBEX_PUBLIC_KEY; ?>" id="TEBEX_PUBLIC_KEY">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Tebex Webhook Secret</label>
              <div class="">
				<input type="text" class="form-control" placeholder="<?php echo TEBEX_WEBHOOK_SECRET; ?>" id="TEBEX_WEBHOOK_SECRET">
              </div>
            </div>
			
			<hr>
			<h3>TinyMCE Configuration</h3>
            <div class="mb-3">
              <label class="form-label">Key</label>
              <div class="">
				<input type="text" class="form-control" placeholder="<?php echo TINYMCE_KEY; ?>" id="TINYMCE_KEY">
              </div>
            </div>
            <div class="">
              <a href="<?php echo URI . '/' . $page[0] . '/4/Continue'; ?>" onclick="event.preventDefault(); configurations();" id="button_continue" class="btn btn-success">
                Finish
              </a>
            </div>
          </div>
        </div>

<script>

    var spinner_pulse = '<i class="text-warning fa-solid fa-spinner fa-spin-pulse"></i>';
    var warning_icon = '<i class="text-warning fa-solid fa-warning fa-fade"></i>';
    var success_icon = '<i class="text-success fa-solid fa-check fa-shake"></i>';
function configurations() {
	var result = 'configurations';
    var software_name = document.getElementById('software_name').value;
    var secret_key = document.getElementById('secret_key').value;
    var BOT_TOKEN = document.getElementById('BOT_TOKEN').value;
    var CLIENT_SECRET = document.getElementById('CLIENT_SECRET').value;
    var CLIENT_ID = document.getElementById('CLIENT_ID').value;
    var GUILD_ID = document.getElementById('GUILD_ID').value;
    var MEMBER_ROLE_ID = document.getElementById('MEMBER_ROLE_ID').value;
    var TEBEX_PUBLIC_KEY = document.getElementById('TEBEX_PUBLIC_KEY').value;
    var TEBEX_WEBHOOK_SECRET = document.getElementById('TEBEX_WEBHOOK_SECRET').value;
    var TINYMCE_KEY = document.getElementById('TINYMCE_KEY').value;
    var LICENSE_CREATED_WEBHOOK = document.getElementById('LICENSE_CREATED_WEBHOOK').value;
    var PRODUCT_CREATED_WEBHOOK = document.getElementById('PRODUCT_CREATED_WEBHOOK').value;
    $.post(site_domain + '/execute/action.php', { result: result, 
		name: software_name, secret: secret_key, bot_token: BOT_TOKEN, client_secret: CLIENT_SECRET, 
		cliend_id: CLIENT_ID, guild_id: GUILD_ID, member_role: MEMBER_ROLE_ID, tebex_key: TEBEX_PUBLIC_KEY, 
		tebex_webhook: TEBEX_WEBHOOK_SECRET, tinymce: TINYMCE_KEY, 
		license_webhook: LICENSE_CREATED_WEBHOOK, product_webhook: PRODUCT_CREATED_WEBHOOK },
        function (response) {
			var jsonData = JSON.parse(response);
			if (jsonData.success == 1) {
				document.getElementById("button_continue").innerHTML = spinner_pulse;
				setTimeout(function() {
					document.getElementById("button_continue").innerHTML = 'Continue';
					location.href = site_domain + "/auth";
				}, 1500);
			} else {
				alert(jsonData.message);
			}
        }
    );
}

</script>

<?php
	}
?>

      </div>
</div>
<?php
} else {
	echo '<script>location.href="' . URI . '/license"; </script>';
}
?>