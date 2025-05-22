<?php

$title = "Banana Oatmeal Muffins";
include 'includes/header.php';
include 'includes/conversions.php';

?>

<!-- Form & Input -->
 <section class="mb-5">
    <div class="card shadow-sm">
        <h2 class="card-header text-bg-dark fw-light">Recipe Settings</h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="p-5">
            <!-- Yield (Amount of Muffins) -->
             <fieldset class="mb-3">
                <legend class="fs-5">Recipe Yield</legend>

                <input type="radio" name="yield" id="yield-half" value="half" class="btn-check">
                <label for="yield-half" class="btn btn-sm btn-outline-primary">Half</label>

                <input type="radio" name="yield" id="yield-original" value="original" class="btn-check">
                <label for="yield-original" class="btn btn-sm btn-outline-primary">Original</label>

                <input type="radio" name="yield" id="yield-double" value="double" class="btn-check">
                <label for="yield-double" class="btn btn-sm btn-outline-primary">Double</label>
             </fieldset>

            <!-- Temperature -->
             <fieldset class="mb-3">
                <legend class="fs-5">Temperature Units</legend>

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
    <!-- 1 cup white sugar

    0.5 cup unsalted butter, softened

    2 large eggs

    1 teaspoon vanilla extract

    3 ripe bananas, mashed

    1 teaspoon cinnamon

    2 cups all-purpose flour

    1 teaspoon baking powder

    1 teaspoon baking soda

    1 pinch salt

    0.5 cup old-fashioned oats

    0.5 cup chopped walnuts -->
    </ul>

</section>

<!-- Directions -->
<section class="mb-5">
    <h2 class="mb-3">Directions</h2>

    <ol class="list-group list-group-numbered">
        <li class="list-group-item">Preheat the oven to 165 ºC. Line 12 muffin cups with papers liners.</li>
        
        <li class="list-group-item">Beat sugar and butter with an electric mixer in a large bowl until smooth and creamy. Beat first egg into butter mixture until completely blended; beat in vanilla extract with remaining egg.</li>

        <li class="list-group-item">Mix bananas, milk, and cinnamon together in a separate bowl; stir into creamed butter mixture. Whisk flour, baking powder, baking soda, and salt together in a separate bowl; slowly stir into banana-butter mixture until batter is just mixed. Fold oats and walnuts into batter.</li>

        <li class="list-group-item">Scoop batter into the muffin cups using a large ice-cream scoop.</li>

        <li class="list-group-item">Bake in the preheated oven until a toothpick inserted in the centers of the muffins comes out clean, 25 to 35 minutes.</li>
    </ol>

    <p class="my-3"><strong>Recipe Yield</strong>: </p>
</section>

<?php

include 'includes/footer.php';

?>