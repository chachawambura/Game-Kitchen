<?php
define('SYSTEM_EMAIL', 'admin@gamingkitchen.co.ke' );
define('NOREPLY_EMAIL', 'noreply@admin@gamingkitchen.co.ke' );

define( 'PAGE',  $_REQUEST['act'] );
define( 'USRLVL',  $_SESSION['userlevel'] );
define( 'MYID',  $_SESSION['myid'] );

define( 'SESSION_DURATION',  60 );
define( 'GAME_DURATION',  120 );
define( 'MIN_ENTRY_FEE',  100 ); // 
define( 'MIN_BALANCE_FEE', 0 ); // 
define( 'PERCENT_COMMISSION',  5 ); // 
define( 'GAMES_ICONS_FOLDER',  'public' . DS . 'media' . DS . 'games-icons' . DS );
define( 'NO_IMAGE',  'public' . DS . 'media' . DS . 'no-image.jpg' );

date_default_timezone_set('Africa/Nairobi');
?>
