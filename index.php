<?php

  session_start();

  include_once 'includes/dbh.inc.php';
  
  $url = $_SERVER['REQUEST_URI'];

  if (strpos($url, '?')) {
    $user_id = (int)explode('?', $url)[1];
    echo $user_id;
  }
  
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
    <title> Task Manager </title>
  </head>
  <body>
  <?php include ('./components/navbar.php') ?>
    <div class="row">
      <div class="col-lg-4">
        <div class="task-container">
          <div class="header-container">
            <h1> Tasks </h1>
          </div>

          <?php

            if(strpos($url, '=') && strstr($url, 'completed_task')) {

              $task_id = (int)explode('=', $url)[1];

              $sql = "UPDATE `todos` SET `task_completed` = '1' WHERE `todos`.`item_id` = $task_id";
              mysqli_query($conn, $sql);

            }
          
            if(!isset($_SESSION['login'])){ //if login in session is not set
              header("Location: " . "login.php");
            }
            $url =$_SERVER['REQUEST_URI'];
            if ((int)strpos($url, '?')) {
              $x = explode('?', $url);
              
              if (empty($_POST['addtodo']) === false) {
                $todo = $_POST['addtodo'];
              } 

              if ($x[1] == 'add_todo') {
                $sql = "INSERT INTO todos (`content`) VALUE ('$todo')";
                mysqli_query($conn, $sql);
                header('Location: '.'index.php');
              } else if ((int)strpos($url, '?')) {
                $x = explode('?', $url);
                $sql = "DELETE FROM todos WHERE `item_id` = $x[1]";
                mysqli_query($conn, $sql);
                header('Location: '.'index.php');
              }
            }
              
            unset($_POST['addtodo']);
            unset($todo);

            echo "<div class='todos-container'>";

            $sql = "SELECT * FROM todos WHERE `task_completed` = 0";
            $results = mysqli_query($conn, $sql);
            $results_check = mysqli_num_rows($results);
            if ($results_check > 0) {
              while ($row = mysqli_fetch_assoc($results)) {
                  $time = substr($row['creation_date'], 11, 5);
                  echo "<div class='list-item d-flex justify-content-between'>" . "<div class='title-time my-auto'>" . "<span class='item-title'>" . $row['content'] . "</span>" . "<span class='time'>" . "Created at: " . $time . "</span>" . "</div>" . "<div class='controls'>" . "<a href='./index.php?completed_task?id={$row['item_id']}'> <i class='fas fa-check'></i> </a>" . "<a href='./index.php?{$row['item_id']}'> <i class='fas fa-trash-alt'> </i> </a>" . "</div>" . "</div>";
                
              }
            } else {
              echo "<div class='no-tasks'>" . "<h4> There are no active tasks at the moment... </h4>" . "</div>";
            }

            echo "</div>";
            
          ?>

          <div class="form-container">
            <form class="d-flex justify-content-between" action="index.php?add_todo" method="post">
              <input id="addtodo" type="text" name="addtodo" placeholder="Add Task">
              <button class="submit-button" type="submit" name="submit"> <i class="fas fa-plus"></i> </button>
            </form>  
          </div>
        </div>
      </div>
        <div class="col-lg-8">
          <div class="activity-container">
            <div id="header-wrapper">
              <h1> Activity </h1>
            </div>
            <div class="row">
              <div class="col-lg-6">
                
                <div class="completed-tasks-container">
                  <div class="completed-tasks-header-wrapper">
                    <h1> Completed Tasks </h1>
                  </div> 

                  <?php

                    $phrase = "";
                  
                    $sql = "SELECT * FROM todos WHERE `task_completed` !=0";
                    $results = mysqli_query($conn, $sql);
                    $completed_tasks = mysqli_num_rows($results);
                    while ($row = mysqli_fetch_assoc($results)) {
                      $time = substr($row['creation_date'], 11, 5);
                      echo "<div class='list-item d-flex justify-content-between'>" . "<div class='title-time my-auto'>" . "<span class='item-title'>" . $row['content'] . "</span>" . "<span class='time'>" . "Created at: " . $time . "</span>" . "</div>" . "<div class='controls'>" . "<a href='./index.php?{$row['item_id']}'> <i class='fas fa-trash-alt'> </i> </a>" . "</div>" . "</div>";
                    }

                    if ($completed_tasks == 0) {
                      $phrase = "<h3 class='footer-quote'> There are no completed tasks yet... </h3>";
                    } else if ($completed_tasks < 3) {
                      $phrase = "<h3 class='footer-quote'> You're just getting started </h3>";
                    } else if ($completed_tasks >= 3) {
                      $phrase = "<h3 class='footer-quote'> You're doing pretty well so far! </h3>";
                    } else if ($completed_tasks >= 7) {
                      $phrase = "<h3 class='footer-quote'> You're doing really well so far! Keep it up! </h3>";
                    } else if ($completed_tasks >= 10) {
                      $phrase = "<h3 class='footer-quote'> You're doing excellent so far. Keep it up! </h3>";
                    } 

                    echo "<div class='completed-tasks-footer'>" . $phrase . "</div>"
                    
                  ?>

                </div>
              </div>
              <div class="col-lg-6"> </div>
            </div>
          </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>