<!DOCTYPE html>
<html>
    <head>
        <title>Team 10 - Project 3 - Login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="login.css">
        <script src="login.js"></script>
    </head>
    <body>
    <!-- Navigation on Sign Up and Login-->
    <div id="navigation">
        <button id="signUp" onclick="switchToSignUp()">Sign Up</button>
        <button id="logIn" onclick="switchToLogIn()">Log In</button><br>
    </div>

    <div id="container">
        <!-- Sign Up and Login Form-->
        <div id="signupForm" style="display: none;">
            <h1>Sign Up to your account</h1>
            <fieldset>
                <legend>Sign Up</legend>
                <form method="post" action="./signup.php">
                    <label for="fName">First Name: </label><input type="text" id="fName" name="fName" size="15" required><br>
                    <label for="lName">Last Name: </label><input type="text" id="lName" name="lName" size="15" required><br>
                    <label for="email">Email Address: </label><input type="text" id="email" name="email" size="30" required><br>
                    <label for="Password">Set Password: </label><input type="text" id="Password" name="Password" size="30" required><br>
                    <label for="Confirm">Confirm Password: </label><input type="text" id="Confirm" name="Confirm" size="30" required><br>
                    <input type="submit" name="signUp" value="Register" length="15"><br>
                </form>
            </fieldset>
        </div>
        <div id="loginForm">
            <h1>Login to your Account</h1>
            <fieldset>
                <legend>Log In</legend>
            <form method="post">
                <label for="email">Email: </label><input type="text" id="email" name="Email" size="30" required><br>
                <label for="password">Password: </label><input type="text" id="password" name="password" size="30" required><br>
                <input type="submit" value="Sign In" length="15"><br>
            </form>
            </fieldset>
        </div>
    </div>
    </body>
</html>
