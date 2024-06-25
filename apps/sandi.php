<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['alamat'];
    $password = $_POST['password'];

    // Validasi email dan password (contoh sederhana, ganti dengan validasi dari database Anda)
    if ($email == "admin@gmail.com" && $password == "adminpassword") {
        // Redirect ke halaman admin
        header("location: apps/");
        exit;
    } else {
        // Asumsi validasi user (misalnya cek ke database)
        // Misalnya validasi berhasil dan user terdaftar:
        $_SESSION['alamat'] = $email;

        // Redirect ke halaman user
        header("location: apps/user_index.php");
        exit;
    }
}
?>

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

                <button type="button" data-mdb-button-init class="operator btn btn-info" value="+">A</button>
                <button type="button" data-mdb-button-init class="operator btn btn-info" value="-">B</button>
                <button type="button" data-mdb-button-init class="operator btn btn-info" value="*">C</button>
                <button type="button" data-mdb-button-init class="operator btn btn-info" value="/">D</button>

                <button type="button" data-mdb-button-init value="7" data-mdb-ripple-init class="btn btn-light waves-effect">7</button>
                <button type="button" data-mdb-button-init value="8" data-mdb-ripple-init class="btn btn-light waves-effect">8</button>
                <button type="button" data-mdb-button-init value="9" data-mdb-ripple-init class="btn btn-light waves-effect">9</button>


                <button type="button" data-mdb-button-init value="4" data-mdb-ripple-init class="btn btn-light waves-effect">4</button>
                <button type="button" data-mdb-button-init value="5" data-mdb-ripple-init class="btn btn-light waves-effect">5</button>
                <button type="button" data-mdb-button-init value="6" data-mdb-ripple-init class="btn btn-light waves-effect">6</button>


                <button type="button" data-mdb-button-init value="1" data-mdb-ripple-init class="btn btn-light waves-effect">1</button>
                <button type="button" data-mdb-button-init value="2" data-mdb-ripple-init class="btn btn-light waves-effect">2</button>
                <button type="button" data-mdb-button-init value="3" data-mdb-ripple-init class="btn btn-light waves-effect">3</button>


                <button type="button" data-mdb-button-init value="0" data-mdb-ripple-init class="btn btn-light waves-effect">0</button>
                <button type="button" data-mdb-button-init class="decimal function btn btn-secondary" value=".">.</button>
                <button type="button" data-mdb-button-init class="all-clear function btn btn-danger btn-sm" value="all-clear">AC</button>

                <button type="button" data-mdb-button-init class="equal-sign operator btn btn-default" value="=">Enter</button>

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
            const {
                displayValue,
                waitingForSecondOperand
            } = calculator;

            if (waitingForSecondOperand === true) {
                calculator.displayValue = digit;
                calculator.waitingForSecondOperand = false;
            } else {
                calculator.displayValue = displayValue === '0' ? digit : displayValue + digit;
            }
        }

        function inputDecimal(dot) {
            // If the `displayValue` does not contain a decimal point
            if (!calculator.displayValue.includes(dot)) {
                // Append the decimal point
                calculator.displayValue += dot;
            }
        }

        function handleOperator(nextOperator) {
            const {
                firstOperand,
                displayValue,
                operator
            } = calculator
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

        updateDisplay();

        const keys = document.querySelector('.calculator-keys');
        keys.addEventListener('click', (event) => {
            const {
                target
            } = event;
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

            inputDigit(target.value);
            updateDisplay();
        });
    </script>
</body>

</html>