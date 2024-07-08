<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        html {
            font-size: 62.5%;
            box-sizing: border-box;
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: inherit;
        }

        .calculator {
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 400px;
        }

        .calculator-screen {
            width: 100%;
            height: 80px;
            border: none;
            background-color: #252525;
            color: #fff;
            text-align: right;
            padding-right: 20px;
            padding-left: 10px;
            font-size: 4rem;
        }

        button {
            height: 60px;
            font-size: 2rem !important;
        }

        .equal-sign {
            height: 98%;
            grid-area: 2 / 4 / 6 / 5;
        }

        .calculator-keys {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="calculator card">
            <input type="text" class="calculator-screen z-depth-1" value="" disabled />
            <div class="calculator-keys">
                <button type="button" class="operator btn btn-info" value="+">A</button>
                <button type="button" class="operator btn btn-info" value="-">B</button>
                <button type="button" class="operator btn btn-info" value="*">C</button>
                <button type="button" class="operator btn btn-info" value="/">D</button>
                <button type="button" value="7" class="btn btn-light waves-effect">7</button>
                <button type="button" value="8" class="btn btn-light waves-effect">8</button>
                <button type="button" value="9" class="btn btn-light waves-effect">9</button>
                <button type="button" value="4" class="btn btn-light waves-effect">4</button>
                <button type="button" value="5" class="btn btn-light waves-effect">5</button>
                <button type="button" value="6" class="btn btn-light waves-effect">6</button>
                <button type="button" value="1" class="btn btn-light waves-effect">1</button>
                <button type="button" value="2" class="btn btn-light waves-effect">2</button>
                <button type="button" value="3" class="btn btn-light waves-effect">3</button>
                <button type="button" value="0" class="btn btn-light waves-effect">0</button>
                <button type="button" class="decimal function btn btn-secondary" value=".">.</button>
                <button type="button" class="all-clear function btn btn-danger btn-sm" value="all-clear">AC</button>
                <button type="button" class="equal-sign operator btn btn-default" value="=">Enter</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Calculation Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="resultText"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="redirectToIndex()">Go to User Index</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const calculator = {
            displayValue: '0',
            firstOperand: null,
            waitingForSecondOperand: false,
            operator: null,
        };

        function inputDigit(digit) {
            const { displayValue, waitingForSecondOperand } = calculator;

            if (waitingForSecondOperand === true) {
                calculator.displayValue = digit;
                calculator.waitingForSecondOperand = false;
            } else {
                calculator.displayValue = displayValue === '0' ? digit : displayValue + digit;
            }
        }

        function inputDecimal(dot) {
            if (!calculator.displayValue.includes(dot)) {
                calculator.displayValue += dot;
            }
        }

        function handleOperator(nextOperator) {
            const { firstOperand, displayValue, operator } = calculator;
            const inputValue = parseFloat(displayValue);

            if (operator && calculator.waitingForSecondOperand) {
                calculator.operator = nextOperator;
                return;
            }

            if (firstOperand == null) {
                calculator.firstOperand = inputValue;
            } else if (operator) {
                const currentValue = firstOperand || 0;
                const result = performCalculation[operator](currentValue, inputValue);

                calculator.displayValue = String(result);
                calculator.firstOperand = result;
            }

            calculator.waitingForSecondOperand = true;
            calculator.operator = nextOperator;
        }

        const performCalculation = {
            '/': (firstOperand, secondOperand) => firstOperand / secondOperand,
            '*': (firstOperand, secondOperand) => firstOperand * secondOperand,
            '+': (firstOperand, secondOperand) => firstOperand + secondOperand,
            '-': (firstOperand, secondOperand) => firstOperand - secondOperand,
            '=': (firstOperand, secondOperand) => secondOperand
        };

        function resetCalculator() {
            calculator.displayValue = '0';
            calculator.firstOperand = null;
            calculator.waitingForSecondOperand = false;
            calculator.operator = null;
        }

        function updateDisplay() {
            const display = document.querySelector('.calculator-screen');
            display.value = calculator.displayValue;
        }

        function showResultModal(result) {
            const resultTextElement = document.getElementById('resultText');
            resultTextElement.textContent = `Result: ${result}`;
            $('#resultModal').modal('show');
        }

        function redirectToIndex() {
            window.location.href = "apps/user_index.php";
        }

        const keys = document.querySelector('.calculator-keys');
        keys.addEventListener('click', (event) => {
            const { target } = event;
            if (!target.matches('button')) {
                return;
            }

            if (target.classList.contains('operator')) {
                handleOperator(target.value);
                updateDisplay();
                return;
            }

            if (target.classList.contains('decimal')) {
                inputDecimal(target.value);
                updateDisplay();
                return;
            }

            if (target.classList.contains('all-clear')) {
                resetCalculator();
                updateDisplay();
                return;
            }

            if (target.classList.contains('equal-sign')) {
                handleOperator(target.value);
                updateDisplay();
                showResultModal(calculator.displayValue);
                return;
            }

            inputDigit(target.value);
            updateDisplay();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
