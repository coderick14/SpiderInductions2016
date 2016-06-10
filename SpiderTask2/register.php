<?php
  if(isset($_POST['submit']))
  {
     include('connect.php');    //includes the script which connects to mysql database

     $nameErr=$rollErr=$mailErr=$addrErr="";
     $name=$roll=$dept=$email=$addr=$about="";
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


     if(!preg_match("/^\d{9}$/",$_POST['roll'])) {
       $rollErr = 'Roll number must be of exactly nine digits';
       $flag=0;
     }
       else {
         $roll=$_POST['roll'];
       }



     if(empty($_POST['addr'])) {
       $addrErr = 'Address field cannot be blank';
       $flag=0;
     }
     else
       $addr=$_POST['addr'];

     $dept=$_POST['dept'];
     $about=$_POST['abt'];

     //echo "hi";

     if ($flag==1) {
       $pscode=substr(md5(rand()),0,9);
       $sqlinsert=$dbcon->prepare("INSERT INTO students VALUES(?,?,?,?,?,?,?)");
       if($sqlinsert) {
         $sqlinsert->bind_param("sisssss",$name,$roll,$dept,$email,$addr,$about,$pscode);
       }
       else {
         die("Error preparing statements");
       }
       $result = $sqlinsert->execute();
       if($result) {
         echo 'Registration successful. <br>';
         echo 'Your passcode is ',$pscode,'.<br> Keep this for future reference and editing.<br>';
      }
      else {
         echo 'Error Type : ',mysqli_error($dbcon),'<br>';
         die('Error inserting into database');
      }
    }
    mysqli_close($dbcon);
  }
?>


<html>
  <head>
    <meta charset="utf-8">
    <title>Add Record</title>
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
      <h1>Student Registration Details</h1>
    </center>
    <form name="student" method="post" action="register.php">
      <h3>Name</h3>
      <input type="text" name="nm" size="40" value="<?php echo $name; ?>" placeholder="Enter your name" required>
      <span class="error"><?php echo $nameErr;?></span><br/>
      <h3>Roll number</h3>
      <input type="number" name="roll" style="width:25em" value="<?php echo $roll; ?>" placeholder="Enter your roll number" required>
      <span class="error"><?php echo $rollErr;?></span><br/>
      <h3>Department</h3>
      <input list="dept" name="dept" size="40" value="<?php echo $dept; ?>" placeholder="Enter your department" required>
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
      <input type="email" name="mail" size="40" value="<?php echo $email; ?>" placeholder="Enter your email" required>
      <span class="error"><?php echo $mailErr;?></span><br/>
      <h3>Address</h3>
      <textarea cols="40" rows="3" name="addr"><?php echo $addr; ?></textarea>
      <span class="error"><?php echo $addrErr;?></span><br/>
      <h3>About me</h3>
      <textarea cols="40" rows="6" name="abt"><?php echo $about; ?></textarea>
      <br/><br/>
      <input type="submit" name="submit" value="Submit">
      <input type="reset" value="Reset">
    </form>
  </body>
</html>
