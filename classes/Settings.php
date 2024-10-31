<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Class WooOneOffEmailsSettings
 *
 * Handles setting up the settings menu and screen.
 *
 */
class WooOneOffEmailsSettings
{

	/**
	 * WooOneOffEmailsSettings constructor.
	 *
	 * Runs on instantiation.
	 *
	 */
	public function __construct()
	{
		// Hooks
		add_action('admin_menu', array($this, 'addMenu'));
	}

	/**
	 * Registers the menu page.
	 *
	 */
	public function addMenu()
	{
		add_submenu_page(
			'woocommerce',
			'WooCommerce One-Off Emails',
			'One-Off Emails',
			'manage_options',
			'wooe-menu',
			array($this, 'addMenuCB')
		);
	}

	/**
	 * Callback for add_submenu_page to display the
	 * settings page.
	 *
	 */
	public function addMenuCB()
	{
		$this->displaySettingsMenu();
	}

	/**
	 * Include the settings menu template.
	 *
	 */
	public function displaySettingsMenu()
	{
		include_once(plugin_dir_path(plugin_dir_path(__FILE__)).'views/settings-view.php');
	}
		
}