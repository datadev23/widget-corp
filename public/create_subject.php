<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php require_once "../includes/session.php";?>
<?php require_once  "../includes/dbconnection.php";?>
 <?php require_once  "../includes/functions.php"; ?> 
 <?php require_once  "../includes/validation_functions.php"; ?> 


<?php

if(isset($_POST["submit"])) {
    
    // get the data from the form for processing
    
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
    $query = "INSERT INTO subjects (";
    $query .= "menu_name, position, visible";
    $query .= ") VALUES (";
    $query .= " '{$menu_name}', {$position}, {$visible}";
    $query .= ")";
    
    // result
   
  
 
    $result = mysqli_query($connection, $query) or die("failed result");
    
    // if result is succesful redirect to the manage_content.php
 
    if ($result)
    {
       $_SESSION['message'] = "subject succesfully constructered"; 
       redirect_to("manage_content.php");
    }
 
}
else
{    $_SESSION['message'] = "subject creation failed"; 
    redirect_to("new_subject.php");
}

?>



<?php
global $connection;
if (isset($connection))
{
    mysqli_close($connection);
}
?>