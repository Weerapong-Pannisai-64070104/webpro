<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        
    }
    html{
        display:flex;
        height:100vh;
        width: 100%;
        justify-content:center;
        align-items:center;
        
    }
    body{
        /* background: linear-gradient(#ffad00,#e6a319,#cca34d); */
        background-size: cover;
   
        background-image: url(https://raw.githubusercontent.com/Kenmuraki5/pang-bake.github.io/main/images/image2.jpeg);
        background-repeat:no-repeat;
    }
    .container {
        background: #fff;
        border-radius: 5px;
        padding: 25px 40px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;   
    }
    
   
    .inputBox{
        position: relative;
        width: 250px;
    }
    .inputBox input, textarea{
        width: 100%;
        padding: 5px;
        outline: none;
        font-size: 1em;
    }
    .inputBox span{
        color: #b3b3b3;
        position: absolute;
        left: 0;
        padding: 2px 10px;
        pointer-events: none;
        transition: all 0.45s;
        font-weight: bold;
    }
    .inputBox input:valid ~ span,
    .inputBox input:focus ~ span
    {
        color: black;
        transform: translateX(10px) translateY(-10px);
        font-size: 1em;
        padding: 0 5px;
        background: #fff;
    }
    .inputBox textarea:valid ~ span,
    .inputBox textarea:focus ~ span
    {
        color: black;
        transform: translateX(10px) translateY(-10px);
        font-size: 1em;
        padding: 0 5px;
        background: #fff;
    }
    @media screen and (max-height:595px){
        html{
            display: block;
            background-color: black;
        }
        .container{
            width: 45%;
        }
    }
</style>
<body>
    <div class="container" style="z-index:1000;">
        <form method="POST">
            <h2 class="title" style="font-weight: bold; text-align: center;">Register</h2>
                <div class="user-detail">
                    <div class="inputBox mt-3">
                        <input type="text" name="Name" required >
                        <span>Name</span>
                    </div>
                    <div class="inputBox mt-3" >
                        <input type="text" name="Surname" required >
                        <span>Surname</span>
                    </div>
                    <div class="inputBox mt-3">
                        <input type="text" name="Username" required >
                        <span>Username</span>
                    </div>
                    <div class="inputBox mt-3">
                        <input type="password" name="Password" required >
                        <span>Password</span>
                    </div>
                    <div class="inputBox mt-3">
                        <input type="password" name="Password_2" required>
                        <span>Confirm your Password</span>
                    </div>
                    <div class="inputBox mt-3">
                        <textarea rows="5" cols="30" name="Address" required ></textarea>
                        <span>Address</span>
                    </div>
                </div>
                <div class="inputBox mt-2">
                    <input type="submit" name="SUBMIT" value="Register" class="btn btn-warning" >
                </div>
            
            <p class="link mt-1" style="text-align: center;">Already a member? <a href="login.php">Sign In</a></p>
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
        $Name = htmlentities($_POST['Name']) ;
        $Surname = htmlentities($_POST['Surname']);
        $Username = htmlentities($_POST['Username']);
        $Password = htmlentities($_POST['Password']);
        $Password_2 = htmlentities($_POST['Password_2']);
        $Address = htmlentities($_POST['Address']);
        $sql = "SELECT * from COMPANY WHERE USERNAME = '$Username'";
        $ret = $db->query($sql);
        $row = $ret->fetchArray(SQLITE3_ASSOC);
        if($row > 0){
            echo '<script type="text/javascript">';
            echo 'alert("This Username already exited.")';  
            echo '</script>';
            $row == 0;
            }
        elseif($Password != $Password_2){
            echo '<script type="text/javascript">';
            echo 'alert("Password dose not match!")';  
            echo '</script>';
        }
            else{
            $sql =<<<EOF
                        INSERT INTO COMPANY(NAME,SURNAME,USERNAME,PASSWORD,ADDRESS)
                        VALUES ('$Name', '$Surname','$Username', '$Password' ,'$Address');
                    EOF;
                    header('location: login.php');
                    $ret = $db->exec($sql);
            }
        }
        
        // Close database
        $db->close();
    ?>
</body>
</html>