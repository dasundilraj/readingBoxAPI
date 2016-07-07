<?php

/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 7/7/2016
 * Time: 8:43 AM
 */
class Member
{
    public function addMember($conn){              // function for add members in team leader view

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

        return $data;
    }

    public function viewMembersTeamLead($conn){         //function for view members in team lead view

        $team_lead_id=$_POST['team_lead_id'];

        $sql="SELECT * FROM member WHERE teamleader_NIC='$team_lead_id'";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)){
            $data[]=array(
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

        return $data;
    }

    public function listOfMemberID($conn){              //for get list of member id in team leader view
        $team_lead_id=$_POST['team_lead_id'];

        $sql="SELECT memberid FROM member WHERE teamleader_NIC='$team_lead_id'";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)){
            $data[]=array("member_id"=>$row['memberid']);
        }

        return $data;
    }

    public function memberData($conn){              //for get member data of particular member in system

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
        return $data;

    }
}