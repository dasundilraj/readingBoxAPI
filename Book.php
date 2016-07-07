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

    public function addBookOtherDetails($conn){                         //update other details of the book by Team Leader

        $book_id=$_POST['book_id'];
        $title=$_POST['title'];
        $book_category=$_POST['book_category'];
        $author=$_POST['author'];
        $pub_date=$_POST['published_date'];

        $sql="UPDATE book SET title='$title',book_category='$book_category', author_name='$author',publishdate='$pub_date',updated='1'
                      WHERE bookid='$book_id' ";

        if(mysqli_query($conn,$sql)){
            $data=array("query_result"=>"1");
        }
        else{
            $data=array("query_result"=>"0");
        }

        return $data;

    }

    public function listOFBookIDNotUpdated($conn){                              //get list of book ids which are not updated

        $library_id=$_POST['library_id'];

        $sql="SELECT bookid FROM book WHERE library_libraryid='$library_id' AND updated='0'";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)){
            $data[]=array("book_id"=>$row['bookid']);
        }
        return $data;
    }

    public function libraryALLBookData($conn){                  //get all book data in library

        $library_id=$_POST['library_id'];

        $sql="SELECT * FROM book WHERE library_libraryid='$library_id' ORDER BY added_date DESC ";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)){
            $data[]=array(
                "bookid"=>$row['bookid'],
                "ISBN"=>$row['ISBN'],
                "title"=>$row['title'],
                "book_category"=>$row['book_category'],
                "author"=>$row['author_name'],
                "publishdate"=>$row['publishdate'],
                "donor_name"=>$row['donor_name'],
                "donatedate"=>$row['donatedate'],
                "price"=>$row['price'],
                "status"=>$row['status']
            );
        }
        return $data;
    }

    public function allAvailableListOFBookID($conn){            //for get list of all book id in library which are available in library

        $library_id=$_POST['library_id'];

        $sql="SELECT bookid FROM book WHERE library_libraryid='$library_id' AND updated='1' AND status='Available' ";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)){
            $data[]=array("book_id"=>$row['bookid']);
        }

        return $data;
    }

    public function getBookData($conn){         //for get data from particular book

        $book_id=$_POST['bookid'];

        $sql="SELECT * FROM book WHERE bookid='$book_id' ";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)){
            $data=array(
                "ISBN"=>$row['ISBN'],
                "title"=>$row['title'],
                "author_name"=>$row['author_name'],
                "price"=>$row['price']
            );
        }

        return $data;
    }


}