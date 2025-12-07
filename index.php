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
                <option value="">-- Sort By --</option>
                <option value="asc-by-id">Movie ID (ASC)</option>
                <option value="desc-by-id">Movie ID (DESC)</option>
                <option value="asc-by-title">Title (A-Z)</option>
                <option value="desc-by-title">Title (Z-A)</option>
                <option value="asc-by-year">Year (ASC)</option>
                <option value="desc-by-year">Year (DESC)</option>
            </select>
        </div>

        <section class="movie-list">
        <?php 
            $sql = "SELECT m.movieid, m.title, m.description, m.year, m.duration,
                        GROUP_CONCAT(g.name SEPARATOR ', ') AS genres
                    FROM movie m
                    LEFT JOIN moviegenre mg ON m.movieid = mg.movieid
                    LEFT JOIN genre g ON mg.genreid = g.genreid
                    GROUP BY m.movieid, m.title, m.description, m.year, m.duration";

            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='movie-card'>
                            <h3 class='movie-title'>".$row['title']."</h3>
                            <p><strong>Movie ID:</strong> <span class='movie-id'>".$row['movieid']."</span></p>
                            <p><strong>Description:</strong> ".$row['description']."</p>
                            <p><strong>Year:</strong> <span class='movie-year'>".$row['year']."</span></p>
                            <p><strong>Duration:</strong> ".$row['duration']." mins</p>
                            <p><strong>Genres:</strong> ".$row['genres']."</p>
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