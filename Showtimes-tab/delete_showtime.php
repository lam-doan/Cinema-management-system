<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['moviename'], $_POST['auditoriumname'], $_POST['start'])) {
        $moviename = mysqli_real_escape_string($conn, $_POST['moviename']);
        $auditoriumname = mysqli_real_escape_string($conn, $_POST['auditoriumname']);
        $start = mysqli_real_escape_string($conn, $_POST['start']);

        // Look up movieid
        $sql_movie = "SELECT movieid FROM movie WHERE title = '$moviename'";
        $result_movie = mysqli_query($conn, $sql_movie);
        if ($result_movie && mysqli_num_rows($result_movie) > 0) {
            $movie_id = mysqli_fetch_assoc($result_movie)['movieid'];
        } else {
            header("Location: showtimes.php?error=" . urlencode("Movie not found"));
            exit;
        }

        // Look up auditoriumid
        $sql_auditorium = "SELECT auditoriumid FROM auditorium WHERE name = '$auditoriumname'";
        $result_auditorium = mysqli_query($conn, $sql_auditorium);
        if ($result_auditorium && mysqli_num_rows($result_auditorium) > 0) {
            $auditorium_id = mysqli_fetch_assoc($result_auditorium)['auditoriumid'];
        } else {
            header("Location: showtimes.php?error=" . urlencode("Auditorium not found"));
            exit;
        }

        // Convert datetime-local format (YYYY-MM-DDTHH:MM) to MySQL DATETIME (YYYY-MM-DD HH:MM:SS)
        $start_dt = str_replace('T', ' ', $start) . ':00';

        // Delete from shows table
        $sql_delete = "DELETE FROM shows
                       WHERE auditoriumid = '$auditorium_id' AND movieid = '$movie_id'AND start = '$start_dt'
                       ";

        if (mysqli_query($conn, $sql_delete)) {
            header("Location: showtimes.php?success=deleted");
            exit;
        } else {
            header("Location: showtimes.php?error=" . urlencode(mysqli_error($conn)));
            exit;
        }
    }
}
?>