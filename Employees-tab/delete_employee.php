<?php
include '../connect.php';

// Handle delete submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $employeeid = mysqli_real_escape_string($conn, $_POST['delete_id']);
    $sql = "DELETE FROM EMPLOYEE WHERE EmployeeId='$employeeid'";

    if (mysqli_query($conn, $sql)) {
        echo "<p class='success'>Employee deleted successfully!</p>";
        echo "<a href='employees.php' class='back-link'>Back to Employees</a>";
    } else {
        echo "<p class='error'>Error deleting employee: " . mysqli_error($conn) . "</p>";
    }
}

// Show list of employees
$result = mysqli_query($conn, "SELECT * FROM EMPLOYEE ORDER BY Fname DESC");

if ($result && mysqli_num_rows($result) > 0) {
    echo "<div class='employee-list'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "
        <div class='employee-card'>
            <h3>{$row['title']}</h3>
            <p class='employee-id'><strong>Employee ID:</strong> {$row['EmployeeId']}</p>
            <p><strong>Name:</strong> {$row['Fname']} {$row['Lname']} </p>
            <form method='POST' action='employees.php'>
                <input type='hidden' name='delete_id' value='{$row['EmployeeId']}'>
                <input type='submit' value='Delete' class='delete-btn'>
            </form>
        </div>
        ";
    }
    echo "</div>";
} else {
    echo "<p>No employees found.</p>";
}

mysqli_close($conn);
?>