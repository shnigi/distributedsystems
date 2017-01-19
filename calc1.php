<?php
  if (isset($_POST['value1'])){
    $value1 = $_POST['value1'];
  }
  if (isset($_POST['value2'])){
    $value2 = $_POST['value2'];
  }
  if (isset($_POST['operator'])){
    $opreator = $_POST['operator'];
  }

  echo json_encode($value1);
	// if($value1){
  //   echo json_encode($value1);
	// 	}


?>
