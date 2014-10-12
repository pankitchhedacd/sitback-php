<?php
/*

  PHP Client for Sitback.

  Send transactional email with ease.

  @author: Samal Gorai

  @version: 0.1

*/ 

class SitbackException extends Exception
{
}

class Sitback
{
    const HOST = "http://sitback.smalgorai.com";
    const RESOURCE = "/api/v1";
    const ENDPOINT = "/send";
    private static $instance ;
    private static $url ;

    private $headers;


    private function __construct($token, $key, $secret){
        //Set all the parameters.
        $this->generateUrl($token);     
        //Do all the token validation.
    }

    private function generateUrl($token){
        $this->url = HOST.RESOURCE.SEND."/".$token;     
    }

    //Singleton instance;    
    public static function Init($token,$key,$secret){
        if(!self::$instance){
            self::$instance = new Sitback($token, $key, $secret);
        }
        return self::$instance;
    }

    private function setHeader(){
        //set headers properly to appliction type json.
    }
    
    /**
    *  Send email request to the Sitback.
    * @json : JSON array
    * @encoded : boolean
    *
    */
    public function send($json,$encoded =false){
        //check type
        if(empty($json["mail_type"])){
            throw new SitbackException('Mail Template not provided.');  
        }
        //check sender email
        if(empty($json["sender"])){
            throw new SitbackException('email sender is not defined.');      
        }
        //check recevier list
        if(empty($json["recevier"])){
            throw new SitbackException('email sender is not defined.');      
        }
        //check receiver and it is type of Array
        if(!is_array($json["recevier"])){
            $json["recevier"] = array($json["recevier"]);
        }       

        $api_url = $this->url;  
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

        $response = $this->_execute( $curl );
        return $response;
    }

    private function _execute( $curl ) {
        $response = array();

        $response[ 'body' ] = curl_exec( $curl );
        $response[ 'status' ] = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close( $ch );

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

?>