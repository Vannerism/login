<?php
/**
 * update.php - Handles updating an existing student record in the database.
 * * This script is the action target for the inline Edit modal forms.
 */

// 1. Include the database connection file
include 'conn.php';

// Check if the script was accessed via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 2. Collect and validate input data
    $id        = isset($_POST['id'])        ? intval($_POST['id'])      : 0;
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname  = isset($_POST['lastname'])  ? trim($_POST['lastname'])  : '';
    $age       = isset($_POST['age'])       ? trim($_POST['age'])       : '';
    $sex       = isset($_POST['sex'])       ? trim($_POST['sex'])       : '';
    $section   = isset($_POST['section'])   ? trim($_POST['section'])   : '';
    $course    = isset($_POST['course'])    ? trim($_POST['course'])    : '';
    $yearlevel = isset($_POST['yearlevel']) ? trim($_POST['yearlevel']) : '';
    $major     = isset($_POST['major'])     ? trim($_POST['major'])     : '';

    // Critical check: Ensure ID is valid
    if ($id <= 0) {
        // Log or display an error, then redirect
        echo "Error: Invalid Student ID.";
        $conn->close();
        // header("Location: index.php"); 
        exit();
    }

    // 3. Prepare the SQL UPDATE statement
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

    // 4. Initialize and prepare the statement
    if ($stmt = $conn->prepare($query)) {

        // 5. Bind the variables to the prepared statement parameters
        // Bind types: (8 parameters + 1 WHERE parameter)
        // 's' = string, 'i' = integer. Assuming 'age' is int and the final 'id' is int.
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

        // 6. Execute the statement
        if ($stmt->execute()) {
            // Success: Record was updated
            // Do not print anything, just redirect
        } else {
            // Failure: Execution error
            echo "❌ Database Update Error: The query failed to run. Details: " . $stmt->error;
            $stmt->close();
            $conn->close();
            exit();
        }

        // 7. Close the statement
        $stmt->close();

    } else {
        // Failure: Preparation error
        echo "❌ Query Preparation Error: Could not prepare the statement. Details: " . $conn->error;
        $conn->close();
        exit();
    }

    // 8. Close the database connection and redirect back to the main dashboard
    $conn->close();
    header("Location: index.php"); // Assuming your main page is named index.php
    exit();

} else {
    // If not a POST request, redirect user away
    header("Location: index.php");
    exit();
}
?>