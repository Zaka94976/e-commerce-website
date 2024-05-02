
<?php
    // getting all values from the HTML form
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password= $_POST['confirm_password'];

        // Database details
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "zakaullah";
        $dbname = "register";

        // Creating a connection
        $con = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

        // Check connection
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Sanitize inputs to prevent SQL injection
        $username = mysqli_real_escape_string($con, $username);
        $password = mysqli_real_escape_string($con, $password);
        $confirm_password = mysqli_real_escape_string($con, $confirm_password);


        // Using prepared statement to insert data
        $sql = "INSERT INTO registration (username, password,confirm_password) VALUES (?, ?,?)";

        // Prepare and bind
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $username, $password,$confirm_password);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            echo "Entries added!";
        } else {
            echo "Error: " . mysqli_error($con);
        }

        // Close statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    }
?>
