<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

function message() {
    if (isset($_SESSION["message"])) {
        // return output and remove echos
       $output = "<div class=\"message\">";
       $output .=  $_SESSION["message"];
       $output .=  "</div>";
       
       // clear the session message
       $_SESSION["message"] = null;
       
        return $output;
       }
      
       
}

function errors() {
    if (isset($_SESSION["errors"])) {
        // return output and remove echos
    
       $errors =  $_SESSION["errors"];
   
       
       // clear the session message
       $_SESSION["errors"] = null;
       
        return $errors;
       }
      
       
}
