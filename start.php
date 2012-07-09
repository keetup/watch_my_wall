<?php

/**
 * Watch my wall module
 * Elgg wall updater, using node.js
 *
 * @package wmw
 */
elgg_register_event_handler('init', 'system', 'wmw_init');
require_once dirname(__FILE__) . '/classes/SocketClient.php';

function wmw_init() {
    elgg_register_js('socket.io', 'mod/watch_my_wall/vendors/socket.io/socket.io.js');
    elgg_register_js('wmw_main', 'mod/watch_my_wall/js/main.js');

    elgg_load_js('socket.io');
    elgg_load_js('wmw_main');

    elgg_register_event_handler('created', 'river', 'wmw_push_river');
}

function wmw_push_river($event, $object_type, $object) {
    $logged_in = elgg_get_logged_in_user_entity();

    if ($event == 'created' && $object_type == 'river' && $object && $logged_in) {


        $river_options = array('username' => $logged_in->username,
            'river_item' => $object,
            'msg' => elgg_view_river_item($object)
        );

        $elephant = new \ElephantIO\SocketClient(wmp_node_url());

        $elephant->init(FALSE);
        $elephant->emit('newMessage', $river_options, '');
        $elephant->close();
    }
}

function wmp_node_url() {
    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . ':8080';
}
