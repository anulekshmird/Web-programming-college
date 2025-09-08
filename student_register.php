<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $department = htmlspecialchars($_POST['department']);
    $message = htmlspecialchars($_POST['message']);

    echo "<h2 style='color:#003366; text-align:center;'>Student Registration Details</h2>";
    echo "<div style='max-width:600px; margin:20px auto; padding:20px; border:1px solid #ccc; border-radius:8px; font-family:Arial;'>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Department:</strong> $department</p>";
    echo "<p><strong>Message:</strong> $message</p>";
    echo "<p style='text-align:center;'><a href='college_student.html'>Go Back</a></p>";
    echo "</div>";
} else {
    echo "<p>No data submitted.</p>";
}
?>
