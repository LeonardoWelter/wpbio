<?php

/**
 * Plugin Name
 *
 * @package           WPBio
 * @author            LeonardoWelter
 * @copyright         2021 Leonardo Welter
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       WP Bio
 * Plugin URI:        https://github.com/LeonardoWelter/WPBio
 * Description:       Keep all your links in one place.
 * Version:           1.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Leonardo Welter
 * Author URI:        https://github.com/LeonardoWelter/WPBio
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/LeonardoWelter/WPBio
 * Text Domain:       lwbio_links
 * Domain Path:       /languages
 */

defined('ABSPATH') or die('Nope, not accessing this');

require_once("includes/db.php");
require_once("includes/lwbio_icon_handler.php");
require_once("admin/admin.php");

function lwbio_links()
{
	ob_start();
	include dirname(__FILE__) . '/public/lwbio_links_template.php';
	$links_template = ob_get_contents();
	ob_end_clean();

	return $links_template;
}

add_shortcode('lwbio-links', 'lwbio_links');

function lwbio_enqueue()
{
	wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/a5981f4cad.js');
	wp_enqueue_style('lwbio', plugins_url('public/includes/css/lwbio_links.css', __FILE__));
}

function register_lwbio_setting() {
	register_setting( 'lwbio', 'lwbio_logo' );
}

LW_DB::getInstance();

register_activation_hook(__FILE__, ['LW_DB', 'install']);
register_activation_hook(__FILE__, ['LW_DB', 'install_data']);
add_action('wp_enqueue_scripts', 'lwbio_enqueue');
add_action('admin_init', 'register_lwbio_setting');
