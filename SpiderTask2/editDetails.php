<?php
  session_start();
  $editStud = $_SESSION['data'];
  if(isset($_POST['submit']))
  {
    include('connect.php');
    
    $nameErr=$pscodeErr=$mailErr=$addrErr="";
    $name=$pscode=$dept=$email=$addr=$about=$roll="";
    $flag=1;

    if(!preg_match("/^[a-zA-Z ]*$/",$_POST['nm'])) {
       $nameErr = 'Name can contain only letters and whitespaces';
       $flag=0;
    }
    else
       $name=$_POST['nm'];


    if(!filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)) {
      $mailErr = 'Invalid email format';
      $flag=0;
    }
    elseif(!preg_match("/(@nitt.edu)$/",$_POST['mail'])) {
      $mailErr ='Mail id must end with @nitt.edu';
      $flag=0;
    }
    else
      $email=$_POST['mail'];

    if(empty($_POST['addr'])) {
      $addrErr = 'Address field cannot be blank';
      $flag=0;
    }
    else
      $addr=$_POST['addr'];

    if(!preg_match("/^[a-zA-Z0-9]{9}$/",$_POST['pscode']))  {
      $pscodeErr = "Invalid format for passcode";
      $flag = 0;
    }
    else {
      $pscode = $_POST['pscode'];
    }

    $roll=$_POST['roll'];
    $dept=$_POST['dept'];
    $about=$_POST['abt'];


    if($flag == 1) {
      $sqlget = "SELECT * FROM students WHERE ROLL_NO=$roll";
      $checkresult = mysqli_query($dbcon,$sqlget);
      if($checkresult) {
        $updateStud = mysqli_fetch_array($checkresult,MYSQLI_ASSOC);
      }
      else {
        die('Error extracting data');
      }
      $userCode = $updateStud['PSCODE'];

      if(strcmp($userCode,$pscode) == 0) {
        $sqlupdate = "UPDATE students SET NAME='$name',DEPT='$dept',MAIL='$email',ADDRESS='$addr',ABOUT='$about' WHERE ROLL_NO=$roll";
        $result = mysqli_query($dbcon,$sqlupdate);
        if($result) {
          echo 'Database updated successfully!!<br>';
        }
        else {
          die('Error updating data');
        }
      }
      else {
        echo 'Error : Passcode does not match.<br>';
        echo $roll;
      }
    }
    mysqli_close($dbcon);
  }
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Update Record</title>
    <style>
      body {
        font-family: calibri,sans-serif;
        color: darkslategray;
      }
      h1,h3 {
        font-weight: 200;
      }
      .error {
        color: red;
      }
    </style>
  </head>
  <body>
    <center>
      <h1>Edit Student Details</h1>
    </center>
    <form name="student" method="post" action="editDetails.php">
      <h3>Name</h3>
      <input type="text" name="nm" size="40" placeholder="Enter your name" value="<?php echo $editStud['NAME']; ?>" required>
      <span class="error"><?php echo $nameErr;?></span><br/>
      <h3>Roll number</h3>
      <input type="number" name="roll" style="width:25em" placeholder="Enter your roll number" value="<?php echo $editStud['ROLL_NO']; ?>" readonly>
      <h3>Department</h3>
      <input list="dept" name="dept" size="40" placeholder="Enter your department" value="<?php echo $editStud['DEPT']; ?>" required>
        <datalist id="dept">
          <option value="Computer Science and Engineering">
          <option value="Electronics and Communication Engineering">
          <option value="Electrical and Electronics Engineering">
          <option value="Mechanical Engineering">
          <option value="Production Engineering">
          <option value="Chemical Engineering">
          <option value="Civil Engineering">
          <option value="Instrumentation and Control Engineering">
          <option value="Metallurgical and Materials Engineering">
        </datalist>
      <h3>Email</h3>
      <input type="email" name="mail" size="40" placeholder="Enter your email" value="<?php echo $editStud['MAIL']; ?>"required>
      <span class="error"><?php echo $mailErr;?></span><br/>
      <h3>Address</h3>
      <textarea cols="40" rows="3" name="addr"><?php echo $editStud['ADDRESS']; ?></textarea>
      <span class="error"><?php echo $addrErr;?></span><br/>
      <h3>About me</h3>
      <textarea cols="40" rows="6" name="abt"><?php echo $editStud['ABOUT']; ?></textarea>
      <h3>Passcode</h3>
      <input type="text" size="40" name="pscode" placeholder="Enter passcode"/>
      <span class="error"><?php echo $pscodeErr;?></span><br/>
      <br/><br/>
      <input type="submit" name="submit" value="Submit">
      <input type="reset" value="Reset">
    </form>
  </body>
</html>
