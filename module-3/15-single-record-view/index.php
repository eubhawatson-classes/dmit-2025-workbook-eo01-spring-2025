<?php

$title = "Home";
include 'includes/header.php';

?>

<h2 class="display-5 my-3">Welcome to the Happy Planet Index</h2>
<p class="lead mb-5">The Happy Planet Index is a measure of sustainable wellbeing, ranking countries by how efficiently they deliver long, happy lives using our limited environmental resources.</p>

<?php
$sql = "SELECT rank, country FROM happiness_index;";

/*
        Last class, we grabbed our results this way: 

        $result = mysqli_query($connection, $sql);

        This is the programmatic method for mysqli; let's try the object-oriented version instead.
     */

$result = $connection->query($sql);

// If there's an error in the connection or retrieving the results, we can handle it here and display a message to the user.

if ($connection->error) : ?>

    <p>Oh no! There was an issue retrieving the data.</p>

<?php 

// This is the OOP way of writing: if (mysqli_num_rows($result) > 0)
elseif ($result->num_rows > 0) : ?>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>HPI Rank</th>
            <th>Country Name</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php
        
        while ($row = $result->fetch_assoc()) {
            // Extracting an array takes all of the keys and turns them into variables, automatically assigned  their values. This means that we now have variables with the same names as each column we selected from the table.
            extract($row);

            echo "<tr> \n
                    <td>$rank</td> \n
                    <td>$country</td> \n
                    <td><a href=\"country.php?rank=" . urlencode($rank) . "&country=" . urlencode($country) . "\" class=\"link-success\">View Stats</a></td> \n
                 </tr> \n ";

            // We are sending the user to the country page (single record page) with a query string. However, some of the countries have characters in them that are illegal for URLS (like spaces). Using urlencode(), we can 'translate' those illegal characters into something that our browser can still read.
        }

        ?>
    </tbody>
</table>

<?php endif;

include 'includes/footer.php';

?>