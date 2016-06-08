<?php
DEFINE ('DB_USER','coderick14');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_PSWD','9047142795');
DEFINE ('DB_NAME','Spider');

$dbcon = mysqli_connect(DB_HOST,DB_USER,DB_PSWD,DB_NAME);
if(!$dbcon)
{
  die('Error connecting to database');
}
?>
