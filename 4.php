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

const update = (result) => {
  const canvas = document.querySelector('canvas');
  const ctx = canvas.getContext('2d');
  for (let i = 0; i < 400; i++) {
    let x = i / 20;
    let y = Math.sin(x) * result * 5 + 100;
    ctx.lineTo(i/2, y, 1, 1);
  }
  ctx.strokeStyle = 'rgb(26, 63, 212)';
  ctx.lineWidth = 3;
  ctx.stroke();

  ctx.beginPath();
  ctx.lineWidth = 1;
  ctx.strokeStyle = 'rgb(0, 0, 0)';
  ctx.moveTo(100, 0);
  ctx.lineTo(100,200);
  ctx.moveTo(0, 100);
  ctx.lineTo(200,100);
  ctx.font="30px Arial";
  ctx.fillStyle = "red";
  ctx.fillText("X",0, 80);
  ctx.fillText("Y",120, 200);
  ctx.stroke();
};

$('#calculator').submit(event => {
  event.preventDefault();
  const value = $('input[name="val1"]').val();
  newCanvas();
  update(value);
});
</script>

</body>
</html>
