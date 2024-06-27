<?php
$servername="localhost";
$dbname="yug";
$conn=new mysqli($servername,'root',"",$dbname);
if(!$conn){
    die("connection failed:".mysqli_connect_error());
}
        $name = $_POST['name'];
        $password = $_POST['password'];
    
    $sql="INSERT INTO `yug` (`username`, `password`) VALUES ('$name', '$password')";

    if (mysqli_query($conn, $sql)) {
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
     mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>yug</title>
    <link rel="stylesheet" href="abc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <form action="file.php" method="post">
        <div class="user">
            <p class="enter">LOGIN</p>
            <div class="username">
                <input placeholder="Enter your name" class="userinput" name="name" id="username">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="password">
                <input type="password" placeholder="Password" class="userpass" name="password" id="password">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="check">
                <a href="forgot.html">Forgot password?</a>
            </div>
            <div class="userlogin">
                <button type="submit">Login</button>
                <div class="register">
                    <p>Don't have an account?</p>
                    <a href="#">Register</a>
                </div>
            </div>
        </div>
        <div class="php">
            
        </div>
    </form>
</body>
</html>

