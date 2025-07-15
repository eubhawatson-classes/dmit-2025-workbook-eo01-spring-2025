<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="border border-secondary-subtle rounded shadow-sm p-3">

    <h2 class="fs-4 fw-light mb-4">City Details</h2>

    <!-- City Name -->
    <div class="mb-4">
        <label for="city-name" class="form-label">Name</label>
        <input type="text" id="city-name" name="city-name" class="form-control" value="<?= htmlspecialchars($_POST['city-name'] ?? ($city['city_name'] ?? '')); ?>">
        <p class="form-text">What is the name of your city, town, or village?</p>
    </div>

    <!-- Province or Territory -->
    <div class="mb-4">
        <label for="province" class="form-label">Province or Territory</label>
        <select name="province" id="province" class="form-select form-select-lg">
            <option value="">-- Please Select --</option>
            <?php

            // This loop will generate the rest of the options for the user, using the provincial abbreviations array in functions.php (included in the header).
            foreach ($provincial_abbr as $key => $value) {
                // We'll also check to see if they previously selected a province (in the case of returning to the form to fix an error).
                $selected = ($_POST['province'] ?? ($city['province'] ?? '')) === $key ? 'selected' : '';
                echo "<option value=\"$key\" $selected>$value</option>";
            }

            ?>
        </select>
    </div>

    <!-- Population -->
    <div class="mb-4">
        <label for="population" class="form-label">Population</label>
        <input type="number" name="population" id="population" class="form-control" value="<?= htmlspecialchars($_POST['population'] ?? ($city['population'] ?? '')); ?>">
        <p class="form-text">What is the approximate population?</p>
    </div>

    <!-- Capital City -->
    <fieldset class="mb-4">
        <legend class="fw-normal fs-6">Is this city the capital of its province or territory?</legend>

        <?php
        // This checks to see whether the user set this city as the capital and, if not, whether this city is a capital as defined by its record in the database. This will resolve as a 1 (yes) or a 0 (no), both of which are treated as strings by PHP.
        $capital = $_POST['capital'] ?? (isset($city['is_capital']) ? (string) $city['is_capital'] : '0');
        ?>

        <div class="form-check">
            <input type="radio" name="capital" id="is-capital" value="1" class="form-check-input" <?= $capital === '1' ? 'checked' : ''; ?>>
            <label for="is-capital" class="form-check-label">Yes</label>
        </div>

        <div class="form-check">
            <input type="radio" name="capital" id="not-capital" value="0" class="form-check-input" <?= $capital === '0' ? 'checked' : ''; ?>>
            <label for="not-capital" class="form-check-label">No</label>
        </div>
    </fieldset>

    <!-- Trivia -->
    <div class="mb-4">
        <label for="trivia" class="form-label">City Trivia (Optional)</label>
        <input type="text" id="trivia" name="trivia" class="form-control" value="<?= htmlspecialchars($_POST['trivia'] ?? ($city['trivia'] ?? '')); ?>">
        <p class="form-text">You may add a fun fact or piece of trivia for your city, in 255 characters or fewer.</p>
    </div>

    <!-- Hidden Values for Primary Key -->
    <input type="hidden" name="city-id" id="city-id" value="<?= htmlspecialchars($_GET['city_id'] ?? ($_POST['city-id'] ?? '')) ?>">

    <!-- Submit -->
    <input type="submit" value="Save" name="submit" id="submit" class="btn btn-dark my-4">

</form>