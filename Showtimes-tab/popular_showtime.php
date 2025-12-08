<?php
include '../connect.php';

$sql = "SELECT
        m.title,
        DATE(s.start) AS show_date,
        COUNT(*) AS show_count
        FROM shows s
        JOIN movie m ON s.movieid = m.movieid
        GROUP BY m.movieid, m.title, DATE(s.start)
        HAVING COUNT(*) >= 3;
        ";

$popular_result = mysqli_query($conn, $sql);

if ($popular_result && mysqli_num_rows($popular_result) > 0) {
    echo "<div class='popular-table'><table>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Show Count</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($popular_result)) {
        echo "<tr>
                <td>" . htmlspecialchars($row['title']) . "</td>
                <td>" . htmlspecialchars($row['show_date']) . "</td>
                <td>" . htmlspecialchars($row['show_count']) . "</td>
              </tr>";
    }
    echo "</table></div>";
} else {
    echo "<div class='no-popular'>No movies with more than 3 showings per day.</div>";
}

?>