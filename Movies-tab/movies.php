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
    <main class="movies-main">
        <h2>Manage Movies</h2>

        <nav class="movies-nav">
            <button class="tab-button active" data-tab="add">Add Movie</button>
            <button class="tab-button" data-tab="delete">Delete Movie</button>
            <button class="tab-button" data-tab="update">Update Movie</button>
        </nav>

        <div id="add" class="tab-content active">
            <?php include 'add_form.php'; ?>
        </div>
        <div id="delete" class="tab-content">
            <?php include 'delete_form.php'; ?>
        </div>
        <div id="update" class="tab-content">
            <?php include 'update_form.php'; ?>
        </div>
    </main>
    <script src="movies.js"></script>
    <?php include '../footer.php'; ?>
</body>
</html>