<!-- NOTE: Even though this particular demo has exactly 10 inputs, all of which are required, the solution for other possibilities (an odd number of things, a number of things that we aren't sure of, etc.) is included down below. Students will need code like this in their upcoming Lab. -->

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nums = array();
    for ($i = 1; $i <= $set_length; $i++) {
        $nums[] = $_POST["num{$i}"];
    }

    /* MEAN */

    // sort(): This function sorts an array of numbers in ascending order.
    sort($nums);

    // count(): This function counts the number of elements in an array.
    $count = count($nums);

    // array_sum(): This function calculates the sum of all of the elements in an array.
    $sum = array_sum($nums);
    
    // This is the equation for calculating a numerical mean.
    $mean = $sum / $count;

    // We could combine the last three lines into a single line: $mean = array_sum($nums) / count($nums);
    
    /* MEDIAN 
    
        The median calculation depends on whether the number of elements in the array is odd or even.

        If the array has an odd number of elements, then the median is simply the middle element. To calculate the index of the middle element, we first subtract 1 from the count to get the maximum index, and then divide by 2 and round down using floor(). The floor() function is used to round down to the nearest integer, ensuring that the index is a whole number.

        On the other hand, if the array has an even number of elements, then the median is the average of the two middle elements. To calculate the indices of the two middle elements, we use the same calculation as before, but we store the result in $middle and subtract 1 from it to get the index of the first middle element. We then add 1 to $middle to get the index of the second middle element.
    
    */

    // floor(): This function rounds a number down to the nearest integer.
    $middle = floor(($count - 1) / 2);
    
    // First, we're checking to see if there's an even or odd number of elements in the array.
    if ($count % 2 == 0) {
        $median = ($nums[$middle] + $nums[$middle + 1]) / 2;
    } else {
        $median = $nums[$middle];
    }

    /* MODE 

    */

    // array_count_values($nums): This function takes the array $nums and returns an associative array where the keys are the unique values from $nums, and the values are the count of how many times each value appears in the array.
    $mode = array_count_values($nums);

    // max(array_count_values($nums)): This function finds the maximum count value from the associative array obtained in the previous step. It returns the maximum count value.

    // array_keys(array_count_values($nums), max(array_count_values($nums))): This function takes the associative array and the maximum count value, and returns an array containing the keys (values from $nums) that have the maximum count value.
    $mode = array_keys($mode, max($mode));

    // implode() is a built-in PHP function that concatenates the elements of an array into a single string, using a specified delimiter. 
    $mode = implode(', ', $mode);

    echo '<div class="alert alert-info" role="alert">';
    echo "<p>Your numbers: " . implode(', ', $nums) . "</p>";
    echo "<p>Mean: {$mean}</p>";
    echo "<p>Median: {$median}</p>";
    echo "<p>Mode: {$mode}</p></div>";
}
?>