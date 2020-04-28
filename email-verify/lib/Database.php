<?php



class Database{



    private $hostdb = "localhost";
    private $userdb = "root";
    private $passdb = "";
    private $namedb = "login_registration";
    

    private $hostdb2 = "sohan.nl";
    private $userdb2 = "learnwithshohan";
    private $passdb2 = "ta75M*7b";
    private $namedb2 = "learnwithshohandb";

    public $local = "localhost";

    
    public $pdo;
    
       public function __construct(){
           
            if(!isset($this->pdo) ){
                try{
                    if(($_SERVER['HTTP_HOST']==$this->local)){
                        $link = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb,$this->userdb,$this->passdb);
                        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $link->exec("SET CHARACTER SET utf8");
                        $this->pdo = $link;
                    }elseif(($_SERVER['HTTP_HOST']!==$this->local)){
                        $link = new PDO("mysql:host=".$this->hostdb2.";dbname=".$this->namedb2,$this->userdb2,$this->passdb2);
                       $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                       $link->exec("SET CHARACTER SET utf8");
                      $this->pdo = $link;
                    }else{
                        echo "Nothing Found";
                    }                  

                }catch(PDOException $e){
                   die("Failed to connect  database ".$e->getMessage());    
                }
            }

    }
}

    




?>