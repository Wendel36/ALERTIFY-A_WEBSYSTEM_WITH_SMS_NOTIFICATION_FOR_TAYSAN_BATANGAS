<?php

    // function connection(){

    //     $host = "localhost";
    //     $username = "u757823431_taysan_bats";
    //     $password = "4228TaysanBatangas";
    //     $database = "u757823431_db_taysanbats";
        
    //     $con = new mysqli($host, $username, $password, $database);
        
    //     if($con->connect_error){
    //         echo $con->connect_error;
    //     }
    //     else{
    //         return $con;
    //     }
    // }
    function connection(){

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "taysan_info";
        
        $con = new mysqli($host, $username, $password, $database);
        
        if($con->connect_error){
            echo $con->connect_error;
        }
        else{
            return $con;
        }
    }