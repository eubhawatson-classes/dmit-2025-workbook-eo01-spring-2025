<!-- Note: the function to open the connection handle can be called here. -->

<!doctype html>
<html lang="en">

  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title; ?></title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>

  <body class="min-vh-100 d-flex flex-column justify-content-between">
    <header class="text-center my-5">
      <h1 class="display-4"><?= $title; ?></h1>
      <p class="lead"><?= $lead; ?></p>
    </header>
      <main class="container mb-5">