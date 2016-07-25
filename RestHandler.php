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
require_once "Member.php";
require_once "Sales.php";
require_once "Transaction.php";

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

    function getTeamLeader($conn){              //for get team leader date in Team leader edit profile
        $user= new User();
        $rawData=$user->getTeamLeader($conn);

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

    function addBookOtherDetails($conn){

        $book= new Book();
        $rawData=$book->addBookOtherDetails($conn);

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

    function listOFBookIDNotUpdated($conn){

        $book= new Book();
        $rawData=$book->listOFBookIDNotUpdated($conn);

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

    function libraryALLBookData($conn){

        $book=new Book();
        $rawData=$book->libraryALLBookData($conn);

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

    function allAvailableListOFBookID($conn){           //get all list of book ID which are available in Library

        $book = new Book();
        $rawData=$book->allAvailableListOFBookID($conn);

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

    function bookData($conn){

        $book= new Book();
        $rawData=$book->getBookData($conn);

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

    function bookNotification($conn){                   //book notification for Team Leader View
        $book= new Book();
        $rawData=$book->getBookNotification($conn);

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

    function updateBookDetails($conn){
        $book= new Book();
        $rawData=$book->updateBookDetails($conn);

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



    /***************<<<<<<< Functions for Member >>>>>>>>*********************/

    function addMember($conn){                  //function for add members in team leader view

        $member=new Member();
        $rawData=$member->addMember($conn);

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

    function viewMemberTeamLead($conn){         //function for view members who are related to the team leader view

        $member = new Member();
        $rawData=$member->viewMembersTeamLead($conn);

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

    function listOfMemberID($conn){                     //for get list of member id in particular Team leader

        $member=new Member();
        $rawData=$member->listOfMemberID($conn);

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

    function  getMemberData($conn){

        $member= new Member();
        $rawData=$member->memberData($conn);

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

    /***************<<<<<<< Functions for Sales >>>>>>>>*********************/

    function addBookSales($conn){                   //for add book sales into the system

        $sales=new Sales();
        $rawData=$sales->bookSale($conn);

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

    function viewSalesDetails($conn){               //for view Sales Details in team leader View

        $sales= new Sales();
        $rawData=$sales->viewSalesDetails($conn);

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



    /***************<<<<<<< Functions for Transaction >>>>>>>>*********************/

    function addTransaction($conn){                     //for add transaction in Team Leader View

        $transaction= new Transaction();
        $rawData=$transaction->addTransaction($conn);

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

    function  viewTransaction($conn){                       //for view transaction details in team leader view

        $transaction=new Transaction();
        $rawData=$transaction->transactionDetails($conn);

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

    function returnBook($conn){                 //for return transaction books in team leader view

        $transaction=new Transaction();
        $rawData=$transaction->returnBooks($conn);

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