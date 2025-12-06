<?php
include '../connect.php';

// Handle delete submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $movieid = mysqli_real_escape_string($conn, $_POST['delete_id']);
    $sql = "DELETE FROM movie WHERE movieid='$movieid'";

    if (mysqli_query($conn, $sql)) {
        echo "<p class='success'>Movie deleted successfully!</p>";
        echo "<a href='movies.php' class='back-link'>Back to Movies</a>";
    } else {
        echo "<p class='error'>Error deleting movie: " . mysqli_error($conn) . "</p>";
    }
}

// Show list of movies
$result = mysqli_query($conn, "SELECT * FROM movie ORDER BY year DESC");

if ($result && mysqli_num_rows($result) > 0) {
    echo "<div class='movie-list'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "
        <div class='movie-card'>
            <h3>{$row['title']}</h3>
            <p class='movie-year'><strong>Year:</strong> {$row['year']}</p>
            <p><strong>Duration:</strong> {$row['duration']} mins</p>
            <form method='POST' action='movies.php'>
                <input type='hidden' name='delete_id' value='{$row['movieid']}'>
                <input type='submit' value='Delete' class='delete-btn'>
            </form>
        </div>
        ";
    }
    echo "</div>";
} else {
    echo "<p>No movies found.</p>";
}

mysqli_close($conn);
?>