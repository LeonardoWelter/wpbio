<?php
add_action('admin_menu', 'lwbio_admin_page');
add_action('admin_post_link_store', ['BioLinks', 'store']);
add_action('admin_post_link_update', ['BioLinks', 'update']);
add_action('admin_post_link_remove', ['BioLinks', 'destroy']);
add_action('admin_post_link_order', ['BioLinks', 'changeOrder']);
add_action('admin_post_channel_store', ['BioChannels', 'store']);
add_action('admin_post_channel_update', ['BioChannels', 'update']);
add_action('admin_post_channel_remove', ['BioChannels', 'destroy']);
add_action('admin_post_channel_order', ['BioChannels', 'changeOrder']);

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
        'Meus links',
		'manage_options',
		'lwbio',
		'lwbio_admin_page_html',
	);

	add_submenu_page(
		'lwbio',
		'Adicionar novo link',
		'Novo link',
		'manage_options',
        'lwbio_add',
		'lwbio_links_add_page_html'
	);

	add_submenu_page(
		null,
		'Editar link',
		'Editar link',
		'manage_options',
        'lwbio_link_edit',
		'lwbio_links_edit_page_html'
	);

	add_submenu_page(
		null,
		'Editar rede',
		'Editar rede',
		'manage_options',
        'lwbio_channel_edit',
		'lwbio_channels_edit_page_html'
	);

	add_submenu_page(
		'lwbio',
		'Configurações',
		'Configurações',
		'manage_options',
        'lwbio_config',
		'lwbio_config_page_html'
	);

}

function lwbio_links_add_page_html() {
    include dirname(__FILE__) . '/add.php';
}

function lwbio_links_edit_page_html() {
    include dirname(__FILE__) . '/links/edit.php';
}

function lwbio_channels_edit_page_html() {
    include dirname(__FILE__) . '/channels/edit.php';
}

function lwbio_admin_page_html() {
	include dirname(__FILE__) . '/dashboard.php';
}

function lwbio_config_page_html() {
	include dirname(__FILE__) . '/config.php';
}