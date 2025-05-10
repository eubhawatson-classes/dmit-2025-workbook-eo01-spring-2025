<?php

// Here, we're bringing in our header content. Because this file uses a vairable called $title, we need to define it before including the file. 
$title = "Table of Contents";
include 'includes/header.php';

?>

<nav>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="problem-1.php" class="nav-link">Problem 1</a>
        </li>
        <li class="nav-item">
            <a href="problem-2.php" class="nav-link">Problem 2</a>
        </li>
        <li class="nav-item">
            <a href="problem-3.php" class="nav-link">Problem 3</a>
        </li>
    </ul>
</nav>

<?php

include 'includes/footer.php';

?>