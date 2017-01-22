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
const operations = {
  '+': (a, b) => a + b,
  '-': (a, b) => a - b,
  '/': (a, b) => a / b,
  '*': (a, b) => a * b
};

let nextOperationIndex = 1;
let nextNumberIndex = 2;

const doStuff = (operation, operators, numbers) =>
console.log("operation",operation);
  // $.post('url', {operation})
  //   .then(result => {
  //     if (typeof numbers[nextNumberIndex] !== 'undefined') {
  //       const nextOperation = operations[nextOperationIndex](result, numbers[nextNumberIndex]);
  //       // Nextoperation = operations[operators[nextOperation]]
  //       nextOperationIndex++;
  //       nextNumberIndex++;
  //       return doStuff(nextOperation, operators, numbers);
  //     }
  //
  //     console.log('result tässä', result);
  //     return result;
  //   });


$('#calculator').submit(event => {
  event.preventDefault();
  const value = $('input[name="operation"]').val();
  const operators = value.split(/[0-9]/).filter(val => val);
  const numbers = value.split(/[-+\*\/]/);
  const firstOperation = operations[operators[0]](numbers[0], numbers[1]);
  console.log("firstOperation", firstOperation);
  doStuff(firstOperation, operators, numbers)
    .finally(result => console.log('result', result));
});
</script>

</body>
</html>
