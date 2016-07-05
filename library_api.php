<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 6/9/2016
 * Time: 7:38 PM
 */

include_once "connection.php";

if(isset($_GET['action'])){

    $action=$_GET['action'];

    switch($action){

        case "ListOfLibraryId":
            ListOfLibraryId($conn);
            break;
        case "LibraryData":
            LibraryData($conn);
            break;
    }
}

/***********************************************************************************************************************
 ***************************FUNCTION LOGIN List if Library ID(GET)*********************************************************
 **************************FOR MAIN ADMIN ADD BOOK DATA(RETURN ALL LIBRARY IDS )**********************************************/

function ListOfLibraryId($conn){

    $sql="SELECT libraryid FROM library ORDER BY startdate DESC ";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data[]=array("library_id"=>$row['libraryid']);

    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);
}

/***********************************************************************************************************************
 ***************************FUNCTION LIBRARY DATA(GET)******************************************************************
 ***********************************************************************************************************************/

function LibraryData($conn){

    $library_id = $_POST['library_id'];

    $sql="SELECT * FROM library WHERE libraryid='$library_id'";
    $result=mysqli_query($conn,$sql);

    $row=mysqli_fetch_array($result);

    if($result){
        $data=array("library_id"=>$row['libraryid'],"postalcode"=>$row['postalcode'],"address"=>$row['address'],"startdate"=>$row['startdate'],"teamleader_NIC"=>$row['teamleader_NIC']);
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);


}
?>