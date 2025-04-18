<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color: #f5f5f5;
            background: linear-gradient(to right, #e8f5e9, #c8e6c9);
        }

        .container {
            background: #fff;
            width: 450px;
            padding: 1.5rem;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 100, 0, 0.1);
            transition: all 0.3s ease;
        }

        .container:hover {
            box-shadow: 0 15px 35px rgba(0, 100, 0, 0.2);
        }

        form {
            margin: 0 2rem;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            padding: 1.3rem;
            margin-bottom: 0.4rem;
            color: #2e7d32;
        }

        input {
            color: inherit;
            width: 100%;
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #bdbdbd;
            padding-left: 1.5rem;
            font-size: 15px;
            height: 2.5rem;
        }

        .input-group {
            padding: 1% 0;
            position: relative;
            margin: 1.2rem 0;
        }

        .input-group i {
            position: absolute;
            color: #2e7d32;
        }

        input:focus {
            background-color: transparent;
            outline: transparent;
            border-bottom: 2px solid #2e7d32;
        }

        input::placeholder {
            color: transparent;
        }

        label {
            color: #757575;
            position: relative;
            left: 1.2em;
            top: -1.3em;
            cursor: auto;
            transition: 0.3s ease all;
        }

        input:focus~label,
        input:not(:placeholder-shown)~label {
            top: -3em;
            color: #2e7d32;
            font-size: 15px;
        }

        .recover {
            text-align: right;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .recover a {
            text-decoration: none;
            color: #388e3c;
        }

        .recover a:hover {
            color: #1b5e20;
            text-decoration: underline;
        }

        .btn {
            font-size: 1.1rem;
            padding: 10px 0;
            border-radius: 25px;
            outline: none;
            border: none;
            width: 100%;
            background: #2e7d32;
            color: white;
            cursor: pointer;
            transition: 0.5s;
            margin-top: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .btn:hover {
            background: #1b5e20;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
        }

        .or {
            font-size: 1.1rem;
            margin: 1.5rem 0;
            text-align: center;
            color: #757575;
            position: relative;
        }

        .or:before,
        .or:after {
            content: "";
            display: inline-block;
            width: 30%;
            height: 1px;
            background: #bdbdbd;
            position: absolute;
            top: 50%;
        }

        .or:before {
            left: 0;
        }

        .or:after {
            right: 0;
        }

        .icons {
            text-align: center;
            margin: 1.5rem 0;
        }

        .icons i {
            color: #2e7d32;
            padding: 0.8rem;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            border: 1px solid #e0e0e0;
            margin: 0 10px;
            transition: 0.5s;
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .icons i:hover {
            background: #e8f5e9;
            transform: scale(1.1);
            border: 1px solid #2e7d32;
        }

        .links {
            display: flex;
            justify-content: center;
            padding: 0 4rem;
            margin-top: 0.9rem;
            font-weight: bold;
            gap: 0.5rem;
            align-items: center;
        }

        button {
            color: #2e7d32;
            border: none;
            background-color: transparent;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        button:hover {
            text-decoration: underline;
            color: #1b5e20;
            background: #e8f5e9;
        }
    </style>
</head>

<body>

    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">Register</h1>
        <!-- for sign up -->
        <form method="post" action="singup.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
                <label for="fname">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                <label for="lName">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <p class="or">
            or
        </p>

        <div class="links">

        <!-- for sign in -->
            <button id="signInButton">Sign In</button>
        </div>
    </div>

    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="login.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p class="or">
            or
        </p>
        <div class="links">
            <p>Don't have an account?</p>
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>
    <script>
        const signUpButton = document.getElementById('signUpButton');
        const signInButton = document.getElementById('signInButton');
        const signInForm = document.getElementById('signIn');
        const signUpForm = document.getElementById('signup');

        signUpButton.addEventListener('click', function() {
            signInForm.style.display = "none";
            signUpForm.style.display = "block";
        })
        signInButton.addEventListener('click', function() {
            signInForm.style.display = "block";
            signUpForm.style.display = "none";
        })
    </script>
</body>

</html>