<?php
//include "assets/config.php";
include "assets/classes/classes.php";

$error = 0;
if(isset($_POST["register"])){
    $create_user_class = new CreateUser();
    $create_user_class->createUser($_POST["email"], $_POST["email"]);
}
if(isset($_POST["login"])){
    $login = $_POST["email"];
    $sql = "SELECT * FROM user WHERE email='$login' OR login='$login'";
    $conn = (new Database())->getConn();
    $result = $conn->query("$sql");
    while($row = $result->fetch_assoc()){
//        echo $row["password"];
//        echo"<br>";
//        echo hash("sha256",$_POST["password"]);
//        echo "<br>";
//        echo $_POST["email"];
        if($row["password"] == hash("sha256",$_POST["password"])){
            session_start();
            $_SESSION["email"] = $_POST["email"];
            echo "<script>location.replace('index.php')</script>";
        } else {
            $error = 1;
        }
    }
}


?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Montserrat:400,800");
        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Open Sans", sans-serif;
            font-weight: 300;
            display: flex;
            justify-content: center;
            height: 100vh;
            align-items: center;
            margin-top: -50px;
            color: #3f3f3f;
        }

        h1 {
            font-weight: 300;
        }

        form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        button {
            border-radius: 6px;
            padding: 12px 24px;
            background: #ffffff14;
            border: 1px solid #fff;
            color: #fff;
            cursor: pointer;
            outline: none;
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 300;
            transition: transform 80ms ease-in;
        }
        button:hover {
            background: #fff;
            color: salmon;
        }
        button:active {
            transform: scale(0.95);
        }

        input {
            background: transparent;
            padding: 13px 16px;
            background-color: #f0f4f3;
            border: none;
            font-size: 15px;
            margin-bottom: 7px;
            width: 100%;
        }
        input::placeholder {
            color: #a0a0a0;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }
        .form-container.sign-in-container {
            left: 0;
            width: 60%;
            z-index: 2;
        }
        .form-container.sign-up-container {
            left: 0;
            width: 60%;
            opacity: 0;
            z-index: 1;
        }
        .form-container button {
            background: salmon;
            border: 1px solid salmon;
            color: #fff;
        }
        .form-container button:hover {
            background: transparent;
            color: salmon;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(66.5%);
        }
        .container.right-panel-active .sign-up-container {
            transform: translateX(66.5%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 60%;
            width: 40%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }
        .overlay-container .overlay {
            background: linear-gradient(-45deg, #c24f42, salmon, #fc9c92);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #ffffff;
            position: relative;
            left: -100%;
            left: -150%;
            height: 100%;
            width: 250%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }
        .overlay-container .overlay .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 40%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }
        .overlay-container .overlay .overlay-panel.overlay-left {
            transform: translateX(-20%);
        }
        .overlay-container .overlay .overlay-panel.overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-150%);
        }
        .container.right-panel-active .overlay-container .overlay {
            transform: translateX(60%);
        }
        .container.right-panel-active .overlay-container .overlay .overlay-left {
            transform: translateX(0);
        }
        .container.right-panel-active .overlay-container .overlay .overlay-right {
            transform: translateX(20%);
        }

        .bg-bubbles li {
            position: absolute;
            list-style: none;
            display: block;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.15);
            bottom: -160px;
            -webkit-animation: square 25s infinite;
            animation: square 25s infinite;
            -webkit-transition-timing-function: linear;
            transition-timing-function: linear;
            z-index: 1;
        }
        .bg-bubbles li:nth-child(1) {
            left: 10%;
        }
        .bg-bubbles li:nth-child(2) {
            left: 20%;
            width: 80px;
            height: 80px;
            -webkit-animation-delay: 2s;
            animation-delay: 2s;
            -webkit-animation-duration: 17s;
            animation-duration: 17s;
        }
        .bg-bubbles li:nth-child(3) {
            left: 25%;
            -webkit-animation-delay: 4s;
            animation-delay: 4s;
        }
        .bg-bubbles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            -webkit-animation-duration: 22s;
            animation-duration: 22s;
            background-color: rgba(255, 255, 255, 0.25);
        }
        .bg-bubbles li:nth-child(5) {
            left: 70%;
        }
        .bg-bubbles li:nth-child(6) {
            left: 80%;
            width: 120px;
            height: 120px;
            -webkit-animation-delay: 3s;
            animation-delay: 3s;
            background-color: rgba(255, 255, 255, 0.2);
        }
        .bg-bubbles li:nth-child(7) {
            left: 32%;
            width: 160px;
            height: 160px;
            -webkit-animation-delay: 7s;
            animation-delay: 7s;
        }
        .bg-bubbles li:nth-child(8) {
            left: 55%;
            width: 20px;
            height: 20px;
            -webkit-animation-delay: 15s;
            animation-delay: 15s;
            -webkit-animation-duration: 40s;
            animation-duration: 40s;
        }
        .bg-bubbles li:nth-child(9) {
            left: 25%;
            width: 10px;
            height: 10px;
            -webkit-animation-delay: 2s;
            animation-delay: 2s;
            -webkit-animation-duration: 40s;
            animation-duration: 40s;
            background-color: rgba(255, 255, 255, 0.3);
        }
        .bg-bubbles li:nth-child(10) {
            left: 90%;
            width: 160px;
            height: 160px;
            -webkit-animation-delay: 11s;
            animation-delay: 11s;
        }

        @keyframes show {
            0%, 39.99% {
                opacity: 0;
                z-index: 1;
            }
            40%, 100% {
                opacity: 1;
                z-index: 5;
            }
        }
        @keyframes square {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
            100% {
                -webkit-transform: translateY(-700px) rotate(600deg);
                transform: translateY(-700px) rotate(600deg);
            }
        }
    </style>
    <title>Document</title>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="#" method="post">
            <h1>Register</h1>
            <input type="email" name="email" placeholder="Email" required/>
            <input type="password" name="password" placeholder="Password" required/>
            <button type="submit" name="register">Register</button>
        </form>

    </div>
    <div class="form-container sign-in-container">
        <form action="#" method="post">
            <h1>Login</h1>
            <?php if($error==1) echo "<h1>Email or password incorrect</h1>"?>
            <input type="email" name="email" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />
            <button type="submit" name="login">Login</button>
        </form>
    </div>
    <div class="overlay-container">

        <div class="overlay">
            <div class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </div>

            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Create an account and adopt a new way to maintain your vehicle</p>
                <button class="ghost" id="signUp">Register</button>
            </div>
        </div>
    </div>
</div>
<!-- partial -->

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

    // Prevent login and register buttons from throwing an error in codepen
    // const buttons = document.querySelectorAll('.form-container button')
    //
    // buttons[0].addEventListener('click' , (e) => {
    //     e.preventDefault()
    // })
    // buttons[1].addEventListener('click' , (e) => {
    //     e.preventDefault()
    // })
</script>
</body>
</html>
