<?php
/*
Uninstall logic when WP-Mollom is deleted  through the admin panel(>= WP 2.7)
*/

// do not run unless within the WP plugin flow
if( (!defined("ABSPATH")) && (!defined("WP_UNINSTALL_PLUGIN")) ) {
	define( 'MOLLOM_I8N', 'wp-mollom' );	wp_die(__('The uninstall is not being executed from plugins.php. Halting.', MOLLOM_I8N));
}

// define/init variables we'll need
global $wpdb, $wp_db_version;

// < WP 2.7 don't have their own uninstallation file
if ( 8645 > $wp_db_version ) {
	return;
}

define( 'MOLLOM_TABLE', 'mollom' );

// delete all mollom related options
delete_option('mollom_private_key');delete_option('mollom_public_key');delete_option('mollom_servers');delete_option('mollom_version');delete_option('mollom_count');delete_option('mollom_ham_count');delete_option('mollom_spam_count');delete_option('mollom_unsure_count');delete_option('mollom_count_moderated');delete_option('mollom_reverseproxy');delete_option('mollom_site_policy');delete_option('mollom_reverseproxy_addresses');delete_option('mollom_dbrestore');

// delete MOLLOM_TABLE
$mollom_table = $wpdb->prefix . MOLLOM_TABLE;
$wpdb->query('DROP TABLE IF EXISTS ' . $mollom_table);
?>