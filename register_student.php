<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_no = $_POST['reg_no'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $branch = $_POST['branch'];

    $conn = new mysqli('localhost', 'root', '', 'college_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO studdtls (reg_no, name, phone, email, dob, gender, branch) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $reg_no, $name, $phone, $email, $dob, $gender, $branch);

    if ($stmt->execute()) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Registration Successful</title>
            <style>
                body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
                .container { max-width: 500px; margin: 50px auto; background: #fff; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; }
                h2 { color: #28a745; text-align: center; }
                p { font-size: 16px; line-height: 1.5; }
                .label { font-weight: bold; color: #555; }
                .btn { display: inline-block; background: #003366; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 15px; }
                .btn:hover { background: #002244; }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Registration Successful!</h2>
                <p><span class="label">Register No:</span> <?=htmlspecialchars($reg_no)?></p>
                <p><span class="label">Name:</span> <?=htmlspecialchars($name)?></p>
                <p><span class="label">Phone:</span> <?=htmlspecialchars($phone)?></p>
                <p><span class="label">Email:</span> <?=htmlspecialchars($email)?></p>
                <p><span class="label">DOB:</span> <?=htmlspecialchars($dob)?></p>
                <p><span class="label">Gender:</span> <?=htmlspecialchars($gender)?></p>
                <p><span class="label">Branch:</span> <?=htmlspecialchars($branch)?></p>

                <a class="btn" href="search_student.html">Search Students</a>
                <a class="btn" href="register_student.html">Register Another Student</a>
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
