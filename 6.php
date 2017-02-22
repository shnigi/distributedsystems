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
    <h1>Caching. Client draw, server calculate.</h1>
    <p>Type your calculation in the format: value1 operation value2.</p>
    <form id="calculator">
      Operation <input type="text" name="operation">
      <input type="submit">
    </form>
    <form id="cacheSize">
      Cache Size <input type="number" name="cacheSize">
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
        return 'plus';
    case '-':
        return 'minus';
    case '*':
        return 'multiplication';
    case '/':
        return 'divide';
    default:
        console.log('error');
        return null;
  }
};

let nextOperationIndex = 1;
let nextNumberIndex = 2;
let calculations = [];

const newCanvas = () => {
  const canvas = '<canvas width="200" height="200"></canvas>';
  $('#canvasArea').html(canvas);
};

const update = (result) => {
  const canvas = document.querySelector('canvas');
  const ctx = canvas.getContext('2d');
  for (let i = 0; i < 400; i++) {
    let x = i / 20;
    let y = Math.sin(x) * result * 5 + 100;
    ctx.lineTo(i/2, y, 1, 1);
  }
  ctx.stroke();
};

const getCache = () => {
  return JSON.parse(window.localStorage.getItem('calculations') || '[]');
}

const getCacheSize = () => {
  const defaultCacheSize = 5;
  return parseInt(JSON.parse(window.localStorage.getItem('cacheSize') || defaultCacheSize));
}

let cacheSize = getCacheSize();

const setCacheSize = (value) => {
  cacheSize = value;
  window.localStorage.setItem('cacheSize', JSON.stringify(value));
}

const setCache = (values) => {
  let oldValues = getCache();

  if (checkCache(values)) {
    console.log('Arvo oli cachessa');
    return;
  }

  if (oldValues.length >= cacheSize) {
    oldValues = oldValues.splice(-(cacheSize - 1));
  }

  oldValues.push(values);

  window.localStorage.setItem('calculations', JSON.stringify(oldValues));
}

const checkCache = (values) => {
  const [first, second, operator] = values;
  let inCache = false;

  getCache().forEach(([oldFirst, oldSecond, oldOperator]) => {
    if (oldFirst === first && oldSecond === second && oldOperator === operator) {
      inCache = true;
    }
  });

  return inCache;
}


const initial = () => {
  const cachedValues = getCache();

  console.log('cache', cachedValues.length);
  if (cachedValues.length) {
    $('#results').empty()

    for (calculation of cachedValues) {
      let result;
      const [first, second, operator] = calculation;

      if (operator === '+') {
        result = first + second;
      } else if (operator === '-') {
        result = first - second;
      } else if (operator === '*') {
        result = first * second;
      } else if (operator === '/') {
        result = first / second;
      }

      $('#results').append(`${first}${operator}${second}=${result}<br>`);
    }
  }
}

const doStuff = (operation, operators, numbers) => {
  if (checkCache(operation)) {
    console.log('Arvo oli cachessa');
    return;
  }

  const realOperator = getOperator(operation[2]);
  $.post({
    url: '2server.php',
    data: `&value1=${operation[0]}&operator=${realOperator}&value2=${operation[1]}`
  })
    .then(result => {
      if (typeof numbers[nextNumberIndex] !== 'undefined') {
        let nextOperation = [result, numbers[nextNumberIndex], operators[nextOperationIndex]];
        nextOperationIndex++;
        nextNumberIndex++;
        return doStuff(nextOperation, operators, numbers);
      }

      setCache(operation);

      initial();

      newCanvas();
      update(result);
    });
  };


initial();

$('#calculator').submit(event => {
  event.preventDefault();
  const value = $('input[name="operation"]').val();
  const operators = value.split(/[0-9]/).filter(val => val);
  const numbers = value.split(/[-+\*\/]/).map(val => parseInt(val));
  const firstOperation = [numbers[0], numbers[1], operators[0]];
  doStuff(firstOperation, operators, numbers);
});

$('#cacheSize').submit(event => {
  event.preventDefault();
  setCacheSize($('input[name="cacheSize"]').val());
});
</script>

</body>
</html>
