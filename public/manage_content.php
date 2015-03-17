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

<?php
if (isset($_GET["subject"]))
{
$selected_subject_id = $_GET["subject"];
 $selected_page_id = null;

}
elseif(isset($_GET['pages']))
{
    $selected_subject_id = null;
 $selected_page_id = $_GET["pages"];  
}
else
{
 $selected_page_id = null;   
 $selected_subject_id = null;
}
?>
  
    <div id="main">
        <div id="navigation">
            <ul class="subjects">
                 <?php 
                  $subjectset = find_all_subjects();
                while($subject = mysqli_fetch_assoc($subjectset))
                {

                ?>
                <?php
                echo "<li";
                if ($subject["id"] == $selected_subject_id) {
                echo " class=\"selected\"";
                }
                echo ">";
                        ?>
                        <a href="manage_content.php?subject= <?php echo $subject["id"]; ?>"><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")"; ?></a>
                   

                       
                       <?php
                      $pageset = find_pages_for_subject($subject["id"]);
                       ?>
                       <ul class="pages">
                          <?php 
                           while($pages = mysqli_fetch_assoc($pageset)) {
                           ?>
                           
                          <li >
                              <a href="manage_content.php?subject= <?php echo $pages["id"]; ?>">  
                          <?php echo $pages["menu_name"] .  " (" . $pages["id"] . ")";  ?>
                              </a> 
                              
                              </li>
                           
                           
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
         <?php 
        echo  $selected_page_id;   
        echo $selected_subject_id; 
         ?>
        
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