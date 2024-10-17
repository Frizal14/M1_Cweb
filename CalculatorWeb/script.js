let display = document.getElementById('display');

function append(value) {
  if (display.innerText === '0') {
    display.innerText = value;
  } else {
    display.innerText += value;
  }
}

function clearAll() {
  display.innerText = '0';
}

function calculate() {
  let expression = display.innerText.replace('^', '**'); // Ganti ^ dengan **
  
  try {
    // Evaluasi ekspresi menggunakan eval, namun pastikan tetap aman
    let result = eval(expression);
    display.innerText = result;
  } catch (error) {
    display.innerText = 'Error';
  }
}
