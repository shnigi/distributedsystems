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
   if( isset($_GET["val1"]) && isset($_GET["operator"]) && isset($_GET["val2"]) ) {
     $value1 = $_GET["val1"];
     $value2 = $_GET["val2"];
     $operator = $_GET["operator"];

     echo "Result:". $value1 . getOperator($operator) . $value2 . " = ";


      if($operator == 'plus'){
        echo $value1 + $value2;
      } else if ($operator == 'minus') {
        echo $value1 - $value2;
      } else if ($operator == 'multiplication') {
        echo $value1 * $value2;
      } else if ($operator == 'divide') {
        echo $value1 / $value2;
      } else {
        echo "Input values incorrect. Sorry.";
      }
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
  </div>
</div>

</body>
</html>
