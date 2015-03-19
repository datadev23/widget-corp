<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require_once "../includes/session.php";?>
<?php require_once  "../includes/dbconnection.php";?>
 <?php require_once "../includes/functions.php"; ?> 
<?php

$subject_set = find_all_subjects();

?>

<?php include "../includes/layouts/header.php"; ?>

<?php
if (isset($_GET["subject"]))
{

$current_subject =  find_subject_by_id($_GET["subject"]);
$current_page = null;



}
elseif(isset($_GET['pages']))
{

$current_subject = null;
 $current_page =  find_page_by_id($_GET["pages"]);
}
else
{
$current_page = null;    
$current_subject = null;
}
?>

    <div id="main">
        <div id="navigation">
          
          <?php  echo navigation($current_subject, $current_page); ?>
            <br>
             <a href="new_subject.php">Add a subject</a> 
        </div>
        
        <div id="page">
               <?php  
        echo message();
         ?>   
            <h2>Manage Content  </h2>
            
          
  
         <?php 
         if ($current_subject) { ?>
       
            <?php echo $current_subject["menu_name"];  ?>
        <?php } elseif ($current_page){ ?>
           <?php echo $current_page["menu_name"];  ?> 
         <?php } else { ?>
            Please select a subject or a page
         <?php } ?>
            
        
       
       
        
        </div>
    </div>

<?php // release the data
 mysqli_free_result($subject_set);
?>


<?php include "../includes/layouts/footer.php"; ?>

<?php 
// close the connection

/*
global $connection;
if (isset($connection))
{
    mysqli_close($connection);
}
*/    
?>