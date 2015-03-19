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
        return $output;
       }
      
       
}