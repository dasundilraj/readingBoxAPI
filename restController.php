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
        case "allListOFBookID":                 //for get all list of book id which are available in library
            $restHandler= new RestHandler();
            $restHandler->allAvailableListOFBookID($conn);
            break;
        case "bookData":
            $restHandler= new RestHandler();
            $restHandler->bookData($conn);
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

        //cases for Member in Library
        case "addMember":                       //for add members in team leader view
            $restHandler= new RestHandler();
            $restHandler->addMember($conn);
            break;
        case "viewMembersTeamLead":             //for view members who are related to the team leader in team leader view
            $restHandler=new RestHandler();
            $restHandler->viewMemberTeamLead($conn);
            break;

        //cases for sales
        case "addBookSales":                    //for add book sales details into the system in team leader  view
            $restHandler= new RestHandler();
            $restHandler->addBookSales($conn);
            break;
        case "salesDetails":                    //for view sales details in team leader view
            $restHandler= new RestHandler();
            $restHandler->viewSalesDetails($conn);
            break;


        //cases for transactions

    }
}

?>