<?php
  session_start();
  if(isset($_GET['seeAll']))
  {
    include('connect.php');

    $seeAllQuery = "SELECT * FROM students";
    $resAll = mysqli_query($dbcon,$seeAllQuery);
    if($resAll) {
      echo "<table>";
      echo '<tr><th>Name</th><th>Roll No</th><th>Department</th><th>Email</th><th>Address</th><th>About Me</th></tr>';

      while($tuple = mysqli_fetch_array($resAll,MYSQLI_ASSOC)) {
        echo '<tr><td>';
        echo $tuple['NAME'];
        echo '</td><td>';
        echo $tuple['ROLL_NO'];
        echo '</td><td>';
        echo $tuple['DEPT'];
        echo '</td><td>';
        echo $tuple['MAIL'];
        echo '</td><td>';
        echo $tuple['ADDRESS'];
        echo '</td><td>';
        echo $tuple['ABOUT'];
        echo '</td></tr>';
      }
    }
    else {
      die("Error extracting from database");
    }
    mysqli_close($dbcon);
  }
  if(isset($_GET['sub']))
  {
    include('connect.php');     //includes the script which connects to the mysql database

    $column=$pattern="";
    $flag=1;
    if(!empty($_GET['column'])) {
      $column = $_GET['column'];
    }
    else {
      echo "Select a value for 'Search By' field. <br>";
      $flag=0;
    }
    if(!empty($_GET['pattern'])) {
      $pattern = $_GET['pattern'];
    }
    else {
      echo "Fill in the 'Search Value' field. <br>";
      $flag = 0;
    }




    if($flag==1) {

      $sqlquery = "SELECT * FROM students WHERE $column LIKE '%".$pattern."%'";
      $result = mysqli_query($dbcon,$sqlquery);

      if($result) {
          $num_rows = mysqli_num_rows($result);
          if($num_rows > 0) {

            $cntres = 'Results found : '.$num_rows.'<br>';
            echo "<table>";
            echo '<tr><th>Name</th><th>Roll No</th><th>Department</th><th>Email</th><th>Address</th><th>About Me</th></tr>';

            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
              echo '<tr><td>';
              echo $row['NAME'];
              echo '</td><td>';
              echo $row['ROLL_NO'];
              echo '</td><td>';
              echo $row['DEPT'];
              echo '</td><td>';
              echo $row['MAIL'];
              echo '</td><td>';
              echo $row['ADDRESS'];
              echo '</td><td>';
              echo $row['ABOUT'];
              echo '</td></tr>';

              $editStud = $row;
            }
          }
          else {
            $cntres = "Sorry!! No results found!<br>";
          }
        }
        else {
          die('Error extracting data');
        }
      }
      mysqli_close($dbcon);
  }
?>


<html>
  <head>
    <meta charset="utf-8">
    <title>View Student Record</title>
    <style>
      body {
        font-family: calibri,sans-serif;
        color: darkslategray;
        font-weight: 200;
      }
      th {
        background-color: darkslategray;
        color:white;
        font-weight: 200;
      }
      th,td {
        text-align: center;
        font-family: calibri,sans-serif;
        padding: 8px;
        border-bottom: 1px solid darkgray;
      }
      tr:nth-child(even) {
        background-color: lightgray;
        color : black;
      }
    </style>
  </head>
  <body>
    <form name="search" method="get" action="display.php">
      <h3>Search By</h3>
      <select name="column">
        <option value="ROLL_NO">Roll Number</option>
        <option value="NAME">Name</option>
      </select>
      <h3>Search value</h3>
      <input type="text" size="40" name="pattern"/>
      <input type="submit" name="sub" value="Submit"/>
      <input type="submit" name="seeAll" value="View All Students"/>
    </form>
    <br/><br/><br/>
    <span style="font-weight:400"><?php echo $cntres; ?></span>
    <br/><br/>
    <?php
      if($num_rows == 1) {
        if($editStud)
          $_SESSION['data'] = $editStud;
        else
          echo 'Cant store session object';
        echo "<button type='button' onclick=\"location.href='editDetails.php'\">Edit</button>";
      }
    ?>
  </body>
</html>
