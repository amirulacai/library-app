<?php
require('dbconn.php');

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $bookId = $_GET['id'];
    
    
    // Prepare a DELETE statement
    
    $deleteQuery = "DELETE FROM LMS.book WHERE BookId = '$bookId' or id like '%$bookId%'?";

    // Prepare and execute the statement
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $bookId);
    $stmt->execute();
    
    if($stmt->affected_rows > 0) {
        // Book successfully deleted
        header("Location: book.php"); // Redirect back to book.php after deletion
        exit();
    } else {
        // Book not found or deletion failed
        echo "Error deleting book.";
    }
} else {
    echo "Invalid book ID.";
}
?>
