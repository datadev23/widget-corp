<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include "../includes/dbconnection.php";?>
 <?php include "../includes/functions.php"; ?> 
<?php

$subjectset = find_all_subjects();

?>

<?php include "../includes/layouts/header.php"; ?>
  
    <div id="main">
        <div id="navigation">
            <ul class="subjects">
                 <?php 
                while($subject = mysqli_fetch_assoc($subjectset))
                {

                ?>
                   <li><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")"; ?>
                   

                       
                       <?php
                      $pageset = find_subject_by_id($subject["id"]);
                       ?>
                       <ul class="pages">
                          <?php 
                           while($pages = mysqli_fetch_assoc($pageset)) {
                           ?>
                           
                           <li><?php echo $pages["menu_name"]; ?></li>
                           
                           
                           <?php
                               
                               
                           }
                         ?>
                       </ul>
                       
                       
                       
                       
                       
                   </li> 
  
                   <?php
                   }
                
                ?>
            </ul>
            
        </div>
        
        <div id="page">
            <h2>Manage Content  </h2>
         
        
        </div>
    </div>

<?php // release the data
 mysqli_free_result($subjectset);
?>


<?php include "../includes/layouts/footer.php"; ?>

<?php 
// close the connection
if (isset($connection))
{
    mysqli_close($connection);
}
    
?>