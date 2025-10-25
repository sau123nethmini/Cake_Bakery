<?php
// Include the database connection
include 'db_connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get and sanitize form data
    $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
    $surname = trim(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    // Basic validation
    if (!empty($first_name) && !empty($phone) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        try {
            // Prepare and execute the SQL statement
            $sql = "INSERT INTO applications (first_name, surname, phone, email) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$first_name, $surname, $phone, $email]);

            // Redirect back to the homepage with a success message
            header("Location: index.php?status=success#application");
            exit;

        } catch (PDOException $e) {
            // Handle database error
            header("Location: index.php?status=error#application");
            exit;
        }

    } else {
        // Handle invalid data
        header("Location: index.php?status=invalid#application");
        exit;
    }
} else {
    // Not a POST request
    header("Location: index.php");
    exit;
}
?>