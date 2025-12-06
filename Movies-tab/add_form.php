<form class="movie-form" action="movies.php" method="POST">
    <div>
        <label for="id">Movie ID:</label>
        <input type="text" id="id" name="id" required>
    </div>
    <div>
        <label for="release">Release Date:</label>
        <input type="date" id="release" name="release" required>
    </div>
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
    </div>
    <div>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required>
    </div>
    <div>
        <label for="duration">Duration (mins):</label>
        <input type="number" id="duration" name="duration" required>
    </div>
    <input type="submit" value="Add Movie">
</form>

<?php
    include '../connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $movieid     = mysqli_real_escape_string($conn, $_POST['id']);
        $released    = mysqli_real_escape_string($conn, $_POST['release']);
        $title       = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $year        = (int)$_POST['year'];
        $duration    = (int)$_POST['duration'];

        $sql = "INSERT INTO movie (movieid, released, title, description, year, duration) 
            VALUES ('$movieid', '$released', '$title', '$description', $year, $duration)";

        if (mysqli_query($conn, $sql)) {
            echo "<p class='success'>Movie added successfully!</p>";
            echo "<a href='movies.php' class='back-link'>Back to Movies</a>";
        } else {
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    mysqli_close($conn);
?>