<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>


<?php

function find_all_subjects()
{
    global $connection;
  $query  = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE visible = 1 ";
	$query .= "ORDER BY position ASC";
	$subjectset= mysqli_query($connection, $query);
	// Test if there was a query error
        
        if (!$subjectset) {
		die("Database query failed.");
	}  
        
        return $subjectset;
}


function find_pages_for_subject($subject_id)
{
    
    global $connection;
        $query  = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE visible = 1 ";
        $query .= "AND subject_id = {$subject_id} ";
	$query .= "ORDER BY position ASC";
	$pageset = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$pageset) {
		die("Database query failed.");
	}

    return $pageset;
}


?>