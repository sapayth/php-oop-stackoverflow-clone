<?php


class Session{

    public function __construct(){

    }

    public function session_start(){
        
        session_start();
    }

    public function session_destroy(){

        session_unset();
        session_destroy();
    }

    public function set_session_variable($parameter,$value){

            $_SESSION[$parameter] = $value;
    }

}

$sob = new Session;
$sob->session_start();
$sob->set_session_variable('test_key1','test_value1');
$sob->set_session_variable('test_key2','test_value2');
$sob->set_session_variable('test_key3','test_value3');

echo '<pre>'.print_r($_SESSION).'</pre>';
$sob->session_destroy();


?>