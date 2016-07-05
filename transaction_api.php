<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 6/11/2016
 * Time: 11:33 AM
 */

include_once "connection.php";

if(isset($_GET['action'])){

    $action=$_GET['action'];

    switch($action){
        case "AddTransaction":
            AddTransaction($conn);
            break;
        case "transactionDetails":
            transactionDetails($conn);
            break;
        case "returnBooks":
            returnBooks($conn);
            break;
    }
}

/***********************************************************************************************************************
 ***************************FUNCTION ADD TRANSACTION INTO THE SYSTEM*****************************************************************
 ***************************TEAM LEADER ADD TRANSACTION***************************************************/

function AddTransaction($conn){

    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $issued_date = $_POST['issued_date'];
    $submitted_date = $_POST['submitted_date'];

    $sql_insert="INSERT INTO transaction(date, submitiondate, member_memberid, book_bookid) VALUES ('$issued_date','$submitted_date','$member_id','$book_id')";
    $sql_update="UPDATE book SET status='Issued' WHERE bookid='$book_id'";

    if (mysqli_query($conn, $sql_insert)&&mysqli_query($conn,$sql_update)) {
        $data=array("query_result"=>"1");
    }
    else{
        $data=array("query_result"=>"0");
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);
}


/***********************************************************************************************************************
 ***************************FUNCTION GET TRANSACTION DATA*****************************************************************
 ***************************TEAM LEADER VIEW TRANSACTION***************************************************/

function transactionDetails($conn){

    $team_lead_nic=$_POST['team_lead_nic'];
    $sql="SELECT * FROM transaction JOIN member ON transaction.member_memberid=member.memberid WHERE member.teamleader_NIC='$team_lead_nic'";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data[]=array(
            "member_id"=>$row['member_memberid'],
            "book_id"=>$row['book_bookid'],
            "issued_date"=>$row['date'],
            "submition_date"=>$row['submitiondate'],
            "address"=>$row['address'],
            "email"=>$row['email'],
            "phone"=>$row['phone'],
            "name"=>$row['firstname']." ".$row['lastname']

        );
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);
}

/***********************************************************************************************************************
 ***************************FUNCTION DELETE TRANSACTION DATA*****************************************************************
 ***************************TEAM LEADER VIEW TRANSACTION***************************************************/

function returnBooks($conn){

    $book_id=$_POST['bookid'];

    $sql_delete="DELETE FROM transaction WHERE book_bookid='$book_id'";
    $sql_update="UPDATE book SET status='Available' WHERE bookid='$book_id'";

    if(mysqli_query($conn,$sql_delete)&&mysqli_query($conn,$sql_update)){
        $data=array("query_result"=>"1");
    }
    else{
        $data=array("query_result"=>"0");
    }
    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);

}

//id, date, submitiondate, member_memberid, book_bookid
//memberid, firstname, lastname, address, email, phone, age, joindate, teamleader_NIC, gender, member_nic, member_image