<?php include '../connect.php'; ?>

<form class="employee-form" action="employees.php" method="POST">
    <select class="option-to-change" name="option_to_change" id="option_to_change" required>
        <option value="EmployeeId">Employee ID</option>
        <option value="Fname">First Name</option>
        <option value="Lname">Last Name</option>
        <option value="password">Password</option>
        <option value="street_number">Street Number</option>
        <option value="city">City</option>
        <option value="state">State</option>
        <option value="zip">Zip</option>
        <option value="phone">Phone Number</option>
    </select>
    <input id="new_value" class="option-to-change" type="text" name="new_value" placeholder="New Value" required>

    <select name="option_to_identify" id="option_to_identify" required>
        <option value="EmployeeId">Employee ID</option>

    </select>
    <input type="text" EmployeeId="employee_to_update" name="employee_to_update" placeholder="Employee to be updated" required>
    <input type="submit" name="update_employee" value="Update Employee" class="update-btn">
</form>

<script>
    document.getElementById('option_to_change').addEventListener('change', function() {
        var new_value_input = document.getElementById('new_value');
        if (this.value === 'Fname') {
            new_value_input.type = 'number';
        } else if (this.value === 'Lname') {
            new_value_input.type = 'text';
        } else (this.value === 'password') {
            new_value_input.type = 'text';
        } else (this.value === 'street_number') {
            new_value_input.type = 'text';
        } else (this.value === 'city') {
            new_value_input.type = 'text';
        } else (this.value === 'state') {
            new_value_input.type = 'text';
        } else (this.value === 'Zip') {
            new_value_input.type = 'text';
        } else (this.value === 'phone') {
            new_value_input.type = 'number';
        } else {
            new_value_input.type = 'number';
        }
    })
</script>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_employee'])) {
        $option_to_change = mysqli_real_escape_string($conn, $_POST['option_to_change']);
        $new_value = mysqli_real_escape_string($conn, $_POST['new_value']);
        $option_to_identify = mysqli_real_escape_string($conn, $_POST['option_to_identify']);
        $employee_to_update = mysqli_real_escape_string($conn, $_POST['employee_to_update']);

        $sql = "UPDATE EMPLOYEE SET $option_to_change='$new_value' WHERE $option_to_identify ='$employee_to_update'";

        if (mysqli_query($conn, $sql)) {
            echo "<p class='success'>Employee updated successfully!</p>";
            echo "<h2 class='updated-movie'>Updated Employee:</h2>";
            $result = mysqli_query($conn, "SELECT * FROM EMPLOYEE WHERE $option_to_identify ='$employee_to_update'");
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <div class='movie-card' style='margin-left:auto; margin-right:auto;'>
                        <h3>{$row['title']}</h3>
                        <p class='employee-id'><strong>Employee ID:</strong> {$row['EmployeeId']}</p>
                        <p><strong>Name:</strong> {$row['Fname']} {$row['Lname']} </p>
                        <p><strong>Address:</strong> {$row['street_number']} {$row['city']} {$row['state']} {$row['Zip']} </p>
                        <p><strong>Phone Number:</strong> {$row['Phone']} </p>
                    </div>";
                }
            }
        } else {
            echo "<p class='error'>Error updating movie: " . mysqli_error($conn) . "</p>";
        }
    }
    mysqli_close($conn);
?>