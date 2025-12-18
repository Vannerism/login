<?php
/**
 * insert.php - Handles inserting a new student record into the database.
 * * NOTE: This version includes robust error checking to help diagnose blank pages.
 */

// 1. Include the database connection file (make sure conn.php is correct)
include 'conn.php';

// Check if the script was accessed via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 2. Define expected fields
    $expected_fields = ['firstname', 'lastname', 'age', 'sex', 'section', 'course', 'yearlevel', 'major'];
    $data = [];
    $is_valid = true;

    // Collect and validate all inputs
    foreach ($expected_fields as $field) {
        if (!isset($_POST[$field])) {
            $is_valid = false;
            echo "Error: Missing field '{$field}'. Please ensure all form inputs have the correct 'name' attribute.";
            $conn->close();
            exit(); // Stop execution immediately if a field is missing
        }
        $data[$field] = trim($_POST[$field]);
    }

    // 3. Prepare the SQL INSERT statement
    // IMPORTANT: Ensure your 'student' table has columns matching these names exactly.
    $query = "INSERT INTO student 
              (firstname, lastname, age, sex, section, course, yearlevel, major) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // 4. Initialize and prepare the statement
    if ($stmt = $conn->prepare($query)) {

        // 5. Bind the variables to the prepared statement as parameters
        // 's' = string, 'i' = integer. Ensure the sequence matches the columns above.
        // If 'age' is INT in your DB, you must use 'i'. 
        // If everything else is VARCHAR/TEXT, use 's'. The sequence below is "ssisssss"
        
        // Assuming 'age' is an integer:
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

        // 6. Execute the statement
        if ($stmt->execute()) {
            // Success
            header("Location: index.php"); 
            exit();
        } else {
            // Failure: Execution error
            echo "❌ Database Execution Error: The query failed to run. Check the following: <br>";
            echo "Error details: " . $stmt->error . "<br>";
            echo "Query: " . $query;
            $stmt->close();
            $conn->close();
            exit();
        }

    } else {
        // Failure: Preparation error (e.g., bad SQL syntax or connection issue)
        echo "❌ Query Preparation Error: Could not prepare the statement.<br>";
        echo "Error details: " . $conn->error;
        $conn->close();
        exit();
    }

} else {
    // If not a POST request, redirect user away
    header("Location: index.php");
    exit();
}
?>