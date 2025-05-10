<?php
// Establish a connection to the database

?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?> | Global Happiness Index</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body class="d-flex flex-column justify-content-between min-vh-100">

        <header class="p-3 mb-5 text-bg-success shadow-sm sticky-top">
            <div class="container">
                <section class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-between">
                    <h1><a href="index.php" class="mb-2 mb-lg-0 text-white text-decoration-none fs-3 fw-light">Happy Planet Index</a></h1>

                    <ul class="nav col-12 col-lg-auto ms-lg-auto mb-2 mb-md-0 justify-content-center">
                        <li><a href="filters.php" class="link-light px-3">Filters</a></li>
                        <li><a href="search.php" class="link-light px-3">Search</a></li>
                    </ul>
                </section>
            </div>
        </header>

        <main class="container">
            <section class="row justify-content-center">
                <div class="col-md-10 col-lg-8">