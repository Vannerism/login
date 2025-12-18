<?php

include 'conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $expected_fields = ['firstname', 'lastname', 'age', 'sex', 'section', 'course', 'yearlevel', 'major'];
    $data = [];
    $is_valid = true;

    
    foreach ($expected_fields as $field) {
        if (!isset($_POST[$field])) {
            $is_valid = false;
            echo "Error: Missing field '{$field}'. Please ensure all form inputs have the correct 'name' attribute.";
            $conn->close();
            exit(); 
        }
        $data[$field] = trim($_POST[$field]);
    }

    
    $query = "INSERT INTO student 
              (firstname, lastname, age, sex, section, course, yearlevel, major) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    
    if ($stmt = $conn->prepare($query)) {

        
        $bind_type = "ssisssss"; 
        
        $stmt->bind_param($bind_type, 
            $data['firstname'], 
            $data['lastname'], 
            $data['age'], 
            $data['sex'], 
            $data['section'], 
            $data['course'], 
            $data['yearlevel'], 
            $data['major']
        );

        
        if ($stmt->execute()) {
            
            header("Location: index.php"); 
            exit();
        } else {
            
            echo " Database Execution Error: The query failed to run. Check the following: <br>";
            echo "Error details: " . $stmt->error . "<br>";
            echo "Query: " . $query;
            $stmt->close();
            $conn->close();
            exit();
        }

    } else {
        
        echo " Query Preparation Error: Could not prepare the statement.<br>";
        echo "Error details: " . $conn->error;
        $conn->close();
        exit();
    }

} else {
    
    header("Location: index.php");
    exit();
}
?>