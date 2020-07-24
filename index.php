<?php
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link 
    rel="stylesheet" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
    crossorigin="anonymous"
  />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/style.css" />
  <title>Todo List PHP & MySQL </title>
</head>
<body>
<div class="container">
<h1> To do list </h1>
<form class="d-flex justify-content-between" action="index.php?add_todo" method="post">
  <input id="addtodo" type="text" name="addtodo" placeholder="Add todo">
  <input id="submit" type="submit" value="+" />
</form>  
<?php

  $url =$_SERVER['REQUEST_URI'];
  if (strpos($url, '?')) {
    $x = explode('?', $url);
    $sql = "DELETE FROM todos WHERE `item_id` = $x[1]";
    mysqli_query($conn, $sql);
  }
  if (empty($_POST['addtodo']) === false) {
    $todo = $_POST['addtodo'];
    if (empty($x[1]) === false && $x[1] == 'add_todo') {
      $sql = "INSERT INTO todos (`content`) VALUE ('$todo')";
      mysqli_query($conn, $sql);
    }
  }
  $sql = "SELECT * FROM todos; ";
  $results = mysqli_query($conn, $sql);
  $results_check = mysqli_num_rows($results);
  if ($results_check > 0) {
    while ($row = mysqli_fetch_assoc($results)) {
      echo 
        "<div class='list-item d-flex justify-content-between'>" . "<span class='item-title'>" . $row['content'] . "</span>" . "<a href='./index.php?{$row['item_id']}'> <i class='fas fa-trash-alt'> </i> </a>" . "</div>";
    }
  }
?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>