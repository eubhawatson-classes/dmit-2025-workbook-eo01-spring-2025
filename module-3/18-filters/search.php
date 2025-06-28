<?php

$title = "Search";
include 'includes/header.php';

// Variable Initialisation
$continents = array(
   1 => "Latin America",
   2 => "North America &amp; Oceania",
   3 => "Western Europe",
   4 => "Middle East",
   5 => "Africa",
   6 => "South Asia",
   7 => "Eastern Europe &amp; Central Asia",
   8 => "East Asia"
);

// Country Name Search
$country_search = isset($_GET['country-search']) ? trim($_GET['country-search']) : "";

// Selected Continents
$selected_continents = isset($_GET['continents']) ? $_GET['continents'] : array();

// Wellbeing Variables
$wellbeing_score = $_GET['wellbeing-score'] ?? "";
$wellbeing_value = $_GET['wellbeing-value'] ?? "";

// Life Expectancy Variables
$min = $_GET['life-expectancy-min'] ?? 50;
$max = $_GET['life-expectancy-max'] ?? 90;

?>

<!-- Introduction Area -->
<h2 class="display-5">Browse Our Data</h2>
<p class="mb-5">Explore our data below by country name, continents, wellbeing score, and average lifespan. To get started, pick the options you'd like to use and click the 'Search' button. This will show you the filtered results based upon what you selected.</p>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="mb-5 border border-success p-3 rounded shadow-sm">

   <h3 class="display-6">Advanced Search</h3>

   <!-- Country Name Search -->
   <fieldset class="my-5">
      <legend class="fs-5">Search By Country</legend>

      <div class="mb-3">
         <label for="country-search">Enter country name:</label>
         <input type="text" id="country-search" name="country-search" value="<?= $country_search; ?>" class="form-control">
      </div>
   </fieldset>

   <!-- Continents -->
   <fieldset class="my-5">
      <legend class="fs-5">Filter By Continent</legend>
      <p>Only show results from the following continent(s):</p>

      <!-- This is our default value. It is empty. If the user chooses this, we will omit continent from our query (as we want to include them all and NOT EXCLUDE anything in this column). -->
      <div class="form-check">
         <input type="checkbox" name="continents[]" id="continent-all" value="" class="form-check-input" <?= in_array("", $selected_continents) ? "checked" : ""; ?>>
         <label for="continent-all" class="form-check-label">All Continents</label>
      </div>

      <!-- Now we can generate the rest of our checkboxes, each of which will have values. -->
      <?php foreach ($continents as $id => $name) : ?>

         <div class="form-check">
            <input type="checkbox" name="continents[]" id="continent-<?= $id; ?>" value="<?= $id; ?>" class="form-check-input" <?= in_array((string) $id, $selected_continents) ? "checked" : ""; ?>>
            <label for="continent-<?= $id; ?>" class="form-check-label"><?= $name; ?></label>
         </div>

      <?php endforeach; ?>
   </fieldset>

   <!-- Wellbeing -->
   <fieldset class="my-5">
      <legend class="fs-5">Search By Wellbeing</legend>

      <!-- This is going to determine our comparison operator. We cannot directly pass '>' or '<' into a query due to htmlspecialchars() and the sanitation these form values go through. Therefore, we're using strings, which we'll convert ourselves later on in the process. -->
      <div class="mb-3">
         <label for="wellbeing-score" class="form-label">Only show countries with a score:</label>
         <select name="wellbeing-score" id="wellbeing-score" class="form-select">
            <option value="greater" <?php if ($wellbeing_score == "greater") echo "selected"; ?>>above</option>
            <option value="less" <?php if ($wellbeing_score == "less") echo "selected"; ?>>below</option>
         </select>
      </div>

      <!-- This will be the number or the threshold for the wellbeing score. -->
      <div class="mb-3">
         <label for="wellbeing-value" class="form-label">the following value:</label>
         <input type="number" name="wellbeing-value" id="wellbeing-value" value="<?= $wellbeing_value; ?>" class="form-control">
      </div>
   </fieldset>

   <!-- Average Life Expectancy -->
   <fieldset class="my-5">
      <legend class="fs-5">Search By Life Expectancy</legend>

      <!-- Minimum Age -->
      <div class="mb-3">
         <label for="life-expectancy-min" class="form-label">Show results with a minimum life expectancy of:</label>
         <input type="number" id="life-expectancy-min" name="life-expectancy-min" value="<?= $min; ?>" min="50" max="90" class="form-control">
      </div>

      <!-- Maximum Age -->
      <div class="mb-3">
         <label for="life-expectancy-max" class="form-label">and a maximum life expectancy of:</label>
         <input type="number" id="life-expectancy-max" name="life-expectancy-max" value="<?= $max; ?>" min="50" max="90" class="form-control">
      </div>
   </fieldset>

   <!-- Submit -->
   <div class="mb-3">
      <input type="submit" id="submit" name="submit" class="btn btn-success" value="Search">
   </div>
</form>

<!-- Results -->

<?php

/*
   If the user chose to include everything, their query would look something like this:

   SELECT * FROM happiness_index WHERE 1 = 1
   AND country LIKE '%$country%'
   AND continent IN ($continents)
   AND wellbeing (> or <) $wellbeing_value
   AND life_expectancy BETWWEN $min AND $max

   `WHERE 1 = 1` is a syntactical trick for building dynamic queries. Because 1=1 always resolves as TRUE, it doesn't really affect the outcome of anything; however, it lets us start any line that comes after it with AND. This way, we don't have to keep track of whether or not we've included our WHERE clause yet and don't have to worry about the 'grammar' of SQL.
*/

if (isset($_GET['submit'])) {
   echo '<section class="row justify-content-center">';
   echo '<h2 class="display-5 my-5">Results</h2>';

   $query = "SELECT * FROM happiness_index WHERE 1 = 1";

   // Because we're building a dynamic query, we may have a different number of placeholders (?s) depending upon what the user chooses to fill out in the search form. Therefore, we're creating this little array to keep track of how many placeholders we need.
   $parameters = [];

   // Similarly, we also need to say what data types all of our parameters are. This string will be appended with the correct data types whenever we add parameters. 
   $types = '';

   // BIG NOTE: We are not doing a lot in the way of form validation. In the real world, we would need to do robust validation and sanitisation here!

   // Country Search
   if (!empty($country_search) || $country_search != "") {
      // We cannot use " AND country LIKE '%?%'" because MariaDB will think we're just looking for question marks in the country name. Instead, we need to use a MySQL aggregate function. This lets MariaDB know that the ? is a placeholder value, not the thing we're looking for.
      $query .= " AND country LIKE CONCAT('%', ?, '%')";

      // Let's append our value to our parameters.
      $parameters[] = $country_search;

      // And let's add the 'string' data type here.
      $types .= 's';
   }


   // Continent Filter

   // If the user chose 'All Continents', which has a value of "", we will skip this entire block and just not add it to our query. 

   if (!empty($selected_continents) && !in_array("", $selected_continents)) {
      // Because this is a field of checkboxes, we're working with an array. We need to check to see how many things are in our $selected_continents array. We will then need to use as many placeholders (?s) as there are things checked off by the user.

      // ex. If the user chooses Africa, Middle East, and Latin America, this will add three ?s to our placeholders. Our final string will be: '?, ?, ?'
      $placeholders = implode(',', array_fill(0, count($selected_continents), '?'));
      
      // In our example, this clause in the query will look like this: AND continent IN (?, ?, ?)
      $query .= " AND continent IN ($placeholders)";

      foreach ($selected_continents as $key => $continent) {
         $parameters[] = &$selected_continents[$key];
         $types .= "i";
      }
   }

   // Wellbeing Filter
   if ($wellbeing_value != "") {
      // This ternary says that if wellbeing score is "greater", we will use the > (greater than) comparison operator; otherwise, we'll use the less than operator (<).
      $operator = $wellbeing_score == "greater" ? ">" : "<";

      $query .= " AND wellbeing $operator ?";
      $parameters[] = $wellbeing_value;

      // This is a double data type, so it gets a 'd'.
      $types .= "d";
   }


   // Life Expectancy Filter

   // If we do NOT have both of our default parameters, we'll add this to the query.
   if ($min != 50 && $max != 90) {
      $query .= " AND life_expectancy BETWEEN ? AND ?";

      // We will always have two values to add with a range query. 
      $parameters[] = $min;
      $parameters[] = $max;

      // Both of our values are doubles.
      $types .= "dd";
   }


   // Debugging: If you'd like to see what the query looks like with different options, you can echo out each piece for testing. 

   echo "<p>$query</p>";
   var_dump($parameters);
   echo "<p>$types</p>";

   // Preparation & Execution

   // PHP needs to prepare the query in order to resolve the condition as TRUE or FALSE; therefore, even though this line is inside of a condition, it is still executed / triggered as it normally would outside of the control structure.
   if ($statement = $connection->prepare($query)) {
      // Technically, the user can submit an empty form. Let's see if they chose anything by looking to see if there are any data types.
      if ($types != "") {
         $bind_names = [];
         $bind_names[] = $types;

         foreach ($parameters as $key => $value) {
            // What is the & here? The & means that we're passing our value by reference. In PHP, passing by reference means you're giving a function direct access to the original variable - not just a copy of its value. We need this because we need to bind the original value to our placeholder (?) when we're using prepared statements.
            $bind_names[] = &$parameters[$key];

            /*
               passing by value - this is like handing someone a photocopy of something. If they scribble all over it, the original doesn't change.

               passing by reference - this is like giving someone the original document.
             */
         }
         call_user_func_array([$statement, 'bind_param'], $bind_names);
      }

      $statement->execute();
      $result = $statement->get_result();
      
      // Displaying Results
      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            echo "<div class=\"col-md-6 col-xl-4 mb-4\">";
            include 'includes/country-card.php';
            echo "</div>";
         }
      } else {
         echo "<div class=\"col-md-6\"> \n
            <h2>No results found.</h2> \n
            <p>No countries match your search criteria.</p> \n
            </div>";
      }


   } else {
      echo "<div class=\"col-md-6\"> \n
            <h2>Oops!</h2> \n
            <p>There was an error retrieving your results.</p> \n
            </div>";
   }

   echo '</section>';
} // end of 'if the user hit submit'

include 'includes/footer.php';

?>