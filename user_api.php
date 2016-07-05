<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 6/8/2016
 * Time: 10:16 AM
 */
include_once "connection.php";

//if(isset($_GET['action'])){
//
//    $action=$_GET['action'];
//
//    switch($action){
//
//        case "userLogin":
//            userLogin($conn);
//            break;
//        case "createTeamLeader":
//            createTeamLeader($conn);
//            break;
//        case "getALLTeamLeaders":
//            getALLTeamLeaders($conn);
//            break;
//        case "deleteTeamLeader":
//            deleteTeamLeader($conn);
//            break;
//        case "getTeamLeader":
//            getTeamLeader($conn);
//            break;
//
//    }
//}

/***********************************************************************************************************************
 ***************************FUNCTION LOGIN USERS TO SYSTEM(GET)*********************************************************
***********************************************************************************************************************/

function userLogin($conn){

    echo "Test";

//    $userName=$_POST['user_id'];
//    $password=$_POST['user_pwd'];
//
//    $sql="SELECT * FROM teamleader WHERE NIC='$userName' && pwd='$password'";
//    $result=mysqli_query($conn,$sql);
//    $row=mysqli_fetch_array($result);
//
//    if((mysqli_num_rows($result)!=0)&&($row['attribute']==0)){
//
//        $data=array(                //json object for main admin
//            "query_result"=>"1",
//            "attribute"=>"0",
//            "user_NIC"=>$row['NIC'],
//            "user_fname"=>$row['firstname']
//        );
//    }
//
//    else if((mysqli_num_rows($result)!=0)&&($row['attribute']==1)){
//
//        $sql="SELECT libraryid FROM library WHERE teamleader_NIC='$userName'";
//        $row_lib=mysqli_fetch_array(mysqli_query($conn,$sql));
//
//        $data=array(                //json object for Team Leader
//            "query_result"=>"1",
//            "attribute"=>"1",
//            "user_NIC"=>$row['NIC'],
//            "user_fname"=>$row['firstname'],
//            "user_image"=>$row['user_image'],
//            "Library_id"=>$row_lib['libraryid']
//        );
//    }
//    else{
//        $data=array("query_result"=>"0");                   //json object for Error request
//    }
//
//    $json=$data;
//    header('content-type: application/json');
//    echo json_encode($json);


}

/***********************************************************************************************************************
 ***************************FUNCTION CREATE TEAM LEADER(PUT)************************************************************
 ***********************************************************************************************************************/

function createTeamLeader($conn){

    $fname=$_POST["fname"];         //assign variables
    $lname=$_POST["lname"];
    $nic=$_POST["nic"];
    $pwd=$_POST["pwd"];
    $email=$_POST["email"];
    $phone=$_POST["pnumber"];
    $join_date=date("Y/m/d h:i:sa");
    $age=$_POST["age"];
    $postal_code=$_POST['postal_code'];
    $address=$_POST['address'];
    $user_image=$_POST['user_image'];

    $sql="SELECT libraryid FROM library";                //select count of the library
    //$result=mysqli_query($conn,$sql);
    $num_of_rows_library=mysqli_num_rows(mysqli_query($conn,$sql));


    function generateLibraryId($postal_code,$num_of_rows){   //generate unique library id

        $count=1000+$num_of_rows++;
        return "RB-LB".$count.'-'.$postal_code;
    }

    $library_id=generateLibraryId($postal_code,$num_of_rows_library);

    $sql="SELECT * FROM teamleader WHERE NIC='$nic'";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==0){

        $sql_insert="INSERT INTO teamleader VALUES ('$nic','$fname','$lname','$address','$email','$phone','$pwd','$age',1,'$join_date','$postal_code','$user_image')";

        $sql_insert_library="INSERT INTO library VALUES('$library_id','$postal_code','$address','$join_date','$nic')";

        if(mysqli_query($conn,$sql_insert)&&mysqli_query($conn,$sql_insert_library)){

            $data=array(                    //successfully account created alert
                "query_result"=>1,
                "NIC"=>$nic,
                "name"=>$fname,
                "libaray_id"=>$library_id,
                "address"=>$address,
                "user_image"=>$user_image
            );
        }
        else{

            $data=array("query_result"=>2);  //account create error alert
        }
    }
    else{

        $data=array("query_result"=>3);//team leader existing error
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);


}

/***********************************************************************************************************************
 ***************************FUNCTION View TEAM LEADER(GET)**************************************************************
 ***********************************************************************************************************************/

function getALLTeamLeaders($conn){
    //NIC, firstname, lastname, address, email, phone, pwd, age, attribute, joindate, postalcode, user_image
    $sql="SELECT * FROM teamleader WHERE attribute='1' ORDER BY joindate DESC ;";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data[]=array(
            "fname"=>$row['firstname'],
            "lname"=>$row['lastname'],
            "NIC"=>$row['NIC'],
            "phone"=>$row['phone'],
            "email"=>$row['email'],
            "postal_code"=>$row['postalcode'],
            "pwd"=>$row['pwd'],
            "age"=>$row['age'],
            "address"=>$row['address'],
            "join_date"=>$row['joindate'],
            "user_image"=>$row['user_image']
        );
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);
}
/***********************************************************************************************************************
 ***************************FUNCTION DELETE TEAM LEADER(DELETE)*********************************************************
 ***********************************************************************************************************************/

function deleteTeamLeader($conn){

    $team_lead_nic=$_POST['nic'];
    $sql="DELETE FROM teamleader WHERE NIC='$team_lead_nic'";
    $sql_1="DELETE FROM library WHERE teamleader_NIC='$team_lead_nic' ";

    if(mysqli_query($conn,$sql)&&mysqli_query($conn,$sql_1)){
        $data=array(
            "query_result"=>"1",
            "delete_nic"=>$team_lead_nic);
    }
    else{
        $data=array("query_result"=>"0");
    }
    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);

}

/***********************************************************************************************************************
 ***************************FUNCTION TEAM LEADER DETAILS****************************************************************
 ***********************************************************************************************************************/

function getTeamLeader($conn){

    $team_lead_id=$_POST['team_lead_id'];

    $sql="SELECT * FROM teamleader WHERE NIC='$team_lead_id'";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data=array(
            "fullName"=>$row['firstname']. " ".$row['lastname'],
            "firstname"=>$row['firstname'],
            "lastname"=>$row['lastname'],
            "address"=>$row['address'],
            "email"=>$row['email'],
            "phone"=>$row['phone'],
            "age"=>$row['age'],
            "pwd"=>$row['pwd'],
            "NIC"=>$row['NIC'],
            "postalcode"=>$row['postalcode'],
            "user_image"=>$row['user_image']

        );
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);

}

?>
