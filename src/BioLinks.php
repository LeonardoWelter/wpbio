<?php

class BioLinks {

    /**
     * Returns all results from lwbio_links table
     *
     * @return array Links Objects
     */
    public static function index() {

        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_links";

        $results = $wpdb->get_results(
            "SELECT id, ordem, text, url 
            FROM $tableName 
            ORDER BY ordem;", 
            OBJECT
        );

        return $results;
    }

    /**
     * Return a Link based on the specified ID
     *
     * @param integer $id Link ID
     * @return Object Link Object
     */
    public static function show($id) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_links";

        $result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT id, ordem, text, url
                FROM $tableName
                WHERE id = %d",
                $id
            )
        );

        return $result;
    }

    /**
     * Handles the link_store admin post route, redirects on execution
     *
     * @return void
     */
    public static function store() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_links";

        $link = $_POST;

        $wpdb->insert(
            $tableName,
            array(
                'ordem' => self::getMaxOrder() + 1,
                'text' => $link['lwbio_text'],
                'url' => $link['lwbio_url'],
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
     * Handles the link_update admin post route, redirects on execution
     *
     * @return void
     */
    public static function update() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_links";

        $link = $_POST;

        $wpdb->update(
            $tableName,
            array(
                'text' => $link['lwbio_text'],
                'url' => $link['lwbio_url'],
            ),
            array('id' => $link['lwbio_id']),
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
     * Handles the link_remove admin post route, redirects on execution
     *
     * @return void
     */
    public static function destroy() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_links";

        $link = $_POST;

        $wpdb->delete(
            $tableName,
            array('id' => $link['lwbio_id']),
            array('%d')
        );

        wp_redirect(admin_url('admin.php?page=lwbio'));
        exit();
    }

    /**
     * Returns the maximum order number of all links
     *
     * @return int Maximum order number
     */
    public static function getMaxOrder() {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_links";

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
     * Returns a Link Object based on its Order number
     *
     * @param integer $order Order Number
     * @return Object Link
     */
    public static function getLinkByOrder(int $order) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_links";

        $result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT id, ordem, text, url
                FROM $tableName
                WHERE ordem = %d",
                $order
            )
        );

        return $result;
    }

    /**
     * Returns the order number of a Link based on ID
     *
     * @param integer $id Link ID
     * @return int Order number
     */
    public static function getOrderById(int $id) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_links";

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
     * Changes the Order of given Link, handles link_order admin post route
     *
     * @return void
     */
    public static function changeOrder() {
        $action = $_POST['link_action'];
        $linkId = $_POST['link_id'];

        $link = self::show($linkId);

        if ($action == 'link_up') {
            // decrease
            if ($link->ordem == '1') {
                error_log("Já está na primeira posição");
                wp_redirect(admin_url('admin.php?page=lwbio'));
                exit();
            }

            $aboveLink = self::getLinkByOrder($link->ordem - 1);
            
            if (is_null($aboveLink)) {
                error_log('Nada acima');
                self::decreaseOrder($link->id);
            } else {
                error_log('Alterando posições');
                self::increaseOrder($aboveLink->id);
                self::decreaseOrder($link->id);
            }

            error_log("Posição alterada.");
            wp_redirect(admin_url('admin.php?page=lwbio'));
            exit();

        } else if ($action == 'link_down') {
            // increase
            if ($link->ordem == self::getMaxOrder()) {
                error_log("Já está na última posição");
                wp_redirect(admin_url('admin.php?page=lwbio'));
                exit();
            }

            $belowLink = self::getLinkByOrder($link->ordem + 1);
            
            if (is_null($belowLink)) {
                error_log('Nada abaixo');
                self::increaseOrder($link->id);
            } else {
                error_log('Alterando posições');
                self::decreaseOrder($belowLink->id);
                self::increaseOrder($link->id);
            }

            error_log("Posição alterada.");
            wp_redirect(admin_url('admin.php?page=lwbio'));
            exit();
        }
    }

    /**
     * Increases the Order number of a Link by 1
     *
     * @param integer $id Link ID
     * @return void
     */
    public static function increaseOrder(int $id) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_links";

        $linkOrder = self::getOrderById($id);

        $wpdb->update(
            $tableName,
            array(
                'ordem' => $linkOrder + 1,
            ),
            array('id' => $id),
            array(
                '%d',
            ),
            array('%d')
        );
    }

    /**
     * Decreases the Order number of a Link by 1
     *
     * @param integer $id Link ID
     * @return void
     */
    public static function decreaseOrder(int $id) {
        global $wpdb;
        $tableName = $wpdb->prefix . "lwbio_links";

        $linkOrder = self::getOrderById($id);

        $wpdb->update(
            $tableName,
            array(
                'ordem' => $linkOrder - 1,
            ),
            array('id' => $id),
            array(
                '%d',
            ),
            array('%d')
        );
    }
}
