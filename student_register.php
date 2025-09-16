<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $message = $_POST['message'];

    $conn = new mysqli('localhost','root','','college_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO students (name,email,department,message) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $department, $message);

    if ($stmt->execute()) {
        // show details after insertion with styling
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Registration Success</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 500px;
                    margin: 50px auto;
                    background: #fff;
                    padding: 30px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    border-radius: 8px;
                }
                h2 {
                    color: #28a745;
                    text-align: center;
                }
                h3 {
                    color: #333;
                }
                p {
                    font-size: 16px;
                    line-height: 1.5;
                }
                .label {
                    font-weight: bold;
                    color: #555;
                }
                .btn {
                    display: inline-block;
                    background: #28a745;
                    color: #fff;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 4px;
                    margin-top: 15px;
                }
                .btn:hover {
                    background: #218838;
                }
            </style>
        </head>
        <body>
        <div class="container">
            <h2>Registration Successful!</h2>
            <h3>Your Details:</h3>
            <p><span class="label">Name:</span> <?=htmlspecialchars($name)?></p>
            <p><span class="label">Email:</span> <?=htmlspecialchars($email)?></p>
            <p><span class="label">Department:</span> <?=htmlspecialchars($department)?></p>
            <p><span class="label">Message:</span> <?=htmlspecialchars($message)?></p>
            <a class="btn" href="college_student.html">Register another student</a>
        </div>
        </body>
        </html>
        <?php
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

