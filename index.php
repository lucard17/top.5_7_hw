<?php
include_once("pages/functions.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nikolaev.5_7_hw</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="css\bootstrap.css"> -->
  <link rel="stylesheet" href="css\styles.css">
</head>

<body>


      <?php include_once("pages/menu.php") ?>

  <div class="container py-5">
    <?php
    if (isset($_GET["page"])) {
      $page = $_GET["page"];
    } else {
      $page = 1;
    }
    if ($page == 1) include_once("pages/tours.php");
    // if ($page == 2) include_once("pages/comments.php");
    if ($page == 3) include_once("pages/register.php");
    if ($page == 4) include_once("pages/admin.php");
    if ($page == 5) include_once("pages/login.php");

    ?>
  </div>
  <?php server_info() ?>
</body>

</html>