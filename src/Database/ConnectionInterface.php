<?php
namespace StackOverflowClone\Src\Database;
interface ConnectionInterface
{
    //public function connect();

    public function __sleep();
    
    public function __wakeup();
}
