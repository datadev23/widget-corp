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
 <?php require_once  "../includes/validation_functions.php"; ?> 
<?php

$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set);
?>

<?php 
/*
if (!$current_subject) {
    redirect_to("manage_content.php");
}
*/
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
<?php
if(empty($errors)) {
    



if(isset($_POST["submit"])) {
    
    // get the data from the form for processing
    $id = $current_subject['id']; 
    $menu_name = $_POST["menu_name"];
    $position = $_POST["position"];
    $visible = $_POST["visible"];
    
    echo $menu_name;
    
    // process the form
    // make the insert 
    
    // clean data 
    $menu_name = mysql_clean($menu_name);
    
    // insert validation
    $required_fields = array("menu_name", "position", 'visible');
    validate_presences($required_fields);
    
    $field_with_max_lenghts = array("menu_name" => 30);
   validate_max_lengths($fields_with_max_lengths);
   
   if(!empty($errors))
   {
      $_SESSION = $errors;
      redirect_to("new_subject.php");
   }
    
    // insert the data from the form into the database
    $query = "UPDATE subjects SET (";
    $query .= "menu_name = '{$menu_name}', ";
    $query .= "position = {$position}, ";
    $query .= "visible = {$visible}, ";
    $query .= "wHERE id = {$id}";
    $query .= "LIMIT 1";

    
    // result
   
  
 
    $result = mysqli_query($connection, $query) or die("failed result");
    
    // if result is succesful redirect to the manage_content.php
 
    if ($result && mysqli_affected_rows($connection) == 1)
    {
       $_SESSION['message'] = "subject succesfully updated"; 
       redirect_to("manage_content.php");
    }
 
}
}
else
{    $message = "subject update failed"; 
    redirect_to("new_subject.php");
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
       <?php $errors = errors(); ?>
       <?php //echo form_errors($errors); ?>
       <h2>Edit Subject</h2>
     
		<form action="edit_subject.php?subject=<?php echo $current_subject['id']?>" method="post">
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
echo "<option value=\"{$count}\"";
if ($current_subject["position"] == $count) {

    echo " selected";
}
echo ">{$count}</option>";
}
echo $subject_count;
?>
                        
		    </select>
		  </p>
		  <p>Visible:
                    <input type="radio" name="visible" value="0" <?php if($current_subject["visible"] == 0) {echo "checked";}?> /> No
		    &nbsp;
                    <input type="radio" name="visible" value="1" <?php if($current_subject["visible"] == 1) {echo "checked";}?> /> Yes
		  </p>
		  <input type="submit" name="submit" value="Create Subject" />
		</form>
       
       
         <a href="delete_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?> "onclick="return confirm('Are you sure');">Delete</a>
       
        
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