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

let fn = "";
let nextOperationIndex = 1;
let nextNumberIndex = 2;
let calculations = [];

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

const doStuff = (operation, operators, numbers) => {
  const realOperator = getOperator(operation[2]);
  $.post({url: '2server.php',
          data: `&value1=${operation[0]}&operator=${realOperator}&value2=${operation[1]}`})
    .then(result => {
      $("#results").append(`${operation[0]}${operation[2]}${operation[1]}=${result}<br>`);
      if (typeof numbers[nextNumberIndex] !== 'undefined') {
        let nextOperation = [result, numbers[nextNumberIndex], operators[nextOperationIndex]];

        const cachedValues = JSON.parse(window.localStorage.getItem("calculations"));
        for (calculation of cachedValues) {
          if (calculation.toString() === nextOperation.toString()) {
            $("#results").append(`${numbers[0]}${operators[0]}${numbers[1]}=jee`);
          } else {
            calculations.push(nextOperation);
            nextOperationIndex++;
            nextNumberIndex++;
            return doStuff(nextOperation, operators, numbers);
          }
        }
      }
      fn = `Math.sin(x)*${result}`;
      newCanvas();
      update();
      window.localStorage.setItem("calculations", JSON.stringify(calculations));
      return result;
    });
  };


$('#calculator').submit(event => {
  event.preventDefault();
  const value = $('input[name="operation"]').val();
  const operators = value.split(/[0-9]/).filter(val => val);
  const numbers = value.split(/[-+\*\/]/).map(val => parseInt(val));
  const firstOperation = [numbers[0], numbers[1], operators[0]];
  const cached = JSON.parse(window.localStorage.getItem("calculations"));
  if (cached) {
    for (calculation of cached) {
      if (calculation.toString() === firstOperation.toString()) {
        $("#results").append(`${numbers[0]}${operators[0]}${numbers[1]}=tulos<br>`);
      } else {
        calculations.push(firstOperation);
        doStuff(firstOperation, operators, numbers);
      }
    }
  } else {
    calculations.push(firstOperation);
    doStuff(firstOperation, operators, numbers);
  }

});
</script>

</body>
</html>
