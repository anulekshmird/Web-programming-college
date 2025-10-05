<?php
if (isset($_POST['search_name'])) {
    $search_name = $_POST['search_name'];

    $conn = new mysqli('localhost', 'root', '', 'college_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT reg_no, name, phone, email, dob, gender, branch FROM studdtls WHERE name LIKE ?");
    $like_name = "%".$search_name."%";
    $stmt->bind_param("s", $like_name);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Search Results</title>
        <style>
            body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
            .container { max-width: 800px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
            h2 { color: #003366; text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
            th { background-color: #003366; color: white; }
            .btn { display: inline-block; background: #003366; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 15px; }
            .btn:hover { background: #002244; }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Search Results for "<?=htmlspecialchars($search_name)?>"</h2>
            <?php if($result->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>Reg No</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Branch</th>
                    </tr>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?=htmlspecialchars($row['reg_no'])?></td>
                            <td><?=htmlspecialchars($row['name'])?></td>
                            <td><?=htmlspecialchars($row['phone'])?></td>
                            <td><?=htmlspecialchars($row['email'])?></td>
                            <td><?=htmlspecialchars($row['dob'])?></td>
                            <td><?=htmlspecialchars($row['gender'])?></td>
                            <td><?=htmlspecialchars($row['branch'])?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No students found with that name.</p>
            <?php endif; ?>
            <a class="btn" href="search_student.html">Back to Search</a>
            <a class="btn" href="register_student.html">Register New Student</a>
        </div>
    </body>
    </html>

    <?php
    $stmt->close();
    $conn->close();
} else {
    header("Location: search_student.html");
    exit();
}
?>
