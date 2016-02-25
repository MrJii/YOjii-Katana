<?php

require_once( dirname( dirname( __FILE__ ) ) . '/wp-load.php' );
wp_redirect( admin_url('edit-comments.php?comment_status=moderated') );
exit;
