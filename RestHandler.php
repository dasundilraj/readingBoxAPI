<?php

/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 7/5/2016
 * Time: 1:03 PM
 */

require_once "SimpleRest.php";
require_once "User.php";

class RestHandler extends SimpleRest
{
    function userLogin($conn){

        $userLogin=new User();
        $rawData=$userLogin->userLogin($conn);

        if(empty($rawData)){
            $statusCode = 404;
            $rawData = array('error' => 'No users Find');
        }
        else{
            $statusCode = 200;
        }

        $requestContentType = $_SERVER['HTTP_ACCEPT'];                  //get SERVER HEADER ACCEPT TYPE
        $this ->setHttpHeaders($requestContentType, $statusCode);

        if(strpos($requestContentType,'application/json') !== false){
            $response = $this->encodeJson($rawData);
            echo $response;
        } else if(strpos($requestContentType,'text/html') !== false){
            $response = $this->encodeHtml($rawData);
            echo $response;
        } else if(strpos($requestContentType,'application/xml') !== false){
            $response = $this->encodeXml($rawData);
            echo $response;
        }

    }

    public function encodeHtml($responseData) {                         //convert return data into HTML

        $htmlResponse = "<table border='1'>";
        foreach($responseData as $key=>$value) {
            $htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
        }
        $htmlResponse .= "</table>";
        return $htmlResponse;
    }

    public function encodeJson($responseData) {                         //convert return data into JSON
        $jsonResponse = json_encode($responseData);
        return $jsonResponse;
    }

    public function encodeXml($responseData) {                          //convert return data into XML
        // creating object of SimpleXMLElement
        $xml = new SimpleXMLElement('<?xml version="1.0"?><user></user>');
        foreach($responseData as $key=>$value) {
            $xml->addChild($key, $value);
        }
        return $xml->asXML();
    }

}