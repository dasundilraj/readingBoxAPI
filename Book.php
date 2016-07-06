<?php

/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 7/6/2016
 * Time: 9:17 AM
 */
class Book
{

    public function addBookBasicDetails($conn){                 //add books basic details in main admin view

        $ISBN=$_POST['ISBN'];
        $price=$_POST['price'];
        $donate_date=$_POST['donate_date'];
        $donor_name=$_POST['donor_name'];
        $added_date=date("Y/m/d h:i:sa");
        $libaray_id=$_POST['library_id'];

        $sql_count="SELECT bookid FROM book";                     //count number of data in book table
        $result_count=mysqli_query($conn,$sql_count);
        $num_of_rows=mysqli_num_rows($result_count);

        function genarateBookId($ISBN,$num_of_rows){        //generate book id using ISBN

            $count=1+$num_of_rows++;

            return "RB-BK".$count."-".$ISBN;
        }

        $book_id=genarateBookId($ISBN,$num_of_rows);

        $sql="INSERT INTO book(bookid,ISBN,donatedate,status,library_libraryid,donor_name,added_date,price,updated)
                 VALUES('$book_id','$ISBN','$donate_date','Available','$libaray_id','$donor_name','$added_date',$price,'0')";

        if(mysqli_query($conn,$sql)){
            $data=array(
                "query_result"=>"1",
                "book_id"=>$book_id,
                "isbn"=>$ISBN,
                "library_id"=>$libaray_id
            );
        }
        else{
            $data=array("query_result"=>"0");
        }

        return $data;
    }
}