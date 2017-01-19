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
  }
  h1 {
    text-align: center;
  }
  </style>

<div class="wrapper">
  <div class="center-div">
    <h1>Clientside part 1</h1>
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
        const values = input.split (' ')
        const operation1 = values[0]
        console.log('values', values);
        $.ajax({url: 'calc1.php',
                type: 'POST',
                data: `&value1=${values}`,
                success: function(result){
         $("#results").html(result);
       }}); // End of Ajax call
    });
});
</script>

</body>
</html>
