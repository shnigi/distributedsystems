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
    	$multiplier = substr($value1, 0, 12);
    	$sine = substr($value1, 6, 1);

    	$content = "set terminal png\n
    				      set output 'test.png'\n
    				      plot sin(x)*".$multiplier;


    	file_put_contents("test.plot", $content);
      // For Linux host
    	// exec("gnuplot < test.plot");
      // For OSX host
      exec("/usr/local/bin/gnuplot < test.plot");

     }

    ?>
    <img src="test.png">
  </div>
</div>

</body>
</html>
