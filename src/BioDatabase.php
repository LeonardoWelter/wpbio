<?php

class BioDatabase {

    public static function install() {

        global $wpdb;
        $tableName = $wpdb->prefix . "lw_bio";

        $charset_collate = $wpdb->get_charset_collate();

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $sql = "CREATE TABLE $tableName (
		            id mediumint(9) NOT NULL AUTO_INCREMENT,
		            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                    text text NOT NULL,		
                    url text DEFAULT '' NOT NULL,
                    service text NOT NULL,
                    type tinyint NOT NULL,
                    PRIMARY KEY  (id)
	            ) $charset_collate;";


        dbDelta($sql);
    }

    public static function install_data() {

        global $wpdb;
        $tableName = $wpdb->prefix . "lw_bio";

        $welcome_text = 'Meu primeiro botão';
        $welcome_url = get_site_url();

        $wpdb->insert(
            $tableName,
            array(
                'time' => current_time('mysql'),
                'text' => $welcome_text,
                'url' => $welcome_url,
                'type' => 0,
                'service' => 'link',
            )
        );

        $wpdb->insert(
            $tableName,
            array(
                'time' => current_time('mysql'),
                'text' => 'channel',
                'url' => $welcome_url,
                'type' => 1,
                'service' => 'wordpress',
            )
        );
    }

    public static function index($type = 2) {

        global $wpdb;
        $tableName = $wpdb->prefix . "lw_bio";

        if ($type == 0) {
            $results = $wpdb->get_results("SELECT id, text, url, type, service FROM $tableName WHERE type = 0;", OBJECT);
        } else if ($type == 1) {
            $results = $wpdb->get_results("SELECT id, text, url, type, service FROM $tableName WHERE type = 1;", OBJECT);
        } else if ($type == 2) {
            $results = $wpdb->get_results("SELECT id, text, url, type, service FROM $tableName;", OBJECT);
        }

        return $results;
    }

    public static function show($id) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lw_bio";

        $result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT id, text, url, type, service
               FROM $tableName
               WHERE id = %d",
                $id
            )
        );

        return $result;
    }

    public static function store() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lw_bio";

        $link = $_POST;

        error_log(print_r($link, true));

        $wpdb->insert(
            $tableName,
            array(
                'text' => $link['lwbio_text'],
                'url' => $link['lwbio_url'],
                'type' => $link['lwbio_type'],
                'service' => $link['lwbio_service'],
                'time' => current_time('mysql')
            ),
            array(
                '%s',
                '%s',
                '%d',
                '%s',
                '%s',
            )
        );

        $wpdb->print_error();

        //wp_redirect(admin_url('admin.php?page=lwbio'));
        exit();
    }

    public static function update() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lw_bio";

        $link = $_POST;

        $wpdb->update(
            $tableName,
            array(
                'text' => $link['lwbio_text'],
                'url' => $link['lwbio_url'],
                'service' => $link['lwbio_service'],
            ),
            array('id' => $link['lwbio_id']),
            array(
                '%s',
                '%s',
                '%s',
            ),
            array('%d')
        );

        wp_redirect(admin_url('admin.php?page=lwbio'));
        exit();
    }

    public static function destroy() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lw_bio";

        $link = $_POST;

        $wpdb->delete(
            $tableName,
            array('id' => $link['lwbio_id']),
            array('%d')
        );

        wp_redirect(admin_url('admin.php?page=lwbio'));
        exit();
    }
}
