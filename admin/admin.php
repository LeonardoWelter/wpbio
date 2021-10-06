<?php
add_action('admin_menu', 'lwbio_admin_page');
add_action('admin_enqueue_scripts', 'lwbio_enqueue_admin');
add_action('admin_post_store_link', ['LW_DB', 'store']);
add_action('admin_post_update_link', ['LW_DB', 'update']);
add_action('admin_post_remove_link', ['LW_DB', 'destroy']);

function lwbio_admin_page()
{
	add_menu_page(
		'LW Bio Menu',
		'WP Bio',
		'manage_options',
		'lwbio',
		'lwbio_admin_page_html',
		'dashicons-admin-links',
		20
	);

    add_submenu_page(
		'lwbio',
		'Listar links',
        'Listar links',
		'manage_options',
		'lwbio',
		'lwbio_admin_page_html',
	);

	add_submenu_page(
		'lwbio',
		'Adicionar novo link',
		'Adicionar link',
		'manage_options',
        'lwbio_add',
		'lwbio_add_page_html'
	);

	add_submenu_page(
		'lwbio',
		'Configurações',
		'Configurações',
		'manage_options',
        'lwbio_config',
		'lwbio_config_page_html'
	);

    add_submenu_page(
		null,
		'Editar link',
		'Editar link',
		'manage_options',
        'lwbio_edit',
		'lwbio_edit_page_html'
	);
}

function lwbio_enqueue_admin()
{
	wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/a5981f4cad.js');
	wp_enqueue_script('lwbio_form_js', plugins_url('/includes/js/lwbio_form.js', __FILE__));
	wp_enqueue_style('lwbio_admin', plugins_url('/includes/css/lwbio_admin.css', __FILE__));
}

function lwbio_add_page_html() {
    include dirname(__FILE__) . '/add.php';
}

function lwbio_edit_page_html() {
    include dirname(__FILE__) . '/edit.php';
}

function lwbio_admin_page_html() {
	include dirname(__FILE__) . '/dashboard.php';
}

function lwbio_config_page_html() {
	include dirname(__FILE__) . '/config.php';
}