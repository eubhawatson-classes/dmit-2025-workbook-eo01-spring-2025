<?php

$first_password = $_POST['first-password'] ?? '';
$second_password = $_POST['second-password'] ?? '';
$is_match = NULL;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Hashes the first password as we normally would when the user registers for an account.
    $first_hash = password_hash($first_password, PASSWORD_DEFAULT);

    // While we don't need to hash the second pasword, we will anyway (just to show that different values result in different hashes, and that even the same values result in different hashes).
    $second_hash = password_hash($second_password, PASSWORD_DEFAULT);

    /* 
        This compares the second password (which is in plain text) with the hash generated from the first password (stored in the database). This method will either return TRUE (if it's a match) or FALSE (if it's not a match). 
    
        This method uses statistical likelihoods in evaluating whether the second password matches the stored hash. This means that it's possible that something called a data collision may happen. This is when the user types a password that is incorrect but it is still accepted.

        However, the probability of a data collision using the BCRYPT algorithm is 6.842×10-49 (in scientific notation), or:

        6.842×10⁻⁴⁹ = 0.0000000000000000000000000000000000000000000000006842

        (This is 6.842 deciquindecillionths!)
     */
    $is_match = password_verify($second_password, $first_hash);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Password Hashing Demo</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  </head>
  <body class="container">
    <main class="row justify-content-center my-5">
        <section class="col col-md-10 col-lg-8">
            <h1 class="text-center display-6">How does password encryption work?</h1>
            <p class="lead text-center">Enter a password to see how hashing works. Then, enter another password to see if it matches the first.</p>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="border border-secondary rounded p-3">
                <!-- First Password -->
                 <div class="mb-3">
                    <label for="first-password" class="form-label">First Password</label>
                    <input type="text" name="first-password" id="first-password" value="<?= $first_password; ?>" class="form-control">
                    <p class="form-text">Enter a string, password, or phrase you'd like to test.</p>

                    <?php if ($first_password != '') : ?>
                        <div class="border border-warning rounded p-3">
                            <p class="form-text">For the first password, you entered: <span class="fw-bold"><?= $first_password; ?></span></p>
                            <p class="form-text">When encrypted, it produced the following hash: <span class="fw-bold"><?= $first_hash; ?></span></p>
                            <p class="form-text">In a real world scenario, this password would be the one provided by the user during their account registration. It would then go through an encryption algorithm and the result hash would be stored in a secure database.</p>
                        </div>
                    <?php endif; ?>
                 </div>

                <!-- Second Password -->
                 <div class="mb-3">
                    <label for="second-password" class="form-label">Second Password</label>
                    <input type="text" name="second-password" id="second-password" value="<?= $second_password; ?>" class="form-control">
                    <p class="form-text">Now, enter another. This one can be identical or different to the one above.</p>

                    <?php if ($second_password != '') : ?>
                        <div class="border border-warning rounded p-3">
                            <p class="form-text">For the second password, you entered: <span class="fw-bold"><?= $second_password; ?></span></p>
                            <p class="form-text">When encrypted, it produced the following hash: <span class="fw-bold"><?= $second_hash; ?></span></p>
                            <p class="form-text">In a real world scenario, this password would be what a user types when trying to log in. The PHP engine would the compare it to the hash stored in the database to see if it's statistically likely that the password are identical.</p>
                        </div>
                    <?php endif; ?>
                 </div>

                <!-- Submit Button -->
                <input type="submit" name="submit" id="submit" value="Hash & Compare" class="btn btn-primary">
            </form>
        </section>
    </main>
  </body>
</html>