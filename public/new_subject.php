
<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php require_once "../includes/session.php";?>
<?php include "../includes/dbconnection.php";?>
 <?php include "../includes/functions.php"; ?> 
<?php

$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set);
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
            
        </div>
        
        <div id="page">
       <?php  
        echo message();
       ?>
       <h2>Create Subject</h2>
     
		<form action="create_subject.php" method="post">
		  <p>Menu name:
		    <input type="text" name="menu_name" value="<?php echo $current_subject["menu_name"] ;?>" />
		  </p>
		  <p>Position:
		    <select name="position">
                         
                        <?php
			$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set);	
for ($count =1; $count < $subject_count; $count++)
{
echo "<option value=\"{$count}\">{$count}</option>";
}
echo $subject_count;
?>
                        
		    </select>
		  </p>
		  <p>Visible:
		    <input type="radio" name="visible" value="0" /> No
		    &nbsp;
		    <input type="radio" name="visible" value="1" /> Yes
		  </p>
		  <input type="submit" name="submit" value="Create Subject" />
		</form>
       
        
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