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
    <h1>Client draw, server calculate</h1>
    <p>Type your calculation in the format: value1 operation value2.</p>
    <form id="calculator" action="">
      Operation <input type="text" name="operation">
      <input type="submit">
    </form>
    <div id="results"></div>
    <br>
    <div id="canvasArea"></div>
  </div>
</div>

<script>
const getOperator = (operator) => {
  switch(operator) {
    case '+':
        return "plus";
        break;
    case '-':
        return "minus";
        break;
    case '*':
        return "multiplication";
        break;
    case '/':
        return "divide";
        break;
    default:
        console.log("error");
  }
};

let nextOperationIndex = 1;
let nextNumberIndex = 2;

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

const doStuff = (operation, operators, numbers) => {
  const realOperator = getOperator(operation[2]);
  $.post({url: 'server.php',
          data: `&value1=${operation[0]}&operator=${realOperator}&value2=${operation[1]}`})
    .then(result => {
      $("#results").append(`${operation[0]}${operation[2]}${operation[1]}=${result}<br>`);
      if (typeof numbers[nextNumberIndex] !== 'undefined') {
        let nextOperation = [result, numbers[nextNumberIndex], operators[nextOperationIndex]];
        nextOperationIndex++;
        nextNumberIndex++;
        return doStuff(nextOperation, operators, numbers);
      }
      fn = `Math.sin(x)*${result}`;
      newCanvas();
      update(result);
      return result;
    });
  };


$('#calculator').submit(event => {
  event.preventDefault();
  const value = $('input[name="operation"]').val();
  const operators = value.split(/[0-9]/).filter(val => val);
  const numbers = value.split(/[-+\*\/]/).map(val => parseInt(val));
  const firstOperation = [numbers[0], numbers[1], operators[0]];
  doStuff(firstOperation, operators, numbers);
});
</script>

</body>
</html>
