<?php
include 'connect.php'; ?>

<footer>
    <p>&copy; 2025 ABC Cinema Management System</p>
    <?php
        $sql = "SELECT name, street_number, city, state, zip FROM cinema";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<div class='cinema-content'>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='cinema-card'>
                        <h3 class='cinema-title'>".$row['name']."</h3>
                        <p><strong>Address:</strong> 
                            <span class='street-number'>".$row['street_number']."</span>,
                            <span class='city'>".$row['city']."</span>,
                            <span class='state'>".$row['state']."</span>
                            <span class='zip'>".$row['zip']."</span>
                        </p>
                      </div>";
            }
            echo "</div>";
        } else {
            echo "<p>No cinemas found.</p>";
        }
    ?>
</footer>