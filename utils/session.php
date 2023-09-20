<?php


function isSession() {
    if(isset($_SESSION["email"]) && isset($_SESSION["pass"])){
      return true;
    }
    return false;
  }
  function destroySession(){
    session_destroy();
    header('Location: ./login.php');
  }
