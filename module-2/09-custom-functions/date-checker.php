<?php

function validate_date($date) {
    // This is defining our date format, since dates can be formatted a whole tonne of different ways. This is a long-form year (2025), month (05), and day (28).
    $date_format = 'Y-m-d';

    // This takes the date that we passed in (which will be the user's date) and check to see if we can make it fit the specified format. If not, this method will throw some errors.
    $parsed_date = date_parse_from_format($date_format, $date);

    // $parsed_date now has year, month, day, and any errors that cropped up. Let's return TRUE if there are no errors AND the method confirmed that it's a legit calendar date.
    return $parsed_date['error_count'] === 0 
        && checkdate(
        $parsed_date['month'],
        $parsed_date['day'],
        $parsed_date['year']
    );
}

/**
 * Calculates how many days away a given date is from today's date.
 * 
 * @param string $date  A date, in YYYY-MM-DD format.
 * @return int          Number of days between today and provided $date.
 */
function calculate_days_difference($date) {
    // Let's start by asking the server for today's date (in Y-m-d format).
    $current_date = date('Y-m-d');

    // strtotime() converts our dates to timestamps (the number of seconds since the Unix Epoch); because these are just big long integers, we can use arithmetic on it now.
    $difference = strtotime($current_date) - strtotime($date);

    // Using seconds is great for doing the actual maths, but now we need to convert back to whole days for the user. There are 86400 seconds in a day.
    return round($difference / (60 * 60 * 24));
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Date Checker</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="container">
    <header class="row justify-content-center my-5">
        <section class="col-lg-6 col-md-8 text-center">
            <h1 class="display-6">Date Checker</h1>
            <p class="lead">Want to know how many days it's been since something has happened? What about a countdown until a day in the future? Enter a date below to check how many days are between then and now.</p>
        </section>
    </header>
    <main class="row justify-content-center my-5">
        <section class="col-lg-6 col-md-8">
            <h2>Your Date</h2>

            <!-- Form -->
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="border border-secondary rounded shadow-sm p-5 my-5">
                <div class="mb-3">
                    <label for="date" class="form-label">Enter a date:</label>
                    <input type="date" id="date" name="date" class="form-control" value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>" required>
                </div>
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
            </form>
        </section>

        <?php if (isset($_POST['date'])) : ?>
            <!-- Result -->
            <section class="col-lg-6 col-md-8">
                <h2>Your Result</h2>
            </section>
        <?php endif; ?>
    </main>
</body>

</html>