<?php


require_once( dirname( __FILE__ ) . '/admin.php' );

wp_redirect( network_admin_url() );
exit;
