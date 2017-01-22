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
// const operations = {
//   '+': (a, b) => a + b,
//   '-': (a, b) => a - b,
//   '/': (a, b) => a / b,
//   '*': (a, b) => a * b
// };

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

const doStuff = (operator, numbers) => {
    const realOperator = getOperator(operator[0]);
  $.post({url: 'calc1.php',
          data: `&value1=${numbers[0]}&operator=${realOperator}&value2=${numbers[1]}`})
    .then(result => {
      console.log("test",numbers[nextNumberIndex]);
      if (typeof numbers[nextNumberIndex] !== 'undefined') {
        // console.log(numbers);
        const nextOperation = operations[nextOperationIndex](result, numbers[nextNumberIndex]);
        // Nextoperation = operations[operators[nextOperation]]
        nextOperationIndex++;
        nextNumberIndex++;
        return doStuff(nextOperation, operators, numbers);
      }

      console.log('result tässä', result);
      return result;
    });
  };


$('#calculator').submit(event => {
  event.preventDefault();
  const value = $('input[name="operation"]').val();
  const operator = value.split(/[0-9]/).filter(val => val);
  const numbers = value.split(/[-+\*\/]/).map(val => parseInt(val));
  // const firstOperation = operations[operators[0]](numbers[0], numbers[1]);
  // console.log("firstOperation", firstOperation);
  doStuff(operator, numbers)
    .finally(result => console.log('result', result));
});
</script>

</body>
</html>
