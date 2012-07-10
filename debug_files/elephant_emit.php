<?php
require_once dirname(dirname(__FILE__)) . '/classes/SocketClient.php';
        
$elephant = new SocketClient('http://localhost:8080');

$elephant->init();
$elephant->emit('debug', array('username' => 'Germanaz0', 'msg' => 'Test'), '');
$elephant->close();

