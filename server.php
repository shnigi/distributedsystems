<?php
if( isset($_POST["value1"]) && isset($_POST["operator"]) && isset($_POST["value2"]) ) {
  $value1 = $_POST["value1"];
  $value2 = $_POST["value2"];
  $operator = $_POST["operator"];

  switch($operator)
   {
     case "plus":
       echo json_encode($value1 + $value2);
       break;
     case "minus":
       echo json_encode($value1 - $value2);
       break;
     case "multiplication":
       echo json_encode($value1 * $value2);
       break;
     case "divide":
       echo json_encode($value1 / $value2);
       break;
   }

}
?>
