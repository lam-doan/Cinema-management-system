<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ABC Cinema Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="index-main">
        <div class="search-bar">
            <input type="text" placeholder="Search Movies..." id="movie-search">
            <select id="search-filter">
                <option>-- Sort By --</option>
                <option value="asc-by-year">Year (ASC)</option>
                <option value="desc-by-year">Year (DESC)</option>
            </select>
        </div>

        <section class="movie-list">
        <?php 
            $sql = "SELECT * FROM movie";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='movie-card'>
                            <h3>".$row['title']."</h3>
                            <p><strong>Movie ID:</strong> ".$row['movieid']."</p>
                            <p><strong>Year:</strong><span class='movie-year'> ".$row['year']."</span></p>
                            <p><strong>Duration:</strong> ".$row['duration']." mins</p>
                          </div>";
                }
            } else {
                echo "<p>No movies found.</p>";
            }
        ?>
        </section>
    </main>
    <script src="index.js"></script>
    <?php include 'footer.php'; ?>
</body>
</html>