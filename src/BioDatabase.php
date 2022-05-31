<?php

class BioDatabase {

    /**
     * Creates plugin database tables
     * 
     * Schemas:
     * 
     * links - id, ordem, text, url
     * channels - id, ordem, url, service
     *
     * @return void
     */
    public static function install() {

        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $tableName = $wpdb->prefix . "lwbio_links";

        $sql = "CREATE TABLE $tableName (
		            id mediumint(9) NOT NULL AUTO_INCREMENT,
                    ordem tinyint NOT NULL,
                    text text NOT NULL,		
                    url text NOT NULL,
                    PRIMARY KEY  (id)
	            ) $charset_collate;";
        dbDelta($sql);

        $tableName = $wpdb->prefix . "lwbio_channels";

        $sql = "CREATE TABLE $tableName (
		            id mediumint(9) NOT NULL AUTO_INCREMENT,
                    ordem tinyint NOT NULL,	
                    url text NOT NULL,
                    service text NOT NULL,
                    PRIMARY KEY  (id)
	            ) $charset_collate;";
        dbDelta($sql);
    }

    /**
     * Populates the tables on plugin initialization
     *
     * @return void
     */
    public static function install_data() {

        global $wpdb;
        $tableLinks = $wpdb->prefix . "lwbio_links";
        $tableChannels = $wpdb->prefix . "lwbio_channels";

        $welcome_text = 'Site';
        $welcome_url = get_site_url();

        $wpdb->insert(
            $tableLinks,
            array(
                'ordem' => BioLinks::getMaxOrder() + 1,
                'text' => $welcome_text,
                'url' => $welcome_url,
            )
        );

        $wpdb->insert(
            $tableChannels,
            array(
                'ordem' => BioChannels::getMaxOrder() + 1,
                'url' => $welcome_url,
                'service' => 'wordpress',
            )
        );
    }
}
