<!DOCTYPE html>
<html>

<head>
    <title>Full Calculator</title>
    <style>

    </style>
    <style>
        .calculator-body {
            background: linear-gradient(to bottom right, #F0F0F0, #009975);
            max-width: 250px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            border: 2px solid black;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-size: 200% 200%;
            /* Make the gradient bigger to cover the entire container */
            animation: gradientTransition 2s infinite alternate;
            /* Apply animation for the transition */
        }

        @keyframes gradientTransition {
            0% {
                background-position: top left;
                /* Start the gradient from the top left corner */
            }

            100% {
                background-position: bottom right;
                /* End the gradient at the bottom right corner */
            }
        }

        .calculator-buttons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-top: 10px;
            width: 250px;
            flex: content;
            justify-content: center;
        }

        .subs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-top: 10px;
            width: 250px;
            height: 120px;
        }

        .subs button {
            background-color: #fdf7ef;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .subs button:hover {
            background-color: aqua;
            font-size: 16px;
            cursor: pointer;
        }

        .calculator-buttons button {
            padding: 10px;
            font-size: 18px;
            border: none;
            background-color: #ffbf00;
            cursor: pointer;
            border: 1px solid black;
            border-radius: 10px;
        }

        .calculator-body:hover {
            background-position: bottom right;
            /* End the gradient at the bottom right corner */
        }

        .calculator-buttons button:hover {
            background-color: orange;
        }

        #screen {
            width: 90%;
            padding: 10px;
            font-size: 20px;
            margin-right: 10px;
            margin-bottom: 10px;
            text-align: right;
            background-color: #F0FDF0;
        }
    </style>
</head>

<body style="background-color: #F8F6F0;">

    <div class="calculator-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" id="screen" name="screen" value="<?php echo isset($_POST['screen']) ? $_POST['screen'] : ''; ?>" readonly>
            <div class="calculator-buttons">
                <?php for ($i = 1; $i <= 9; $i++) : ?>
                    <button type="button" name="number" value="<?php echo $i; ?>" onclick="addToScreen(<?php echo $i; ?>)"><?php echo $i; ?></button>
                <?php endfor; ?><br>
                <button type="button" name="number" value="0" onclick="addToScreen(0)">0</button>
            </div><br>
            <div class="subs">
                <button type="button" name="operator" value="+" onclick="addToScreen('+')">+</button>
                <button type="button" name="operator" value="-" onclick="addToScreen('-')">-</button>
                <button type="button" name="operator" value="*" onclick="addToScreen('*')">*</button>
                <button type="button" name="operator" value="/" onclick="addToScreen('/')">/</button>
                <button type="button" name="decimal" value="." onclick="addToScreen('.')">.</button>
                <button type="submit" name="calculate" value="=">=</button><br>
                <button type="button" onclick="clearScreen()">C</button>
            </div>
        </form>
    </div>

    <script>
        function addToScreen(value) {
            document.getElementById('screen').value += value;
        }
        // Using only PHP, the $result kept failing, therefore I had to use the JS script to make it work (for now)
        function clearScreen() {
            document.getElementById('screen').value = '';
        }
    </script>

    <?php
    if (isset($_POST['calculate'])) {
        $expression = $_POST['screen'];
        // Using eval() here for simplicity, but it's generally not recommended due to security concerns
        $result = eval('return ' . $expression . ';');
        // Display the result on the screen
        echo '<script>document.getElementById("screen").value = "' . $result . '";</script>';
    }
    ?>

</body>

</html>