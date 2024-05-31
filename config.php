<?php
define('INSTALL_MODE', 1); // (https://docs.devbybit.com/blackout-license-software/installation)
define('DATABASE_CONFIG', 0); 
define('DEBUGG', 0); 
define('TOKEN_STATUS', 0); 

// ============================================================ //
//                    DATABASE CONFIGURATION                    //
// ============================================================ //

define('DB_TYPE', 'MYSQL');// MYSQL, REDIS, JSON OR MONGODB
define('DB_HOST', 'localhost');
define('DB_PORT', 3306); //MYSQL: 3306 / REDIS: 6379
define('DB_DATA', 'devbybit_blackout');
define('DB_USER', 'root');
define('DB_PASSWORD', 'PUT_YOUR_PASSWORD');


// ============================================================ //
//                    BLACKOUT CONFIGURATION                    //
// ============================================================ //

define('URI', 'https://blackout.devbybit.com');
define('ICON', 'https://devlicense.devbybit.com/parent/img/devbybit-logos.png');

define('LICENSE_KEY', 'PUT_YOUR_KEY');

define('SECRET_KEY', '3T71Y5RFNAY00NP6KIU8ISGK51GIJ09U');
define('SOFTWARE', 'Blackout');
define('SOFTWARE_ICON', '🔐');

define('DEFAULT_LANG', 'en_US');
define('DEFAULT_THEME', 'auto');
define('DEFAULT_COLOR', 'auto');

// 0: LOW | SOFTWARE SECRET KEY (https://docs.devbybit.com/blackout-license-software/request/low)
// 1: Normal | SOFTWARE SECRET KEY AND CODE OF REQUEST (https://docs.devbybit.com/blackout-license-software/request/normal)
// 2: High | SOFTWARE CODE OF REQUEST AND SECRET KEY OF USER ACCOUNT (Admin.) (https://docs.devbybit.com/blackout-license-software/request/high)
define('API_SECURITY', 1); 


define('CACHE_ENABLE', false);
define('CACHE_EXPIRATION', 300);//in seconds (3600 = 1hours. 60 = 1minute.)

// When the user registers/logs in on the site, they will be forced to enter the Discord server once they complete the auth.
define('FORCE_JOIN_GUILD', false);


// ============================================================ //
//                   DISCORD CONFIGURATION                      //
// ============================================================ //
// https://docs.devbybit.com/blackout-license-software/installation/setting-up-the-bot
define('BOT_TOKEN', 'PUT_YOUR_BOT_TOKEN');
define('CLIENT_SECRET', 'PUT_YOUR_CLIENT_SECRET');
define('CLIENT_ID', 'PUT_YOUR_CLIENT_ID');

define('GUILD_ID', 'PUT_YOUR_GUILD_ID'); // YOUR SERVER DISCORD ID
define('MEMBER_ROLE_ID', 'PUT_YOUR_MEMBER_ROLE_ID');

define('LICENSE_CREATED_WEBHOOK', 'PUT_YOUR_WEBHOOK');
define('LICENSE_EDITED_WEBHOOK', LICENSE_CREATED_WEBHOOK);
define('LICENSE_ERASED_WEBHOOK', LICENSE_CREATED_WEBHOOK);

define('PRODUCT_CREATED_WEBHOOK', 'PUT_YOUR_WEBHOOK');
define('PRODUCT_EDITED_WEBHOOK', PRODUCT_CREATED_WEBHOOK);
define('PRODUCT_ERASED_WEBHOOK', PRODUCT_CREATED_WEBHOOK);

// ============================================================ //
//                     TEBEX CONFIGURATION                      //
// ============================================================ //
// https://docs.devbybit.com/blackout-license-software/installation/setting-up-the-tebex-api
define('TEBEX_TYPE', 1);
define('TEBEX_PAYMENT', false);
define('TEBEX_PAYMENT_RETURN', true);
define('TEBEX_PUBLIC_KEY', 'PUT_YOUR_PUBLIC_KEY');
define('TEBEX_WEBHOOK_SECRET', 'PUT_YOUR_WEBHOOK_SECRET');

// ============================================================ //
//                     TINYMCE CONFIGURATION                    //
// ============================================================ //
// https://docs.devbybit.com/blackout-license-software/installation/setting-up-the-tinymce
define('TINYMCE_KEY', 'PUT_YOUR_KEY');

// ============================================================ //
//                     TABLERIO CONFIGURATION                   //
// ============================================================ //
define('USE_TABLER_IO', 0);
?>