<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ABC Cinema Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>🎬 ABC Cinema Management System</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="movies.php">Movies</a>
            <a href="shows.php">Showtimes</a>
            <a href="employees.php">Employees</a>
        </nav>
    </header>

    <main>
        <div class="search-bar">
            <input type="text" placeholder="Search Movies...">
        </div>

        <section class="movie-list">
        <?php 
            $sql = "SELECT * FROM movie";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='movie-card'>
                            <h3>".$row['title']."</h3>
                            <p><strong>Year:</strong> ".$row['year']."</p>
                            <p><strong>Duration:</strong> ".$row['duration']." mins</p>
                          </div>";
                }
            } else {
                echo "<p>No movies found.</p>";
            }
        ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 ABC Cinema Management System</p>
    </footer>
</body>
</html>