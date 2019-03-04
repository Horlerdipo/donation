<?php
    require_once('ini.php');
    class Database{
        private $connection;

        public function __construct(){
            $this->connectdb();
        }

        public function connectdb(){
            $this->connection=new mysqli("localhost","root","","donation");
            if($this->connection){
                //echo"true";
                return $this->connection;
            }else{
                //echo"false";
                return"errror with db";
            }
        }

        public function querydb($sql){
            $return=$this->connection->query($sql);
            if($return){
                return $return ;
            }else {
                die("query had issues".$this->connection->error);
            }
        }

        public function return_assoc($sql){
            
            $return=mysqli_fetch_assoc($sql);
            return($return);
        }
        

   };

   $database=new Database();