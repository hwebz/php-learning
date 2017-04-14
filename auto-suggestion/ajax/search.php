<?php 
    require_once '../core/connect.php';

    if (isset($_POST['search_term']) && !empty($_POST['search_term'])) {
        $search_term = mysqli_real_escape_string($con, $_POST['search_term']);
        $query = mysqli_query($con, "SELECT * FROM cities WHERE city LIKE '%$search_term%'");
        while ($row = mysqli_fetch_assoc($query)) {
            echo '<a href="#" class="list-group-item">
                    <h4 class="list-group-item-heading">'.$row['city'].'</h4>
                  </a>';
        }
    }
?>