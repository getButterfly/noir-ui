<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if (!class_exists('EDD_Theme_Updater_Admin')) {
	include dirname(__FILE__) . '/theme-updater-admin.php';
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(
	// Config settings
	$config = array(
		'remote_api_url' => 'https://getbutterfly.com', // Site where EDD is hosted
		'item_name'      => 'Noir UI', // Name of theme
		'theme_slug'     => 'noir-ui', // Theme slug
		'version'        => '5.6.2', // The current version of this theme
		'author'         => 'getButterfly', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'noir-ui' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'noir-ui' ),
		'license-key'               => __( 'License Key', 'noir-ui' ),
		'license-action'            => __( 'License Action', 'noir-ui' ),
		'deactivate-license'        => __( 'Deactivate License', 'noir-ui' ),
		'activate-license'          => __( 'Activate License', 'noir-ui' ),
		'status-unknown'            => __( 'License status is unknown.', 'noir-ui' ),
		'renew'                     => __( 'Renew?', 'noir-ui' ),
		'unlimited'                 => __( 'unlimited', 'noir-ui' ),
		'license-key-is-active'     => __( 'License key is active.', 'noir-ui' ),
		'expires%s'                 => __( 'Expires %s.', 'noir-ui' ),
		'expires-never'             => __( 'Lifetime License.', 'noir-ui' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'noir-ui' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'noir-ui' ),
		'license-key-expired'       => __( 'License key has expired.', 'noir-ui' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'noir-ui' ),
		'license-is-inactive'       => __( 'License is inactive.', 'noir-ui' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'noir-ui' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'noir-ui' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'noir-ui' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'noir-ui' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'noir-ui' ),
	)
);
