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

        .wrapper {
            width: 360px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2 class="text-center">Login</h2>
        <p class="text-center">Please fill in your credentials to login.</p>
        <form action="apps/" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="mail" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </div>
            <p class="text-center">Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>

    <script>
        function validateForm() {
            var email = document.forms["loginForm"]["mail"].value;
            var password = document.forms["loginForm"]["password"].value;
            if (email === "" || password === "") {
                alert("Email and password must be filled out");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
