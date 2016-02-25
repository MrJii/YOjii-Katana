<?php
/**
 * Includes all of the YOjii-Katana Administration API files.
 *
 * @package YOjii-Katana
 * @subpackage Administration
 */

if ( ! defined('WP_ADMIN') ) {
	/*
	 * This file is being included from a file other than wp-admin/admin.php, so
	 * some setup was skipped. Make sure the admin message catalog is loaded since
	 * load_default_textdomain() will not have done so in this context.
	 */
	load_textdomain( 'default', WP_LANG_DIR . '/admin-' . get_locale() . '.mo' );
}

/** YOjii-Katana Bookmark Administration API */
require_once(ABSPATH . 'wp-admin/includes/bookmark.php');

/** YOjii-Katana Comment Administration API */
require_once(ABSPATH . 'wp-admin/includes/comment.php');

/** YOjii-Katana Administration File API */
require_once(ABSPATH . 'wp-admin/includes/file.php');

/** YOjii-Katana Image Administration API */
require_once(ABSPATH . 'wp-admin/includes/image.php');

/** YOjii-Katana Media Administration API */
require_once(ABSPATH . 'wp-admin/includes/media.php');

/** YOjii-Katana Import Administration API */
require_once(ABSPATH . 'wp-admin/includes/import.php');

/** YOjii-Katana Misc Administration API */
require_once(ABSPATH . 'wp-admin/includes/misc.php');

/** YOjii-Katana Plugin Administration API */
require_once(ABSPATH . 'wp-admin/includes/plugin.php');

/** YOjii-Katana Post Administration API */
require_once(ABSPATH . 'wp-admin/includes/post.php');

/** YOjii-Katana Administration Screen API */
require_once(ABSPATH . 'wp-admin/includes/screen.php');

/** YOjii-Katana Taxonomy Administration API */
require_once(ABSPATH . 'wp-admin/includes/taxonomy.php');

/** YOjii-Katana Template Administration API */
require_once(ABSPATH . 'wp-admin/includes/template.php');

/** YOjii-Katana List Table Administration API and base class */
require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
require_once(ABSPATH . 'wp-admin/includes/list-table.php');

/** YOjii-Katana Theme Administration API */
require_once(ABSPATH . 'wp-admin/includes/theme.php');

/** YOjii-Katana User Administration API */
require_once(ABSPATH . 'wp-admin/includes/user.php');

/** YOjii-Katana Update Administration API */
require_once(ABSPATH . 'wp-admin/includes/update.php');

/** YOjii-Katana Deprecated Administration API */
require_once(ABSPATH . 'wp-admin/includes/deprecated.php');

/** YOjii-Katana Multisite support API */
if ( is_multisite() ) {
	require_once(ABSPATH . 'wp-admin/includes/ms.php');
	require_once(ABSPATH . 'wp-admin/includes/ms-deprecated.php');
}
