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
    <h1>Step 2, sine functions</h1>
    <form action="<?php $_PHP_SELF ?>" method="GET">
      a*sin(x): <input type="text" name="val1">
      <input type="submit">
    </form>

<?php
 if( isset($_GET["val1"])) {
   $value1 = $_GET["val1"];

   $multiplier = substr($value1, 0, 1);
   $sine = substr($value1, 6, 1);

   $test = exec('gnuplot');
   $test2 = exec('set terminal png');
   $test3 = exec('set output "test.png"');
   $test4 = exec('plot sin(x)*'+$multiplier);

   echo $multiplier;
   echo $sine;

   echo $test;
   echo $test2;
   echo $test3;
   echo $test4;

  // plot sin(x)*2


 }
?>
  </div>
</div>

</body>
</html>
