<form class="employee-form" action="employees.php" method="POST">
    <div>
        <label for="id">Employee ID:</label>
        <input type="text" id="id" name="id" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required>
    </div>
    <div>
        <label for="last name">Last Name:</label>
        <input type="text" id="last name" name="last name" required>
    </div>
    <div>
        <label for="first name">First name:</label>
        <input type="text" id="first name" name="first name" required>
    </div>
    <div>
        <label for="street number">Street Number:</label>
        <input type="number" id="street number" name="street number" required>
    </div>
    <div>
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
    </div>
    <div>
        <label for="state">State:</label>
        <input type="text" id="state" name="state" required>
    </div>
    <div>
        <label for="zip">Zip:</label>
        <input type="number" id="zip" name="zip" required>
    </div>
    <div>
        <label for="phone">Phone Number:</label>
        <input type="number" id="phone" name="phone" required>
    </div>
    <input type="submit" name="add_employee" value="Add Employee">
</form>

<?php
    include '../connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_employee'])) {
        $EmployeeId  = mysqli_real_escape_string($conn, $_POST['id']);
        $Password  = mysqli_real_escape_string($conn, $_POST['password']);
        $Fname = mysqli_real_escape_string($conn, $_POST['first name']);
        $Lname = mysqli_real_escape_string($conn, $_POST['last name']);
        $street_number = mysqli_real_escape_string($conn, $_POST['street number']);
        $City = mysqli_real_escape_string($conn, $_POST['city']);
        $State = mysqli_real_escape_string($conn, $_POST['state']);
        $Zip = mysqli_real_escape_string($conn, $_POST['zio']);
        $Phone = mysqli_real_escape_string($conn, $_POST['phone']);

        

        $sql = "INSERT INTO EMPLOYEE (EmployeeID, Password, Fname, Lname, street_number, City, State, Zip, Phone ) 
            VALUES ('$EmployeeId', '$Password', '$Fname', '$Lname', '$street_number', '$City', '$State', '$Zip', '$Phone')";

        if (mysqli_query($conn, $sql)) {
            echo "<p class='success'>Employee added successfully!</p>";
        } else {
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    mysqli_close($conn);
?>