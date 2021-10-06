<?php

class LW_DB
{

    private static $db;
    private static $table_name;

    public static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        global $wpdb;

        if (!isset(self::$instance)) {
            self::$instance = true;
            self::$db = $wpdb;
            self::$db->show_errors(true);
            self::$table_name = $wpdb->prefix . "lw_bio";
        }

        return self::$instance;
    }

    public static function install()
    {

        $table_name = self::$table_name;

        $charset_collate = self::$db->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
		            id mediumint(9) NOT NULL AUTO_INCREMENT,
		            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                    text text NOT NULL,		
                    url varchar(55) DEFAULT '' NOT NULL,
                    service text NOT NULL,
                    type tinyint NOT NULL,
                    PRIMARY KEY  (id)
	            ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function install_data()
    {

        $table_name = self::$table_name;

        $welcome_text = 'Meu primeiro botão';
        $welcome_url = get_site_url();

        self::$db->insert(
            $table_name,
            array(
                'time' => current_time('mysql'),
                'text' => $welcome_text,
                'url' => $welcome_url,
                'type' => 0,
                'service' => 'link',
            )
        );

        self::$db->insert(
            $table_name,
            array(
                'time' => current_time('mysql'),
                'text' => 'channel',
                'url' => $welcome_url,
                'type' => 1,
                'service' => 'wordpress',
            )
        );
    }

    public static function index($type)
    {
        if ($type == 0) {
            $results = self::$db->get_results("SELECT id, text, url, type, service FROM " . self::$table_name . " WHERE type = 0;", OBJECT);
        } else if ($type == 1) {
            $results = self::$db->get_results("SELECT id, text, url, type, service FROM " . self::$table_name . " WHERE type = 1;", OBJECT);
        }

        return $results;
    }

    public static function show($id)
    {
        $table_name = self::$table_name;

        $result = self::$db->get_row(
            self::$db->prepare(
                "
               SELECT id, text, url, type, service
               FROM $table_name
               WHERE id = %d
               ",
                $id
            )
        );

        return $result;
    }

    public static function store()
    {
        $table_name = self::$table_name;

        $link = $_POST;

        self::$db->query(
            self::$db->prepare(
                "
               INSERT INTO $table_name
               ( time, text, url, type, service )
               VALUES ( %s, %s, %s, %d, %s )
               ",
                current_time('mysql'),
                $link['lwbio_text'],
                $link['lwbio_url'],
                $link['lwbio_type'],
                $link['lwbio_service']
            )
        );

        wp_redirect(admin_url('admin.php?page=lwbio'));
        exit();
    }

    public static function update()
    {
        $link = $_POST;

        self::$db->update( 
            self::$table_name, 
            array( 
                'text' => stripslashes($link['lwbio_text']),
                'url' => stripslashes($link['lwbio_url']),
                'service' => stripslashes($link['lwbio_service']),
            ), 
            array( 'id' => stripslashes($link['lwbio_id'])), 
            array( 
                '%s',
                '%s',
                '%s'
            ), 
            array( '%d' ) 
        );

        wp_redirect(admin_url('admin.php?page=lwbio'));
        exit();
    }

    public static function destroy()
    {
        $link = $_POST;

        self::$db->delete(
            self::$table_name,
            array( 'id' => $link['lwbio_id'] ),
            array( '%d' )
        );

        wp_redirect(admin_url('admin.php?page=lwbio'));
        exit();
    }
}
