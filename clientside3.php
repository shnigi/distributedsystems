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

const doStuff = (operation, operators, numbers) => {
  const realOperator = getOperator(operation[2]);
  $.post({url: 'calc1.php',
          data: `&value1=${operation[0]}&operator=${realOperator}&value2=${operation[1]}`})
    .then(result => {
      $("#results").append(`${operation[0]}${operation[2]}${operation[1]}=${result}<br>`);
      if (typeof numbers[nextNumberIndex] !== 'undefined') {
        let nextOperation = [result, numbers[nextNumberIndex], operators[nextOperationIndex]];
        nextOperationIndex++;
        nextNumberIndex++;
        return doStuff(nextOperation, operators, numbers);
      }
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
