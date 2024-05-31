<?php session_start(); ?>

<!DOCTYPE HTML>

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

require_once('config.php');
require_once('function.php');

if (DEBUGG) {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}
$uri = $_SERVER['REQUEST_URI'];
$uri = str_replace('/test/', '', $uri);
$uri = ltrim($uri, '/');
$page = explode('/', $uri);
$codeAuth = explode('?', $uri);

if ($uri === '' || substr($uri, -1) === '/') {
    $archivo = __DIR__ . '/views/index.php';
} else {
    $archivo = __DIR__ . '/views/' . $uri . '.php';
}

$archivosViews = scandir(__DIR__ . '/views');
$infoArchivos = [];

foreach ($archivosViews as $archivoView) {
    if ($archivoView != '.' && $archivoView != '..') {
        $paginaFile = __DIR__ . '/views/' . $archivoView;

        if (file_exists($paginaFile)) {
            $content = file_get_contents($paginaFile);
            preg_match('/\$pagename\s*=\s*\'([^\']+)\'/', $content, $matchesName);
            preg_match('/\$pageicon\s*=\s*\'([^\']+)\'/', $content, $matchesIcon);
            preg_match('/\$position\s*=\s*\'([^\']+)\'/', $content, $matchesPosition);
            preg_match('/\$pageview\s*=\s*\'([^\']+)\'/', $content, $matchesViews);
            preg_match('/\$auth\s*=\s*\'([^\']+)\'/', $content, $matchesAuth);
            preg_match('/\$permission\s*=\s*\'([^\']+)\'/', $content, $matchesPermission);
            preg_match('/\$install\s*=\s*\'([^\']+)\'/', $content, $matchesInstall);
            preg_match('/\$tabicon\s*=\s*\'([^\']+)\'/', $content, $matchesTabicon);

            $pageName = (!empty($matchesName[1])) ? lang($messages, $matchesName[1], 'header', 'name') : 'Unknown';
            $pageIcon = (!empty($matchesIcon[1])) ? lang($messages, $matchesIcon[1], 'header', 'icon') : 'circle-question';
            $pageViews = (!empty($matchesViews[1])) ? $matchesViews[1] : false;
            $auth = (!empty($matchesAuth[1])) ? $matchesAuth[1] : false;
            $permission = (!empty($matchesPermission[1])) ? $matchesPermission[1] : false;
            $install = (!empty($matchesInstall[1])) ? $matchesInstall[1] : false;
            $tabicon = (!empty($matchesTabicon[1])) ? $matchesTabicon[1] : false;
            $position = (!empty($matchesPosition[1])) ? intval($matchesPosition[1]) : 999;

            $infoArchivos[] = [
                'name' => $pageName,
                'icon' => $pageIcon,
                'view' => $pageViews,
                'position' => $position,
                'auth' => $auth,
                'permission' => $permission,
                'install' => $install,
                'tabicon' => $tabicon,
                'file' => $archivoView,
            ];
        }
    }
}

usort($infoArchivos, function ($a, $b) {
    if ($a['position'] == $b['position']) {
        return 0;
    }
    return ($a['position'] < $b['position']) ? -1 : 1;
});

if (INSTALL_MODE AND $page[0] != 'install') {
	echo '<script> location.href = "' . URI . '/install"; </script>';
}

if (!isset($_SESSION['dbb_user']) AND $page[0] != 'auth') {
	echo '<script> location.href = "' . URI . '/auth"; </script>';
}

if (isset($_SESSION['dbb_user']) AND $page[0] == 'auth') {
	echo '<script> location.href = "' . URI . '/license"; </script>';
}

$pageContent = '';

if (CACHE_ENABLE && isset($_SESSION['cached_' . $uri])) {
    $pageContent = $_SESSION['cached_' . $uri];
} else {
    ob_start();

    ?>
<html lang="en" data-bs-theme="<?php echo ($_COOKIE['theme'] == 'dark') ? 'dark' : 'light'; ?>"
          data-dbb-scroll="custom" data-dbb-page="<?php echo ($_COOKIE['theme'] == 'dark') ? 'dark' : 'light'; ?>">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	
	<?php foreach ($infoArchivos as $pageTitle) {
		$pageview = ($pageTitle['file'] !== 'index.php') ? str_replace('.php', '', $pageTitle['file']) : '';
		if ($pageview == $page[0]) {
			echo '<title>' . SOFTWARE . ' - ' . $pageTitle['name'] . '</title>';
			echo '<meta name="description" content="Blackout, licensing software created by DevByBit to simplify software license management.">';
			echo '<meta property="og:title" content="Blackout - Manage License Software">';
			echo '<meta property="og:description" content="Blackout, licensing software created by DevByBit to simplify software license management.">';
			echo '<meta property="og:image" content="https://devbybit.com/images/Gif-Pages-Blackout.gif">';
			?>
			
			<meta property="twitter:card" content="summary_large_image" />
			<meta property="twitter:url" content="<?php echo URI; ?>" />
			<meta property="twitter:title" content="DevByBit - Blackout Software" />
			<meta property="twitter:description" content="A professional licensing system aims to protect all your products and provide you with ease of use. Exactly Blackout Software" />
			<meta property="twitter:image" content="https://devbybit.com/images/Gif-Pages-Blackout.gif" />
			
			<?php
		}
	} ?>
	<link rel="icon" type="image/x-icon" href="<?php echo ICON; ?>">
	<script>
	var site_domain = '<?php echo URI; ?>';
	var langList = '<?php echo $messages; ?>';
	var cached = '<?php echo CACHE_ENABLE; ?>';
	var addons_cache = '<?php echo $addons_bsd; ?>';
	var isUser = '<?php echo (isset($_SESSION['dbb_user'])) ? 1 : 0; ?>';
	var isTheme = '<?php echo ($_COOKIE['theme'] == 'dark') ? 'dark' : 'light'; ?>';
	var isThemeDarkIcon = '<?php echo $theme_is_dark; ?>';
	var isThemeLightIcon = '<?php echo $theme_is_light; ?>';
	var langSystem_erase_secure_title = "<?php echo lang($messages, 'erase', 'secure', 'title'); ?>";
	var langSystem_erase_secure_subtitle = "<?php echo lang($messages, 'erase', 'secure', 'subtitle'); ?>";
	var langSystem_erase_secure_type = "<?php echo lang($messages, 'erase', 'secure', 'type'); ?>";
	var langSystem_erase_secure_button = "<?php echo lang($messages, 'erase', 'secure', 'button'); ?>";
	var langSystem_clone_secure_title = "<?php echo lang($messages, 'clone', 'secure', 'title'); ?>";
	var langSystem_clone_secure_subtitle = "<?php echo lang($messages, 'clone', 'secure', 'subtitle'); ?>";
	var langSystem_clone_secure_type = "<?php echo lang($messages, 'clone', 'secure', 'type'); ?>";
	var langSystem_clone_secure_button = "<?php echo lang($messages, 'clone', 'secure', 'button'); ?>";
	document.addEventListener('DOMContentLoaded', function() {
	$(function () { $('[data-toggle="tooltip"]').tooltip() })
	});

	</script>
    <link rel="stylesheet" href="<?php echo URI; ?>/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="https://devbybit.com/css/root.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="https://devbybit.com/admin/snipped.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="https://devbybit.com/snipped.css?<?php echo time(); ?>">
	<?php if (!USE_TABLER_IO) { ?><link rel="stylesheet" href="https://devbybit.com/css/bootstrap.css?<?php echo time(); ?>"><?php } else { ?>
    <link href="https://devbybit.com/demos/tablerio/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="https://devbybit.com/demos/tablerio/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="https://devbybit.com/demos/tablerio/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="https://devbybit.com/demos/tablerio/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="https://devbybit.com/demos/tablerio/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
	<?php } ?>
    <script src="https://kit.fontawesome.com/37c2572d14.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdn.tiny.cloud/1/<?php echo TINYMCE_KEY; ?>/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
	<?php if (!USE_TABLER_IO) { ?><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script><?php } ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <script src="<?php echo URI; ?>/js/script.js?<?php echo time(); ?>"></script>
    <script src="https://devbybit.com/js/alert.js?<?php echo time(); ?>"></script>
	<script src="http://SortableJS.github.io/Sortable/Sortable.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.css">
    </head>
    <body>
    <header data-margins="true" class="r-1xc7w19 r-1phboty r-1yadl64 r-deolkf r-6koalj r-1mlwlqe r-1q142lx r-crgep1 r-ifefl9 r-bcqeeo r-t60dpp r-1efo1hp r-qklmqi r-gtdqiz r-ipm5af r-184en5c r-18u37iz r-1awozwy snipcss-5grzD style-yXyQT"
            id="style-yXyQT">
        <div class="view_manYY publicContainer_11UZS horizontal200_M-XNg alignItemsCenter_Si4Gd withStickyHeader_HQiM-">
            <div class="css-1rynq56 r-1udh08x d-flex justify-content-center align-items-center">
                <a href="<?php echo $devbybit_link; ?>" target="_BLANK"><span class="img-bls"><?php echo SOFTWARE_ICON; ?></span> <?php echo SOFTWARE; ?></a>

            </div>
            <?php if (isset($_SESSION['dbb_user'])) { ?>
                <div class="r-16y2uox"></div>
                <button class="btn-a-suave mr-2 d-none d-xl-block" id="theme_icon">
                    <?php
                    if ($_COOKIE['theme'] == 'light') {
                        echo $theme_is_light;
                    } else {
                        echo $theme_is_dark;
                    }
                    ?>
                </button>
                <button type="button"
                        class="btn-a-suave <?php echo ($_COOKIE['sidebar_toggle']) ? 'active' : ''; ?> sidebar_toggle mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="icon icon-tabler icon-tabler-layout-sidebar-left-collapse"
                         style="width: 24px !important; height: 24px !important;" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"/><path
                                d="M9 4v16"/><path d="M15 10l-2 2l2 2"/></svg>
                </button>

                <div class="btn-group">
                    <a href="#" class="btn-a-suave d-none d-xl-block" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="icon icon-tabler icon-tabler-flag-cog"
                             style="width: 24px !important; height: 24px !important;" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                    d="M12.901 14.702a5.014 5.014 0 0 1 -.901 -.702a5 5 0 0 0 -7 0v-9a5 5 0 0 1 7 0a5 5 0 0 0 7 0v6.5"/><path
                                    d="M5 21v-7"/><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path
                                    d="M19.001 15.5v1.5"/><path d="M19.001 21v1.5"/><path
                                    d="M22.032 17.25l-1.299 .75"/><path d="M17.27 20l-1.3 .75"/><path
                                    d="M15.97 17.25l1.3 .75"/><path d="M20.733 20l1.3 .75"/></svg>
                    </a>
                    <div class="dropdown-menu p-2 rounded-3 mx-0 border-0 shadow w-220px">
                        <ul class="list-unstyled mb-0">

                            <?php

                            foreach (langList() as $list_lang) {
                                $select = ($list_lang['data'] == $_SESSION['lang']) ? 'active' : '';
                                echo '<li><a class="languages dropdown-item d-flex align-items-center gap-2 py-2 rounded-2 ' . $select . '" href="#" data-id="' . $list_lang['data'] . '"><img src="https://flagcdn.com/w160/' . $list_lang['flag'] . '.png" alt="' . $list_lang['name'] . '" style="width: 24px; height: 24px; border-radius: 7px;">' . $list_lang['name'] . '</a></li>';
                            }

                            ?>
                        </ul>
                    </div>
                </div>

                <div class="css-175oi2r r-1jj8364 r-puj83k r-1pyaxff r-11xdecz r-1ro0kt6 r-16y2uox r-1wbh5a2 d-flex justify-content-center align-items-center ">

                    <div class="btn-group">
                        <a href="#" class="nav-link d-flex justify-content-center align-items-center lh-1 text-reset p-0"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo userDev('avatar', $_SESSION['dbb_user']['id']); ?>"
                                 style="border-radius: 5px; width: 40px;"/>
                            <div class="d-none d-xl-block ps-2">
                                <div><?php echo userDev('username', $_SESSION['dbb_user']['id']); ?></div>
                                <div class="mt-1 small text-muted"
                                     style="color: <?php echo rank('color', $_SESSION['dbb_user']['id']); ?> !important;"><?php echo rank('name', $_SESSION['dbb_user']['id']); ?></div>
                            </div>
                        </a>
                        <div class="dropdown-menu p-2 rounded-3 mx-0 border-0 shadow w-220px">
                            <ul class="list-unstyled mb-0">
                                <li><a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-2"
                                       href="#" id="toggle_theme">
                                        <span class="d-inline-block bg-white rounded-circle p-1"></span>
                                        <?php echo lang($messages, 'dropdown', 'toggle'); ?>
                                    </a></li>
                                <li><a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-2"
                                       href="<?php echo URI; ?>/settings">
                                        <span class="d-inline-block bg-info rounded-circle p-1"></span>
                                        <?php echo lang($messages, 'dropdown', 'profile'); ?>
                                    </a></li>
                                <li><a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-2"
                                       href="#" onclick="logoutSession();">
                                        <span class="d-inline-block bg-danger rounded-circle p-1"></span>
                                        <?php echo lang($messages, 'dropdown', 'logout'); ?>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </header>
    <div class="sidebar <?php echo ($_COOKIE['sidebar_toggle'] AND isset($_SESSION['dbb_user'])) ? 'show' : ''; ?>"
         id="sidebar">
        <ul class="dbb_nav">
            <?php
            foreach ($infoArchivos as $infoArchivo) {

                $pageview = ($infoArchivo['file'] !== 'index.php') ? str_replace('.php', '', $infoArchivo['file']) : '';
                $thisArchivo = ($pageview == $page[0]) ? 'active' : '';
                $li_design = '<li><a href="' . URI . '/' . $pageview . '" class="change-page ' . $thisArchivo . ' d-flex justify-content-left align-items-center lh-1 text-reset"><i class="ti ti-' . $infoArchivo['icon'] . '" style="font-size: 26px !important;"></i>' . $infoArchivo['name'] . '</a></li>';
                
				if (!TEBEX_PAYMENT AND $infoArchivo['file'] == 'basket.php') {
					continue; 
				}
				
				if (isset($_SESSION['dbb_user'])) {
                    if (INSTALL_MODE) {
                        if ($infoArchivo['install']) {
                            echo $li_design;
                        }
                    } else if ($infoArchivo['view']) {
                        if (!empty($infoArchivo['permission'])) {
                            if (has($infoArchivo['permission'])) {
                                echo $li_design;
                            }
                        } else {
                            echo $li_design;
                        }
					}
                } else {
                    if (INSTALL_MODE) {
                        if ($infoArchivo['install']) {
                            echo $li_design;
                        }
                    } else if ($infoArchivo['auth']) {
                        echo $li_design;
                    }
                }

            }
            ?>
        </ul>
    </div>

    <div class="content <?php echo ($_COOKIE['sidebar_toggle'] AND isset($_SESSION['dbb_user'])) ? 'show' : ''; ?>"
         id="content">

        <?php
		if (!INSTALL_MODE) {
			if (TOKEN_STATUS) {
				if (!sessions($_COOKIE['dbb_token']) AND !$page[0] == 'auth') {
					echo '<h4><i class="text-warning fa fa-warning"></i> Your session has expired. Please start again.</h4> <script> location.href = "' . URI . '/auth"; </script>';
					return;
				}
			}
		}
        if (file_exists($archivo)) {
            require_once($archivo);
        } else if (file_exists(__DIR__ . '/views/' . $page[0] . '.php')) {
            require_once(__DIR__ . '/views/' . $page[0] . '.php');
        } else if (file_exists(__DIR__ . '/views/' . $codeAuth[0] . '.php')) {
            require_once(__DIR__ . '/views/' . $codeAuth[0] . '.php');
        } else {
            echo $page_not_found;
        }
        ?>
    </div>

    <script>

        var links = document.querySelectorAll('.change-page');
        links.forEach(function (link) {
            link.addEventListener('click', function () {
                document.getElementById('content').classList.add('loading');
                document.getElementById('loader').style.display = 'block';
            });
        });

        window.addEventListener('load', function () {
            document.getElementById('content').classList.remove('loading');
            document.getElementById('loader').style.display = 'none';
        });
    </script>
    </body>

    <?php if (USE_TABLER_IO) { ?><script src="https://devbybit.com/demos/tablerio/dist/js/tabler.min.js?1684106062" defer></script><?php } ?>
    </html>

    <?php
    $pageContent = ob_get_clean();
    if (CACHE_ENABLE) {
        $_SESSION['cached_' . $uri] = $pageContent;
    }
}

echo $pageContent;
?>
