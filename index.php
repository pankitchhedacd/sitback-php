<?php
/*

  PHP Client for Sitback.
  Send transactional email smoothly.
  
  @author: Samal Gorai
  
  @version: 0.1
  
*/ 

class Sitback
{
     const HOST = "http://sitback.smalgorai.com";
     const RESOURCE = "/api/v1";
     const ENDPOINT = "/send";
     private static $instance ;
     private static $url ;
    
    
     
     private function __construct($token, $key){
       //Set all the parameters.
       $this->generateUrl($token);     
       //Do all the token validation.
     }

     private function generateUrl($token){
       $this->url = HOST.RESOURCE.SEND."/".$token;     
       return $url;
     }

     //Singleton instance;    
     public static function Init($token,$key){
       if(!self::$instance){
         self::$instance = new Sitback($token, $key);
       }
        return self::$instance;
     }

    
     public function send(/*FUll JSON object*/){
      //send email request to the Sitback.
     }
    
     private function createSignature(){
       return $this->signature;
     }
     
     private function createConn(){
       //open connection to Sitback;
     }
     public function closeConn(){
       //close connection
     }    
     
}

?>