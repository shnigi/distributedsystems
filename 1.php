<?php
session_start();
?>
<html>
<body>
  <style>
  .wrapper {
    width:100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  h1 {
    text-align: center;
  }
  </style>

<div class="wrapper">
  <div class="center-div">
    <h1>Calculations performed on server</h1>
    <form action="<?php $_PHP_SELF ?>" method="GET">
      Value 1: <input type="text" name="val1">
      <select name="operator">
        <option value="plus">+</option>
        <option value="minus">-</option>
        <option value="multiplication">*</option>
        <option value="divide">/</option>
      </select>
      Value 2: <input type="text" name="val2">
      <input type="submit">
    </form>
    <h2>
    <?php
    $calculations = array();

   if( isset($_GET["val1"]) && isset($_GET["operator"]) && isset($_GET["val2"]) ) {
     $value1 = $_GET["val1"];
     $value2 = $_GET["val2"];
     $operator = $_GET["operator"];

     if(isset($_SESSION['calculations'])) {
       foreach($_SESSION['calculations'] as $value)
       {
       array_push($calculations, $value);
       }
     }

     $resultText = "Result: ". $value1 . getOperator($operator) . $value2 . " = ";
     echo $resultText;

     switch($operator)
      {
        case "plus":
          echo $value1 + $value2;
          break;
        case "minus":
          echo $value1 - $value2;
          break;
        case "multiplication":
          echo $value1 * $value2;
          break;
        case "divide":
          echo $value1 / $value2;
          break;
      }

      array_push($calculations, $value1 . getOperator($operator) . $value2);
      $_SESSION['calculations'] = $calculations;
   }

   function getOperator($operator) {
    if ($operator == 'plus') {return "+";}
    else if ($operator == 'minus') {return "-";}
    else if ($operator == 'multiplication') {return "*";}
    else if ($operator == 'divide') {return "/";}
    else {return "System failure";}
  }
   ?>
    </h2>
  <?php
  if(isset($_SESSION['calculations'])) {

      function getResult ($value){
        if (strpos($value, '+')) {
            $values = (explode("+",$value));
            return $values[0] + $values[1];
        }
        else if (strpos($value, '-')) {
            $values = (explode("-",$value));
            return $values[0] - $values[1];
        }
        else if (strpos($value, '*')) {
            $values = (explode("*",$value));
            return $values[0] * $values[1];
        }
        else if (strpos($value, '/')) {
            $values = (explode("/",$value));
            return $values[0] / $values[1];
        }
        else {
          return "calculation error";
        }
      }

      echo "<p>Previous calculations:</p>";
      foreach($_SESSION['calculations'] as $value)
      {
      echo $value;
      echo " = ";
      echo getResult($value);
      echo "<br>";
      }

    }
?>
  </div>
</div>

</body>
</html>
