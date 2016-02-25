<?php

 $menu[2] = array( __('View Reservations'), 'read', 'admin.php?page=dopbsp-reservations', '', 'menu-top menu-top-first menu-icon-dashboard', 'menu-dashboard', 'dashicons-dashboard' );
 $menu[3] = array( __('Room Settings'), 'read', 'admin.php?page=dopbsp-calendars', '', 'menu-top menu-top-first menu-icon-calendar', 'menu-dashboard', 'dashicons-calendar' );
// $menu[4] = array( __('Extra Orders'), 'read', 'admin.php?page=dopbsp-extras', '', 'menu-top menu-top-first menu-icon-user', 'menu-dashboard', 'dashicons-admin-page' );
// $menu[71] = array( __('Sign Out'), 'dashboard.php?action=logout&_wpnonce=e49bc2ecfe', '', 'menu-top menu-top-first menu-icon-user', 'menu-dashboard', 'dashicons-admin-page' );
$menu[6] = array( '', 'read', 'separator1', '', 'wp-menu-separator' );

$menu[5] = array( __('View Articles'), 'edit_posts', 'edit.php', '', 'open-if-no-js menu-top menu-icon-post', 'menu-posts', 'dashicons-admin-post' );
	$submenu['edit.php'][5]  = array( __('All Article Posts'), 'edit_posts', 'edit.php' );
	/* translators: add new post */
	$submenu['edit.php'][10]  = array( _x('Create Articles', 'post'), get_post_type_object( 'post' )->cap->create_posts, 'post-new.php' );

require_once(ABSPATH . 'wp-admin/includes/menu.php');

	$i = 15;
	foreach ( get_taxonomies( array(), 'objects' ) as $tax ) {
		if ( ! $tax->show_ui || ! $tax->show_in_menu || ! in_array('post', (array) $tax->object_type, true) )
			continue;

		$submenu['edit.php'][$i++] = array( esc_attr( $tax->labels->menu_name ), $tax->cap->manage_terms, 'edit-tags.php?taxonomy=' . $tax->name );
	}
	unset($tax);

	foreach ( get_taxonomies_for_attachments( 'objects' ) as $tax ) {
		if ( ! $tax->show_ui || ! $tax->show_in_menu )
			continue;

		$submenu['upload.php'][$i++] = array( esc_attr( $tax->labels->menu_name ), $tax->cap->manage_terms, 'edit-tags.php?taxonomy=' . $tax->name . '&amp;post_type=attachment' );
	}
	unset($tax);
$i = 15;
	foreach ( get_taxonomies( array(), 'objects' ) as $tax ) {
		if ( ! $tax->show_ui || ! $tax->show_in_menu  || ! in_array('page', (array) $tax->object_type, false) )
			continue;

		$submenu['edit.php?post_type=page'][$i++] = array( esc_attr( $tax->labels->menu_name ), $tax->cap->manage_terms, 'edit-tags.php?taxonomy=' . $tax->name . '&amp;post_type=page' );
	}
	unset($tax);

$awaiting_mod = wp_count_comments();
$awaiting_mod = $awaiting_mod->moderated;

unset($awaiting_mod);

$_wp_last_object_menu = 25; // The index of the last top-level menu in the object menu group

foreach ( (array) get_post_types( array('show_ui' => false, '_builtin' => false, 'show_in_menu' => false ) ) as $ptype ) {
	$ptype_obj = get_post_type_object( $ptype );
	// Check if it should be a submenu.
	if ( $ptype_obj->show_in_menu !== false )
		continue;
	$ptype_menu_position = is_int( $ptype_obj->menu_position ) ? $ptype_obj->menu_position : ++$_wp_last_object_menu; // If we're to use $_wp_last_object_menu, increment it first.
	$ptype_for_id = sanitize_html_class( $ptype );

	if ( is_string( $ptype_obj->menu_icon ) ) {
		// Special handling for data:image/svg+xml and Dashicons.
		if ( 0 === strpos( $ptype_obj->menu_icon, 'data:image/svg+xml;base64,' ) || 0 === strpos( $ptype_obj->menu_icon, 'dashicons-' ) ) {
			$menu_icon = $ptype_obj->menu_icon;
		} else {
			$menu_icon = esc_url( $ptype_obj->menu_icon );
		}
		$ptype_class = $ptype_for_id;
	} else {
		$menu_icon   = 'dashicons-admin-post';
		$ptype_class = 'post';
	}

	/*
	 * If $ptype_menu_position is already populated or will be populated
	 * by a hard-coded value below, increment the position.
	 */
	$core_menu_positions = array(59, 60, 65, 70, 75, 80, 85, 99);
	while ( isset($menu[$ptype_menu_position]) || in_array($ptype_menu_position, $core_menu_positions) )
		$ptype_menu_position++;

	$menu[$ptype_menu_position] = array( esc_attr( $ptype_obj->labels->menu_name ), $ptype_obj->cap->edit_posts, "edit.php?post_type=$ptype", '', 'menu-top menu-icon-' . $ptype_class, 'menu-posts-' . $ptype_for_id, $menu_icon );
	$submenu["edit.php?post_type=$ptype"][5]  = array( $ptype_obj->labels->all_items, $ptype_obj->cap->edit_posts,  "edit.php?post_type=$ptype");
	$submenu["edit.php?post_type=$ptype"][10]  = array( $ptype_obj->labels->add_new, $ptype_obj->cap->create_posts, "post-new.php?post_type=$ptype" );

	$i = 15;
	foreach ( get_taxonomies( array(), 'objects' ) as $tax ) {
		if ( ! $tax->show_ui || ! $tax->show_in_menu || ! in_array($ptype, (array) $tax->object_type, true) )
			continue;

		$submenu["edit.php?post_type=$ptype"][$i++] = array( esc_attr( $tax->labels->menu_name ), $tax->cap->manage_terms, "edit-tags.php?taxonomy=$tax->name&amp;post_type=$ptype" );
	}
}

unset($ptype, $ptype_obj, $ptype_class, $ptype_for_id, $ptype_menu_position, $menu_icon, $i, $tax);

$appearance_cap = current_user_can( 'switch_themes') ? 'switch_themes' : 'edit_theme_options';

$menu[60] = array( __('Site Configurations'), $appearance_cap, 'themes.php', '', 'menu-top menu-icon-appearance', 'menu-appearance', 'dashicons-admin-appearance' );
	$submenu['themes.php'][5] = array( __( 'Style Options' ), $appearance_cap, 'themes.php' );
	$menu[20] = array( __('Content Layout'), 'edit_pages', 'edit.php?post_type=page', '', 'menu-top menu-icon-page', 'menu-pages', 'dashicons-admin-page' );
	$customize_url = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
	$submenu['themes.php'][6] = array( __( 'Personalize' ), 'customize', $customize_url, '', 'hide-if-no-customize' );
	unset( $customize_url );
	if ( current_theme_supports( 'menus' ) || current_theme_supports( 'widgets' ) ) {
		$submenu['themes.php'][10] = array(__( 'Navigation' ), 'edit_theme_options', 'nav-menus.php');
	}

unset( $appearance_cap );

// Add 'Editor' to the bottom of the Appearance menu.
if ( ! is_multisite() )
	add_action('admin_menu', '_add_themes_utility_last', 101);
function _add_themes_utility_last() {
	// Must use API on the admin_menu hook, direct modification is only possible on/before the _admin_menu hook
	
}

$count = '';
if ( ! is_multisite() && current_user_can( 'update_plugins' ) ) {
	if ( ! isset( $update_data ) )
		$update_data = wp_get_update_data();
	$count = "<span class='update-plugins count-{$update_data['counts']['plugins']}'><span class='plugin-count'>" . number_format_i18n($update_data['counts']['plugins']) . "</span></span>";
}
	if ( ! is_multisite() ) {
	}
unset( $update_data );



if ( current_user_can('list_users') )
	$menu[70] = array( __('Manage Users'), 'list_users', 'users.php', '', 'menu-top menu-icon-users', 'menu-users', 'dashicons-admin-users' );
else
	$menu[70] = array( __('Profile'), 'read', 'profile.php', '', 'menu-top menu-icon-users', 'menu-users', 'dashicons-admin-users' );

if ( current_user_can('list_users') ) {
	$_wp_real_parent_file['profile.php'] = 'users.php'; // Back-compat for plugins adding submenus to profile.php.
	$submenu['users.php'][5] = array(__('All Users'), 'list_users', 'users.php');
	if ( current_user_can('create_users') )
		$submenu['users.php'][10] = array(_x('Add New', 'user'), 'create_users', 'user-new.php');
	else
		$submenu['users.php'][10] = array(_x('Add New', 'user'), 'promote_users', 'user-new.php');

	$submenu['users.php'][15] = array(__('Your Profile'), 'read', 'profile.php');
} else {
	$_wp_real_parent_file['users.php'] = 'profile.php';
	$submenu['profile.php'][5] = array(__('Your Profile'), 'read', 'profile.php');
	if ( current_user_can('create_users') )
		$submenu['profile.php'][10] = array(__('Add New User'), 'create_users', 'user-new.php');
	else
		$submenu['profile.php'][10] = array(__('Add New User'), 'promote_users', 'user-new.php');
}
	if ( is_multisite() && !is_main_site() )
	
	if ( ! is_multisite() && defined('WP_ALLOW_MULTISITE') && WP_ALLOW_MULTISITE )
	

$_wp_last_utility_menu = 80; // The index of the last top-level menu in the utility menu group

$menu[99] = array( '', 'read', 'separator-last', '', 'wp-menu-separator' );

// Back-compat for old top-levels
$_wp_real_parent_file['post.php'] = 'edit.php';
$_wp_real_parent_file['post-new.php'] = 'edit.php';
$_wp_real_parent_file['edit-pages.php'] = 'edit.php?post_type=page';
$_wp_real_parent_file['page-new.php'] = 'edit.php?post_type=page';
$_wp_real_parent_file['wpmu-admin.php'] = 'tools.php';
$_wp_real_parent_file['ms-admin.php'] = 'tools.php';

// ensure we're backwards compatible
$compat = array(
	'index' => 'dashboard',
	'edit' => 'posts',
	'post' => 'posts',
	'upload' => 'media',
	'link-manager' => 'links',
	'edit-pages' => 'pages',
	'page' => 'pages',
	'edit-comments' => 'comments',
	'options-general' => 'settings',
	'themes' => 'appearance',
	);
