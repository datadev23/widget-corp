<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>


<?php

function find_all_subjects() {
    global $connection;
  $query  = "SELECT * ";
	$query .= "FROM subjects ";
	/*$query .= "WHERE visible = 1 ";*/
	$query .= "ORDER BY position ASC";
	$subject_set= mysqli_query($connection, $query);
	// Test if there was a query error
        
        if (!$subject_set) {
		die("Database query failed.");
	}  
        
        return $subject_set;
}


function find_pages_for_subject($subject_id) {
    
    global $connection;
        $query  = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE visible = 1 ";
        $query .= "AND subject_id = {$subject_id} ";
	$query .= "ORDER BY position ASC";
	$pageset = mysqli_query($connection, $query);
	// Test if there was a query error
   confirm_query($pageset);

    return $pageset;
}

function navigation($subject_array, $page_array) {

     $output = "<ul class=\"subjects\">";
		$subject_set = find_all_subjects();
		while($subject = mysqli_fetch_assoc($subject_set)) {
			$output .= "<li";
			if ($subject_array && $subject["id"] == $subject_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"manage_content.php?subject=";
			$output .= urlencode($subject["id"]);
			$output .= "\">";
			$output .= $subject["menu_name"];
			$output .= "</a>";
			
			$page_set = find_pages_for_subject($subject["id"]);
			$output .= "<ul class=\"pages\">";
			while($pages = mysqli_fetch_assoc($page_set)) {
				$output .= "<li";
				if ($page_array && $pages["id"] == $page_array["id"]) {
					$output .= " class=\"selected\"";
				}
				$output .= ">";
				$output .= "<a href=\"manage_content.php?pages=";
				$output .= urlencode($pages["id"]);
				$output .= "\">";
				$output .= $pages["menu_name"];
				$output .= "</a></li>";
			}
			mysqli_free_result($page_set);
			$output .= "</ul></li>";
		}
		mysqli_free_result($subject_set);
		$output .= "</ul>";
		return $output;
}


function find_subject_by_id($subject_id) {
   global $connection;

  $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
   
  $query  = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE id = {$safe_subject_id} ";
	$query .= "LIMIT 1";
	$subject_set = mysqli_query($connection, $query);
	// Test if there was a query error
        confirm_query($subject_set);
   
        
 
	
		if($subject = mysqli_fetch_assoc($subject_set)) {
			return $subject;
		} else {
			return null;
		}
      

        
         
}


function find_page_by_id($page_id) {
    
       global $connection;
    
    $safe_subject_id = mysqli_real_escape_string($connection, $page_id);
    
    $query  = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE id = {$safe_subject_id} ";
	$query .= "LIMIT 1";
	$pageset = mysqli_query($connection, $query);
	// Test if there was a query error
   confirm_query($pageset);
   
   if($page = mysqli_fetch_assoc($pageset)) {
			return $page;
		} else {
			return null;
		}
    
}

function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}


function redirect_to($new_location)
{
 header('Location: '.$new_location);
 exit;
}

function mysql_clean($string)
{
     global $connection;
    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
}
?>