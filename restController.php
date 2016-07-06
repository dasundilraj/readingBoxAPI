<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 7/5/2016
 * Time: 12:00 PM
 */

require_once "RestHandler.php";
require_once "connection.php";

$action="";

if(isset($_GET['action'])){
    $action=$_GET['action'];

    switch($action){

        //cases for users
        case "userLogin":                       //for user login into the system for both users
            $restHandler= new RestHandler();
            $restHandler->userLogin($conn);
            break;
        case "createTeamLead":                  //for create Team Leader Account in main admin view
            $restHandler=new RestHandler();
            $restHandler->createTeamLeader($conn);
            break;
        case "viewTeamLead":                    //for view Team Leader Accounts in main admin view
            $restHandler= new RestHandler();
            $restHandler->viewTeamLead($conn);
            break;

        //cases for books
        case "addBooks":                        //for add basic book details in main admin view
            $restHandler=new RestHandler();
            $restHandler->addBooks($conn);
            break;
        case "addBooksTeamLead":                //for add other details of the book in team leader view
            $restHandler=new RestHandler();
            $restHandler->addBookOtherDetails($conn);
            break;
        case "listOFBookIDNotUpdated":          //for get list of book IDS which are not updated by Team Leader
            $restHandler= new RestHandler();
            $restHandler->listOFBookIDNotUpdated($conn);
            break;
        case "libraryALLBookData":
            $restHandler= new RestHandler();
            $restHandler->libraryALLBookData($conn);
            break;

        //cases for library
        case "listOfLibraryId":                 //for get list of library id in main admin view
            $restHandler= new RestHandler();
            $restHandler->listOfLibraryId($conn);
            break;
        case "libraryData":                     //for get list of library data in main admin view
            $restHandler= new RestHandler();
            $restHandler->libraryData($conn);
            break;



    }
}

?>