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
    <h1>Step 2, Variation 2, sine functions with JavaScript locally</h1>
    <form id="calculator" action="">
      a*sin(x) <input type="text" name="val1">
      <input type="submit">
    </form>
    <div id="canvasArea"></div>
  </div>
</div>


<script>
let fn = "Math.sin(x)*x";

const newCanvas = () => {
  const canvas = '<canvas width="200" height="200"></canvas>';
  $("#canvasArea").html(canvas);
};

const update = () => {
  const canvas = document.querySelector('canvas');
  const ctx = canvas.getContext('2d');
  for (var i = 0; i < 400; i++) {
    var x = i / 20;
    var y = -eval(fn)  * 5 + 100;
    ctx.lineTo(i/2, y, 1, 1);
  }
  ctx.stroke();
};

$('#calculator').submit(event => {
  event.preventDefault();
  const value = $('input[name="val1"]').val();
  fn = `Math.sin(x)*${value}`;
  newCanvas();
  update();
});
</script>

</body>
</html>
