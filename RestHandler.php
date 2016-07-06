<?php

/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 7/5/2016
 * Time: 1:03 PM
 */

require_once "SimpleRest.php";
require_once "User.php";
require_once "Book.php";
require_once "Library.php";

class RestHandler extends SimpleRest
{



    /***************<<<<<<< Functions for USERS >>>>>>>>*********************/

    function userLogin($conn){                  //user login function return response

        $user=new User();
        $rawData=$user->userLogin($conn);

        if(empty($rawData)){
            $statusCode = 404;
            $rawData = array("query_result"=>"0");
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

    function createTeamLeader($conn){           //function team leader create and return response

        $user=new User();
        $rawData=$user->createTeamLead($conn);

        if(empty($rawData)){
            $statusCode = 404;
            $rawData = array("query_result"=>"0");
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

    function viewTeamLead($conn){               //function view team lead account and return response

        $user=new User();
        $rawData=$user->viewTeamLead($conn);

        if(empty($rawData)){
            $statusCode = 404;
            $rawData = array("query_result"=>"0");
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




    /***************<<<<<<< Functions for BOOKS >>>>>>>>*********************/

    function addBooks($conn){                           //function add book basic details in main admin view

        $book= new Book();
        $rawData=$book->addBookBasicDetails($conn);

        if(empty($rawData)){
            $statusCode = 404;
            $rawData = array("query_result"=>"0");
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




    /***************<<<<<<< Functions for LIBRARY >>>>>>>>*********************/

    function listOfLibraryId($conn){                    //function get list of library ids

        $library=new Library();
        $rawData=$library->getListOfLibraryID($conn);

        if(empty($rawData)){
            $statusCode = 404;
            $rawData = array("query_result"=>"0");
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

    function libraryData($conn){                            //function for get library data
        $library=new Library();
        $rawData=$library->getLibraryData($conn);

        if(empty($rawData)){
            $statusCode = 404;
            $rawData = array("query_result"=>"0");
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




    /***************<<<<<<< Functions for RESPONSE ENCODE >>>>>>>>*********************/

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