<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body class="container p-3">
        <header class="text-center my-5">
            <!-- Navigation will go here. -->
        </header>
        <main class="my-5">
            <!-- Introduction -->
            <section class="row justify-content-center">
                <div class="col col-sm-10 col-md-8 col-lg-6 text-center">
                    <h1 class="fw-light"><?php echo $title; ?></h1>
                    <p class="text-muted lead mb-5"><?php echo $introduction; ?></p>
                </div>
            </section>

            <!-- Page Content -->
            <section class="row justify-content-center">
                <div class="col col-sm-10 col-md-8 col-lg-6">