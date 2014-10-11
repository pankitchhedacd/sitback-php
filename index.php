<?php
/*

  PHP Client for Sitback.
  
  Send transactional email with ease.

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

    private $headers;


    private function __construct($token, $key){
        //Set all the parameters.
        $this->generateUrl($token);     
        //Do all the token validation.
    }

    private function generateUrl($token){
        $this->url = HOST.RESOURCE.SEND."/".$token;     
    }

    //Singleton instance;    
    public static function Init($token,$key){
        if(!self::$instance){
            self::$instance = new Sitback($token, $key);
        }
        return self::$instance;
    }

    private function setHeader(){
        //set headers properly to appliction type json.
    }
    public function send($json){
        //send email request to the Sitback.

        //check sender
        
        //check receiver and it is type of Array
        
        $this->setHeader();

        //http://php.net/manual/en/function.http-post-data.php
        //http://php.net/manual/en/http.request.options.php

        if(function_exists('http_post_data') == true) {
            http_post_data($this->url, $json,$this->header);
        }else{
            //report error extension not installed.
        }
        //return response;
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