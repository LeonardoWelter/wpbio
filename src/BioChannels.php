<?php

class BioChannels {

    /**
     * Returns all results from lwbio_channels table
     *
     * @return array Channels Objects
     */
    public static function index() {

        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_channels";

        $results = $wpdb->get_results(
            "SELECT id, ordem, url, service 
            FROM $tableName 
            ORDER BY ordem;", 
            OBJECT
        );

        return $results;
    }

    /**
     * Return a Channel based on the specified ID
     *
     * @param integer $id Channel ID
     * @return Object Channel Object
     */
    public static function show(int $id) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_channels";

        $result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT id, ordem, url, service
                FROM $tableName
                WHERE id = %d",
                $id
            )
        );

        return $result;
    }

    /**
     * Handles the channel_store admin post route, redirects on execution
     *
     * @return void
     */
    public static function store() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_channels";

        $channel = $_POST;

        $wpdb->insert(
            $tableName,
            array(
                'ordem' => self::getMaxOrder() + 1,
                'url' => $channel['lwbio_url'],
                'service' => $channel['lwbio_service'],
            ),
            array(
                '%d',
                '%s',
                '%s',
            )
        );

        wp_redirect(admin_url('admin.php?page=lwbio'));
        exit();
    }

    /**
     * Handles the channel_update admin post route, redirects on execution
     *
     * @return void
     */
    public static function update() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_channels";

        $channel = $_POST;

        $wpdb->update(
            $tableName,
            array(
                'url' => $channel['lwbio_url'],
                'service' => $channel['lwbio_service'],
            ),
            array('id' => $channel['lwbio_id']),
            array(
                '%s',
                '%s',
            ),
            array('%d')
        );

        wp_redirect(admin_url('admin.php?page=lwbio'));
        exit();
    }

    /**
     * Handles the channel_remove admin post route, redirects on execution
     *
     * @return void
     */
    public static function destroy() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_channels";

        $channel = $_POST;

        $wpdb->delete(
            $tableName,
            array('id' => $channel['lwbio_id']),
            array('%d')
        );

        wp_redirect(admin_url('admin.php?page=lwbio'));
        exit();
    }

    /**
     * Returns the maximum order number of all channels
     *
     * @return int Maximum order number
     */
    public static function getMaxOrder() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_channels";

        $result = $wpdb->get_row(
            "SELECT MAX(ordem) as ordem 
            FROM $tableName"
        );

        if (is_null($result->ordem)) {
            return 1;
        } else {
            return $result->ordem;
        }
    }

    /**
     * Returns a Channel Object based on its Order number
     *
     * @param integer $order Order Number
     * @return Object Channel
     */
    public static function getChannelByOrder(int $order) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_channels";

        $result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT id, ordem, service, url
                FROM $tableName
                WHERE ordem = %d",
                $order
            )
        );

        return $result;
    }

    /**
     * Returns the order number of a Channel based on ID
     *
     * @param integer $id Channel ID
     * @return int Order number
     */
    public static function getOrderById(int $id) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_channels";

        $result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT ordem
                FROM $tableName
                WHERE id = %d",
                $id
            )
        );

        return $result->ordem;
    }

    /**
     * Changes the Order of given Channels, handles channel_order admin post route
     *
     * @return void
     */
    public static function changeOrder() {
        $action = $_POST['channel_action'];
        $channelId = $_POST['channel_id'];

        $channel = self::show($channelId);

        if ($action == 'channel_up') {
            // decrease
            if ($channel->ordem == '1') {
                error_log("Já está na primeira posição");
                wp_redirect(admin_url('admin.php?page=lwbio'));
                exit();
            }

            $aboveChannel = self::getChannelByOrder($channel->ordem - 1);
            
            if (is_null($aboveChannel)) {
                error_log('Nada acima');
                self::decreaseOrder($channel->id);
            } else {
                error_log('Alterando posições');
                self::increaseOrder($aboveChannel->id);
                self::decreaseOrder($channel->id);
            }

            error_log("Posição alterada.");
            wp_redirect(admin_url('admin.php?page=lwbio'));
            exit();

        } else if ($action == 'channel_down') {
            // increase
            if ($channel->ordem == self::getMaxOrder()) {
                error_log("Já está na última posição");
                wp_redirect(admin_url('admin.php?page=lwbio'));
                exit();
            }

            $belowChannel = self::getChannelByOrder($channel->ordem + 1);
            
            if (is_null($belowChannel)) {
                error_log('Nada abaixo');
                self::increaseOrder($channel->id);
            } else {
                error_log('Alterando posições');
                self::decreaseOrder($belowChannel->id);
                self::increaseOrder($channel->id);
            }

            error_log("Posição alterada.");
            wp_redirect(admin_url('admin.php?page=lwbio'));
            exit();
        }
    }

    /**
     * Increases the Order number of a Channel by 1
     *
     * @param integer $id Channel ID
     * @return void
     */
    public static function increaseOrder(int $id) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_channels";

        $channelOrder = self::getOrderById($id);

        $wpdb->update(
            $tableName,
            array(
                'ordem' => $channelOrder + 1,
            ),
            array('id' => $id),
            array(
                '%d',
            ),
            array('%d')
        );
    }

    /**
     * Decreases the Order number of a Channel by 1
     *
     * @param integer $id Channel ID
     * @return void
     */
    public static function decreaseOrder(int $id) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_channels";

        $channelOrder = self::getOrderById($id);

        $wpdb->update(
            $tableName,
            array(
                'ordem' => $channelOrder - 1,
            ),
            array('id' => $id),
            array(
                '%d',
            ),
            array('%d')
        );
    }
}
