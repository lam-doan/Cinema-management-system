<?php include '../connect.php'; ?>

<form class="movie-form" action="movies.php" method="POST">
    <select class="option-to-change" name="option_to_change" id="option_to_change" required>
        <option value="id">Movie ID</option>
        <option value="title">Movie Title</option>
        <option value="released">Release Date</option>
        <option value="description">Description</option>
        <option value="year">Year</option>
        <option value="duration">Duration</option>
    </select>
    <input id="new_value" class="option-to-change" type="text" name="new_value" placeholder="New Value" required>

    <select name="option_to_identify" id="option_to_identify" required>
        <option value="id">Movie ID</option>
        <option value="title">Movie Title</option>
    </select>
    <input type="text" id="movie_to_update" name="movie_to_update" placeholder="Movie to be updated" required>
    <input type="submit" name="update_movie" value="Update Movie" class="update-btn">
</form>

<script>
    document.getElementById('option_to_change').addEventListener('change', function() {
        var new_value_input = document.getElementById('new_value');
        if (this.value === 'released') {
            new_value_input.type = 'date';
        } else if (this.value === 'year' || this.value === 'duration') {
            new_value_input.type = 'number';
        } else {
            new_value_input.type = 'text';
        }
    })
</script>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_movie'])) {
        $option_to_change = mysqli_real_escape_string($conn, $_POST['option_to_change']);
        $new_value = mysqli_real_escape_string($conn, $_POST['new_value']);
        $option_to_identify = mysqli_real_escape_string($conn, $_POST['option_to_identify']);
        $movie_to_update = mysqli_real_escape_string($conn, $_POST['movie_to_update']);

        $sql = "UPDATE movie SET $option_to_change='$new_value' WHERE $option_to_identify ='$movie_to_update'";

        if (mysqli_query($conn, $sql)) {
            echo "<p class='success'>Movie updated successfully!</p>";
            echo "<h2 class='updated-movie'>Updated Movie:</h2>";
            $result = mysqli_query($conn, "SELECT * FROM movie WHERE $option_to_identify ='$movie_to_update'");
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <div class='movie-card' style='margin-left:auto; margin-right:auto;'>
                        <h3>{$row['title']}</h3>
                        <p class='movie-year'><strong>Year:</strong> {$row['year']}</p>
                        <p><strong>Duration:</strong> {$row['duration']} mins</p>
                        <p><strong>Release Date:</strong> {$row['released']}</p>
                        <p><strong>Description:</strong> {$row['description']}</p>
                    </div>";
                }
            }
        } else {
            echo "<p class='error'>Error updating movie: " . mysqli_error($conn) . "</p>";
        }
    }
    mysqli_close($conn);
?>