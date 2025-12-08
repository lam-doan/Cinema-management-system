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
    <main class="showtimes-main">
        <h2>Manage showtimes</h2>
        <div class="showtimes-content">
            <?php
                // Default sort settings
                $order = "ASC";
                $column = "s.start";

                // Check GET parameters
                if (isset($_GET['sort'])) {
                    $order = ($_GET['sort'] === 'desc') ? "DESC" : "ASC";
                }
                if (isset($_GET['column'])) {
                    if ($_GET['column'] === 'end') {
                        $column = "s.end";
                    } else {
                        $column = "s.start";
                    }
                }

                // Build query with dynamic ORDER BY
                $sql = "SELECT a.name as auditorium_name, m.title AS movie_title, s.format, s.start, s.end 
                        FROM shows s
                        JOIN auditorium a ON s.auditoriumid = a.auditoriumid
                        JOIN movie m ON s.movieid = m.movieid
                        ORDER BY $column $order";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='showtimes-table'> <table>
                            <tr>
                                <th>Auditorium Name</th>
                                <th>Movie Title</th>
                                <th>Format</th>
                                <th>
                                    <a href='?column=start&sort=" . (($column == 's.start' && $order == 'ASC') ? 'desc' : 'asc') . "'>
                                        Start Time " . 
                                        (($column == 's.start') ? ($order == 'ASC' ? '↑' : '↓') : '') . "
                                    </a>
                                </th>
                                <th>
                                    <a href='?column=end&sort=" . (($column == 's.end' && $order == 'ASC') ? 'desc' : 'asc') . "'>
                                        End Time " . 
                                        (($column == 's.end') ? ($order == 'ASC' ? '↑' : '↓') : '') . "
                                    </a>
                                </th>
                            </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['auditorium_name']) . "</td>
                                <td>" . htmlspecialchars($row['movie_title']) . "</td>
                                <td>" . htmlspecialchars($row['format']) . "</td>
                                <td>" . htmlspecialchars($row['start']) . "</td>
                                <td>" . htmlspecialchars($row['end']) . "</td>
                            </tr>";
                    }
                    echo "</table> </div>";
                } else {
                    echo "<p>No showtimes available.</p>";
                }
            ?>
            <div>
                <nav class="showtimes-nav">
                    <button class="tab-button active" data-tab="add">Add Showtimes</button>
                    <button class="tab-button" data-tab="delete">Delete Showtimes</button>
                    <button class="tab-button" data-tab="update">Update Showtimes</button>
                </nav>

                <form id="showtimeForm" method="POST">
                    <div id="form-fields"></div>
                    <button type="submit" id="form-submit">Submit</button>
                </form>
                <?php if (isset($_GET['success'])): ?>
                        <div class="success">✅ Showtime added successfully!</div>
                        <?php elseif (isset($_GET['error'])): ?>
                        <div class="error">❌ Error: <?php echo htmlspecialchars($_GET['error']); ?></div>
                <?php endif; ?>
            </div>
            </div>
        </div>
        <a href='../index.php' class='back-link'>Back to Movies</a>
    </main>
    <?php include '../footer.php'; ?>
    <script src="showtimes.js"></script>
</body>
</html>