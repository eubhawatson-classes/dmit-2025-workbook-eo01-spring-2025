<?php

/**
 * This function fetches all of the cities in our database and prints them out in an HTML table. 
 * Note: We will add some parameters later on when we need it for our Edit and Delete pages.
 * @return void (because this function prints a table and handles potential errors on its own)
 */
function generate_table() {
    // Let's start by calling the function to retrieve all cities. 
    $cities = get_all_cities();

    if (count($cities) > 0) {
        echo "<table class=\"table table-bordered table-hover\"> \n
             <thead> \n
             <tr class=\"table-dark\"> \n
             <th scope=\"col\">City Name</th> \n
             <th scope=\"col\">Population</th> \n
             <th scope=\"col\">Trivia</th> \n
             </tr> \n
             </thead> \n
             <tbody> \n";

        // Record Loop

        echo "</tbody>
             </table>
             <aside>
             <h3 class=\"fs-5 fw-normal\">Notes</h3>
             <p class=\"text-muted my-3\">&starf; indicates the capital of a province or territory.</p>
             <p class=\"text-muted my-3\">Hover over <i class=\"bi bi-info-circle\" data-bs-toggle=\"tooltip\" title=\"I'm a tooltip!\"></i> to see additional trivia about the city.</p>
             </aside>";
    } else {
        echo "<h2 class=\"fw-light\">Oh no!</h2>";
        echo "<p>We're sorry, but we weren't able to find anything in our database.</p>";
    }
}

?>