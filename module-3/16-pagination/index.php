<?php

$title = "Home";
include 'includes/header.php';
include 'includes/functions.php';

// How many results per page? We'll check both the form and the query string.
$per_page = $POST['number-of-records'] ?? $_GET['number-of-records'] ?? 12;

$total_count = count_records();

// In our example, we have 152 records; divided by 12, that's 12.666... pages. However, since you can't have a fraction of a page (we still need a complete page for those last few records), we must always round our quotient UP.
$total_pages = ceil($total_count / $per_page);

?>

<h2 class="display-5 my-3">Welcome to the Happy Planet Index</h2>
<p class="lead mb-5">The Happy Planet Index is a measure of sustainable wellbeing, ranking countries by how efficiently they deliver long, happy lives using our limited environmental resources.</p>

<!-- This is the form control for our pagination. They will allow the user to choose how many records they want to see per page. -->
<aside class="my-3">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="input-group">
            <label for="number-of-results" class="input-group-text">Countries per Page:</label>
            <select name="number-of-results" id="number-of-results" class="form-select" aria-label="Countries per Page">
                <!-- The array in our foreach loop will become the number of records the table can display. -->
                <?php foreach ([12, 24, 48] as $value) : ?>
                    <option value="<?= $value; ?>" <?= ($per_page == $value) ? 'selected' : ''; ?>><?= $value; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="submit-page-number" id="submit-page-number" value="Submit" class="btn btn-success">
        </div>
    </form>
</aside>

<?php
$sql = "SELECT rank, country FROM happiness_index;";

$result = $connection->query($sql);

if ($connection->error) : ?>

    <p>Oh no! There was an issue retrieving the data.</p>

<?php

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
                extract($row);

                echo "<tr> \n
                    <td>$rank</td> \n
                    <td>$country</td> \n
                    <td><a href=\"country.php?rank=" . urlencode($rank) . "&country=" . urlencode($country) . "\" class=\"link-success\">View Stats</a></td> \n
                 </tr> \n ";
            }

            ?>
        </tbody>
    </table>

<?php endif;

include 'includes/footer.php';

?>