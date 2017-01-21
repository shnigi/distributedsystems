<html>
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
  <style>
  .wrapper {
    width:100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
  }
  </style>

<div class="wrapper">
  <div class="center-div">
    <h1>Clientside part 1</h1>
    <p>Type your calculation in the format: value1 operation value2. Values and operator separated by space. </p>
    <form id="calculator" action="">
      Operation <input type="text" name="operation">
      <input type="submit">
    </form>
    <div id="results"></div>
  </div>
</div>

<script>
$(document).ready(function(){
    $("#calculator").submit(function(event){
        event.preventDefault();
        const input = $('input[name="operation"]').val();
        const values = input.split (' ');
        let operator = "";
        if (values[1] === '+'){
          operator = 'plus';
        } else if (values [1] === '-') {
          operator = 'minus';
        } else if (values[1] === '*') {
          operator = 'multiplication';
        } else if (values[1] === '/'){
          operator = 'divide';
        } else {
          console.log("something went wrong");
        }

        $.ajax({url: 'calc1.php',
                type: 'POST',
                data: `&value1=${values[0]}&operator=${operator}&value2=${values[2]}`,
                success: function(result){
                $("#results").html(`Result: ${input} = ${result}`);
       }}); // End of Ajax call
    });
});
</script>

</body>
</html>
