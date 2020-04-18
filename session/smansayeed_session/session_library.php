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

    public function session_abort(){

            session_abort();
    }

    public function session_cache_expire($time){

            session_cache_expire($time);
    }

    public function session_cache_limiter($string){

            session_cache_expire($string);
    } 

    public function session_write_close($string){

            session_write_close();
    }  

     public function session_create_id($prefix){

            session_create_id($prefix);
    }

      public function session_commit(){

            session_commit();
    }

     public function session_decode($data){

            session_decode($data);
    }

    public function session_encode(){

            session_encode();
    }

     public function session_save_path($string){

            session_save_path($string);
    }

     public function session_reset(){

            session_reset();
    }

     public function session_register($data){

            session_register($data);
    }

     public function session_write_close(){

            session_write_close();
    }

     public function session_regenerate_id(){

            session_regenerate_id();
    }

     public function session_name($data){

            session_name($data);
    }

     public function session_module_name()(){

            session_module_name()();
    }

     public function session_is_registered($data){

            session_is_registered($data);
    }

     public function session_id(){

            session_id();
    }

     public function session_get_cookie_params(){

            session_get_cookie_params();
    }

     public function session_gc(){

            session_gc();
    }

     public function   session_set_cookie_params($DATA){

              session_set_cookie_params($DATA);
    }

     public function session_set_save_handler($DATA){

            session_set_save_handler($DATA);
    }

     public function session_status(){

            session_status ();
    }

     public function session_unregister($data){

            session_unregister($data);
    }

     public function session_encode(){

            session_encode();
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