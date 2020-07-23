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
  <link rel="stylesheet" href="styles/style.css" />
  <title>Todo List PHP & MySQL </title>
</head>
<body>
<div class="container">
<h1> To do list </h1>
<form action="index.php" method="post">
  <label for "new_todo"> Add todo </label>
  <input type="text" name="addtodo">
  <input type="submit">
</form>  

<?php 

  $todo = $_POST['addtodo'];
  $sql = "INSERT INTO todos (`content`) VALUE ('$todo')";
  mysqli_query($conn, $sql);

?>

<?php 
  $sql = "SELECT * FROM todos; ";
  $results = mysqli_query($conn, $sql);
  $results_check = mysqli_num_rows($results);
  if ($results_check > 0) {
    while ($row = mysqli_fetch_assoc($results)) {
      echo 
        "<h2 class='list-item'>" . $row['content'] . "</h2>";
    }
  }
?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>