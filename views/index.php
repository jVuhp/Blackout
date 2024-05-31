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
$pagename = 'dashboard';
$pageicon = 'dashboard';
$position = '1';
$pageview = '0';
$permission = '';

if (!INSTALL_MODE) {
	echo '<script>location.href="' . URI . '/license"; </script>';
} else {
	echo '<script>location.href="' . URI . '/install"; </script>';
}
?>