<?php
/*
  
  PHP Client for Sitback.

  Send Beautiful transactional email with ease.

  @author: Samal Gorai

  @version: 0.1.2

*/
namespace Sitback;

use Exception;

class SitbackException extends Exception{
}

class SitbackFactory{
    const HOST = "http://api.sitback.co";
    const RESOURCE = "/api/v1";
    const ENDPOINT = "/send";
    private static $instance ;
    private $url ;
    private $token;
    private $headers;


    private function __construct($app, $token, $secret){
        //Set all the parameters.
        $this->generateUrl($app);
        $this->token = $token;
        //Do all the token validation.
    }

    private function generateUrl($app){
        $this->url = SitbackFactory::HOST.SitbackFactory::RESOURCE."/".$app.SitbackFactory::ENDPOINT;     
    }

    //Singleton instance;    
    public static function Init($app,$token,$secret){
        if(!self::$instance){
            self::$instance = new SitbackFactory($app, $token, $secret);
        }
        return self::$instance;
    }
    
    //TODO:Set token here
    private function setHeader(){
        //set headers properly to appliction type json.
    }

    /**
    * Send email request to the Sitback.
    * @json : JSON array
    *   $json["identifier"]  = type String;
    *   $json["receiver"]   = type Array of Email;
    *   $json["data"]       = type Associative Array
    *
    * @encoded : boolean
    *
    */
    public function send($json,$encoded =false){

        //check identifier
        if(empty($json["identifier"])){
            throw new SitbackException('Mail Template not provided.');  
        }
        //check recevier list
	    //TODO:only allow max 20 email.
        if(empty($json["receiver"])){
            throw new SitbackException('email receivers list is not defined.');      
        }
        //check receiver and it is type of Array
        if(!is_array($json["receiver"])){
            $json["receiver"] = array($json["receiver"]);
        }       

        $api_url = $this->url;  
           
        //TODO: create query params

        //TODO: create a signature

        //json_encode
        if(!$encoded){
            $json_opt = json_encode($json);
        }

        $curl = curl_init();
        if ( $curl === false )
        {
            throw new SitbackException('Could not initialise cURL!');
        }

        curl_setopt( $curl, CURLOPT_URL, $api_url );
        curl_setopt( $curl, CURLOPT_HTTPHEADER, array ( "Content-Type: application/json" ) );
        curl_setopt( $curl, CURLOPT_POST, 1 );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $json_opt );
        //More curl opt
        try{    
          $response = $this->_execute( $curl );
        }catch(Exception $e){
          $response "Failed.";
        }
        return $response;
    }

    private function _execute( $curl ) {
        $response = array();

        $response[ 'body' ] = curl_exec( $curl );
        $response[ 'status' ] = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close( $curl );

        return $response;
    }

    //TODO::
    private function createSignature(){
        return $this->signature;
    }

    //
    private function createConn(){
        //open connection to Sitback;
    }

    //
    public function closeConn(){
        //close connection
    }    

}


