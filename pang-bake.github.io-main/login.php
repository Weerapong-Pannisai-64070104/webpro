<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login T-pang-bake</title>
</head>

<body>
    <style>
        * {
            margin: 0;
            padding: 0;

        }

        html {
            display: flex;
            height: 100%;
            width: 100%;
            justify-content: center;
            align-items: center;

        }

        body {
            /* background: linear-gradient(#ffad00,#e6a319,#cca34d); */
            background-size: cover;
            background-image: url(https://raw.githubusercontent.com/Kenmuraki5/pang-bake.github.io/main/images/image2.jpeg);
        }

        .container {
            background: #fff;
            border-radius: 5px;
            padding: 50px 50px;
        }

        input {
            width: 100%;
        }

        input::placeholder {
            font-weight: bold;
            text-align: center;

        }

        .inputBox {
            position: relative;
            width: 250px;
        }

        .inputBox input,
        textarea {
            width: 100%;
            padding: 5px;
            outline: none;
            font-size: 1em;
        }

        .inputBox span {
            color: #b3b3b3;
            position: absolute;
            left: 0;
            padding: 2px 10px;
            pointer-events: none;
            font-size: 1.2em;
            transition: 0.5s;
            font-weight: bold;
        }

        .inputBox input:valid~span,
        .inputBox input:focus~span {
            color: black;
            transform: translateX(10px) translateY(-15px);
            font-size: 1em;
            padding: 0 5px;
            background: #fff;
        }
        @media screen and (max-height:670px){
            body{
                margin-top: 120px;
                margin-bottom: 60px;
            }
        }
    </style>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark "
            style="position: fixed; z-index: 1000; top:0; left:0; width: 100%; background-color: black;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div>
                    <a class="navbar-brand" style="color:white;" href="index.html"><b>T-pang-bake</b></a>
                </div>
                <div class="collapse navbar-collapse mr-5" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link navbakery" style="color:white;" aria-current="page" href="#">Bakery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navcake" style="color:white;" href="secake.html">Cake</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navcookie" style="color:white;" href="cookies.html">Cookies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navdrink" style="color:white;" href="drink.html">Drinks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navsnack" style="color:white;" href="snack.html">Snack</a>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </nav>
        <div class="container">
            <form method="POST">
                <h2 class="mb-4" style="font-weight: bold; text-align: center;">Login</h2>
                <div class="inputBox">
                    <input type="text" name="Username" required>
                    <span>Username</span>
                </div>
                <div class="inputBox mt-3">
                    <input type="password" name="Password" required>
                    <span>Password</span>
                </div>
                <div class="inputBox mt-4">
                    <input type="submit" name="SUBMIT" value="Login" class="btn btn-warning" style="width:100%;"><br>
                </div>
                <p class="link mt-2" style="text-align: center;">Not a member? <a href="register.php">Sign Up</a> here.
                </p>
            </form>
        </div>
        
    <?php
        class MyDB extends SQLite3 {
            function __construct() {
            $this->open('user.db');
            }
        }
        
        $db = new MyDB();

        if(isset($_POST['SUBMIT']))
        {
            $Username = htmlentities($_POST['Username']);
            $Password = htmlentities($_POST['Password']);
            $sql = "SELECT * from COMPANY WHERE USERNAME = '$Username' AND PASSWORD = '$Password'";
            $ret = $db->query($sql);
            
            while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
            echo '<script type="text/javascript">';
            echo    "localStorage.setItem('Username', '".$Username."')";
            echo '</script>';
            echo '<script type="text/javascript">';
            echo    'window.location="index.html"';
            echo '</script>';
            }
            echo '<script type="text/javascript">';
            echo 'alert("wrong Username or Password.")';  
            echo '</script>';
        }   
                    

        $db->close();

    ?>


    </body>

</html>