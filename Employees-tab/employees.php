<?php include '../connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ABC Cinema Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include '../header.php'; ?>
    <main class="employee-main">
        <h2>Manage Employees</h2>

        <nav class="employee-nav">
            <button class="tab-button active" data-tab="add">Add Employee</button>
            <button class="tab-button" data-tab="delete">Delete Employee</button>
            <button class="tab-button" data-tab="update">Update Employee</button>
        </nav>

        <div id="add" class="tab-content active">
            <?php include 'add_employee.php'; ?>
        </div>
        <div id="delete" class="tab-content">
            <?php include 'delete_employee.php'; ?>
        </div>
        <div id="update" class="tab-content">
            <?php include 'update_employee.php'; ?>
        </div>
        <a href='../index.php' class='back-link'>Back to Employee</a>
    </main>
    <script src="employees.js"></script> 
    <?php include '../footer.php'; ?>
</body>
</html>