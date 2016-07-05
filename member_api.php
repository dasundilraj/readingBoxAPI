<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 6/10/2016
 * Time: 9:18 PM
 */

include_once "connection.php";

if(isset($_GET['action'])) {

    $action = $_GET['action'];

    switch ($action) {

        case "addMember":
            addMember($conn);
            break;
        case "TeamLeaderMemberDetails":
            TeamLeaderMemberDetails($conn);
            break;
        case "ListOfMemberID":
            ListOfMemberID($conn);
            break;
        case "MemberData":
            MemberData($conn);
            break;
    }
}
/***********************************************************************************************************************
 ***************************FUNCTION ADD MEMBER TO SYSTEM****************************************************************
 ***************************FOR TEAM LEADER ADD MEMBER DATA***************************************************************/

function addMember($conn){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $team_lead_id=$_POST['team_lead_id'];
    $member_image=$_POST['member_image'];
    $join_date = date("Y/m/d h:i:sa");

    $sql_count = "SELECT memberid FROM member";                                   //select count of the member
    $num_of_rows_members = mysqli_num_rows(mysqli_query($conn, $sql_count));

    function generateMemberId($gender, $num_of_rows)
    {    //generate unique member id

        $gender_sign = null;
        if ($gender == "male") {
            $gender_sign = "M";
        } else {
            $gender_sign = "F";
        }

        $count = 10000 + $num_of_rows++;
        return "RB-MM" . $count . $gender_sign;
    }

    $member_id = generateMemberId($gender, $num_of_rows_members);

    $sql="INSERT INTO member VALUES('$member_id','$fname','$lname','$address','$email','$mobile','$age','$join_date','$team_lead_id','$gender','$nic','$member_image')";

    if(mysqli_query($conn,$sql)){
        $data=array("query_result"=>1,"member_id"=>$member_id);
    }
    else{
        $data=array("query_result"=>0);
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);
}

/***********************************************************************************************************************
 ***************************FUNCTION GET MEMBERS DATA****************************************************************
 ***************************FOR TEAM LEADER MEMBER DATA***************************************************************/

function TeamLeaderMemberDetails($conn){

    $team_lead_id=$_POST['team_lead_id'];

    $sql="SELECT * FROM member WHERE teamleader_NIC='$team_lead_id'";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data[]=array(
            "query_result"=>"1",
            "member_id"=>$row['memberid'],
            "fname"=>$row['firstname'],
            "lname"=>$row['lastname'],
            "address"=>$row['address'],
            "email"=>$row['email'],
            "phone"=>$row['phone'],
            "age"=>$row['age'],
            "join_date"=>$row['joindate'],
            "gender"=>$row['gender'],
            "member_nic"=>$row['member_nic'],
            "member_image"=>$row['member_image']
        );
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);

}

/***********************************************************************************************************************
 ***************************FUNCTION GET LIST OF MEMBER ID****************************************************************
 ***************************FOR TEAM LEADER ADD TRANSACTION***************************************************************/

function ListOfMemberID($conn){

    $team_lead_id=$_POST['team_lead_id'];

    $sql="SELECT memberid FROM member WHERE teamleader_NIC='$team_lead_id'";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data[]=array("member_id"=>$row['memberid']);
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);

}

/***********************************************************************************************************************
 ***************************FUNCTION MEMBER DATA ACCORDING TO MEMBER ID****************************************************************
 ***************************FOR TEAM LEADER ADD TRANSACTION***************************************************************/

function MemberData($conn){
    //$team_lead_id=$_POST['team_lead_id'];
    $member_id=$_POST['member_id'];

    $sql="SELECT * FROM member WHERE memberid='$member_id'";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data=array(
            "member_ID"=>$row['memberid'],
            "name"=>$row['firstname']." ".$row['lastname'],
            "address"=>$row['address']
        );
    }
    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);

}
//memberid, firstname, lastname, address, email, phone, age, joindate, teamleader_NIC, gender, member_nic, member_image
