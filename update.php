<?php

include 'conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $id        = isset($_POST['id'])        ? intval($_POST['id'])      : 0;
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname  = isset($_POST['lastname'])  ? trim($_POST['lastname'])  : '';
    $age       = isset($_POST['age'])       ? trim($_POST['age'])       : '';
    $sex       = isset($_POST['sex'])       ? trim($_POST['sex'])       : '';
    $section   = isset($_POST['section'])   ? trim($_POST['section'])   : '';
    $course    = isset($_POST['course'])    ? trim($_POST['course'])    : '';
    $yearlevel = isset($_POST['yearlevel']) ? trim($_POST['yearlevel']) : '';
    $major     = isset($_POST['major'])     ? trim($_POST['major'])     : '';

   
    if ($id <= 0) {
        
        echo "Error: Invalid Student ID.";
        $conn->close();
        
        exit();
    }

    
    $query = "UPDATE student SET 
                firstname=?, 
                lastname=?, 
                age=?, 
                sex=?, 
                section=?, 
                course=?, 
                yearlevel=?, 
                major=? 
              WHERE id=?";

   
    if ($stmt = $conn->prepare($query)) {

       
        $bind_type = "ssisssssi"; 
        
        $stmt->bind_param($bind_type, 
            $firstname, 
            $lastname, 
            $age, 
            $sex, 
            $section, 
            $course, 
            $yearlevel, 
            $major,
            $id
        );

       
        if ($stmt->execute()) {
            
        } else {
           
            echo " Database Update Error: The query failed to run. Details: " . $stmt->error;
            $stmt->close();
            $conn->close();
            exit();
        }

        
        $stmt->close();

    } else {
       
        echo "Query Preparation Error: Could not prepare the statement. Details: " . $conn->error;
        $conn->close();
        exit();
    }

    
    $conn->close();
    header("Location: index.php"); 
    exit();

} else {
   
    header("Location: index.php");
    exit();
}
?>