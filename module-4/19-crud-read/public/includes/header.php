<?php

// Almost every page in this application will have a header, so we will include or require all of our other dependencies here.

include '../private/prepared.php';
include '../private/functions.php';

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?> | Canadian Cities Online Database</title>

        <!-- BS CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- BS Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body class="min-vh-100 d-flex flex-column justify-content-between">
        <header class="text-center p-3">
            <nav class="mb-5">
                <a href="index.php" class="btn btn-dark">Home</a>
                <a href="add.php" class="btn btn-success">Add</a>
                <a href="edit.php" class="btn btn-warning">Edit</a>
                <a href="delete.php" class="btn btn-danger">Delete</a>
            </nav>
        </header>
        <main class="container p-5">
            <!-- Introduction -->
            <section class="row justify-content-center text-center">
                <div class="col col-md-10 col-xl-8">
                    <h1 class="fw-light text-center"><?php echo $title; ?></h1>
                    <p class="text-muted text-center lead mb-5"><?php echo $introduction; ?></p>
                </div>
            </section>
            
            <!-- Page Content -->
            <section class="row justify-content-center">
                <div class="col col-md-10 col-xl-8">