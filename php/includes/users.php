<?php
   require("ini.php");
   class Users{

       //public static function for data validation
        public static function validate_data($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
   //static function to redirect page to new url
        public  function redirect($url){
            header("Location:${$url}");
       
        }
}
$users=new Users();
?>