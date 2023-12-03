<?php 

function checkSession($isStudent){
    if(!isset($_SESSION["id"])){
        session_start();
    }

    if($isStudent){
        if(!isset($_SESSION["id"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "student"){
            header("Location: StudentLogin.php");
        }
    }
    else {
        if(!isset($_SESSION["id"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "instructor"){
            header("Location: InstructorLogin.php");
        }
    }

    $ID = $_SESSION["id"];
}