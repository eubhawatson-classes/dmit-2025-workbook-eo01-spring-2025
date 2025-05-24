<?php

$title = "Banana Oatmeal Muffins";
include 'includes/header.php';
include 'includes/conversions.php';

// We're selecting an actual default value here (not an empty string). This means that when the user loads the page, the recipe will use the original yield. 
$yield = isset($_GET['yield']) ? $_GET['yield'] : 'original';

// Based upon what option the user chooses for the yield, we can now set our multiplier for our ingredient quantities. 
switch ($yield) {
    case 'half':
        $multiplier = 0.5;
        break;
    case 'double':
        $multiplier = 2;
        break;
    default:
        $multiplier = 1;
        break;
}

// $multiplier = match ($yield) {
//     'half'   => 0.5,
//     'double' => 2,
//     default  => 1,
// };

// Our oven temperature is 325F by default; this is 165C.
$temperature_units = isset($_GET['temperature']) ? $_GET['temperature'] : 'C';
$oven_temperature = ($temperature_units == 'C') ? '165 &deg;C' : '325 &deg;F';

// This is a null coalescing operator. This is a shorthand for a ternary statement.
// $temperature_units = isset($_GET['temperature']) ?? 'C';

// Here's an example where you could NOT USE a null coalescing operator:
// $dog_breed = isset($GET['yl']) ? 'Yellow Lab' : 'Black Lab';


?>

<!-- Form & Input -->
 <section class="mb-5">
    <div class="card shadow-sm">
        <h2 class="card-header text-bg-dark fw-light">Recipe Settings</h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="p-5">
            <!-- Yield (Amount of Muffins) -->
             <fieldset class="mb-3">
                <legend class="fs-5">Recipe Yield</legend>

                <!-- 
                    STICKY FORM VALUES

                    It is extremely important that we retain our form values for the user. Here, we have radio buttons, which can have the 'checked' attribute. 

                    We can use a little if statement to see whether or not a particular option was previously chosen; if it was, we can echo out 'checked'.
                -->

                <input type="radio" name="yield" id="yield-half" value="half" class="btn-check" <?php if ($yield == 'half') echo 'checked'; ?>>
                <label for="yield-half" class="btn btn-sm btn-outline-primary">Half</label>

                <input type="radio" name="yield" id="yield-original" value="original" class="btn-check" <?php if ($yield == 'original') echo 'checked'; ?>>
                <label for="yield-original" class="btn btn-sm btn-outline-primary">Original</label>

                <input type="radio" name="yield" id="yield-double" value="double" class="btn-check" <?php if ($yield == 'double') echo 'checked'; ?>>
                <label for="yield-double" class="btn btn-sm btn-outline-primary">Double</label>
             </fieldset>

            <!-- Temperature -->
             <fieldset class="mb-3">
                <legend class="fs-5">Temperature Units</legend>

                <input type="radio" id="temperature-c" name="temperature" value="C" class="btn-check" <?php if ($temperature_units  == 'C') echo 'checked'; ?>>
                <label for="temperature-c" class="btn btn-sm btn-outline-primary">Celcius</label>
                
                <input type="radio" id="temperature-f" name="temperature" value="F" class="btn-check" <?php if ($temperature_units  == 'F') echo 'checked'; ?>>
                <label for="temperature-f" class="btn btn-sm btn-outline-primary">Fahrenheit</label>
             </fieldset>

            <hr class="my-4">

            <!-- Submit -->
             <input type="submit" name="submit" id="submit" value="Save Settings" class="btn btn-primary">
        </form>
    </div>
 </section>

<!-- Ingredients -->
<section class="mb-5">
    <h2 class="mb-3">Ingredients</h2>

    <ul class="list-group">
        <?php
        
        // We already have an array that stores all of our ingredients. Let's loop through it an dynamically generate the ingredients and the amounts we need for the user's chosen yield.
        foreach ($ingredients as $ingredient) {
            echo '<li class="list-group-item">';
            
            $calc_quantity = $ingredient['base_quantity'] * $multiplier;

            echo $calc_quantity . " " . $ingredient['unit'] . " " . $ingredient['name'];

            echo '</li>';
        }

        ?>
    </ul>

</section>

<!-- Directions -->
<section class="mb-5">
    <h2 class="mb-3">Directions</h2>

    <ol class="list-group list-group-numbered">
        <li class="list-group-item">Preheat the oven to <strong><?= $oven_temperature; ?></strong>. Line <strong><?= 12 * $multiplier; ?></strong> muffin cups with papers liners.</li>
        
        <li class="list-group-item">Beat sugar and butter with an electric mixer in a large bowl until smooth and creamy. Beat first egg into butter mixture until completely blended; beat in vanilla extract with remaining egg.</li>

        <li class="list-group-item">Mix bananas, milk, and cinnamon together in a separate bowl; stir into creamed butter mixture. Whisk flour, baking powder, baking soda, and salt together in a separate bowl; slowly stir into banana-butter mixture until batter is just mixed. Fold oats and walnuts into batter.</li>

        <li class="list-group-item">Scoop batter into the muffin cups using a large ice-cream scoop.</li>

        <li class="list-group-item">Bake in the preheated oven until a toothpick inserted in the centers of the muffins comes out clean, 25 to 35 minutes.</li>
    </ol>

    <p class="my-3"><strong>Recipe Yield</strong>: <strong><?= 12 * $multiplier; ?></strong> Muffins</p>
</section>

<?php

include 'includes/footer.php';

?>