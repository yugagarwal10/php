<?php
$servername="localhost";
$dbname="trelo";

$conn=new mysqli($servername,'root',"",$dbname);
if(!$conn){
    echo("error occured:" .$conn->connect_error);
}
if(isset($_POST['email'])){
    $email=$_POST['email'];

    $sql=$conn->prepare("INSERT INTO `trelo` (`email`) VALUES (?)");
    $sql->bind_param("s",$email);

    
    if ($sql->execute()) {
        header("Location:yug1.php");
        exit();
    } else {
        echo "Error: " . $sql->error;
    }
    $sql->close();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trelo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <div class="d-flex justify-content-center mt-10 text-center py-2">
    <div class="border border-2 px-5 shadow  rounded">
  <form action="trelo.php" method="post">
  <img src="https://i.pcmag.com/imagery/reviews/04C2m2ye5UfXyb5x5WWIsZ4-19.fit_lim.size_1050x591.v1625759628.png" style="height:90px; width:150px;">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="my-2">Sign Up To Continue</label>
    <input type="email" name="email" class="form-control w-100" aria-describedby="emailHelp" placeholder="Enter Your email">
    <small class="form-text text-muted" style="font-size:12px;">By signing up, I accept the Atlassian <a href="https://www.atlassian.com/legal/atlassian-customer-agreement#intro">Cloud Terms of Service</a><br> and acknowledge the <a href="https://www.atlassian.com/legal/privacy-policy#what-this-policy-covers">Privacy Policy</a>.</small>
    </div>
    <button class="btn btn-outline-success" type="submit" >Sign-Up</button>
    </form>
        <p class="text-body-secondary py-1">Or Continue With:</P>
        <div class="d-flex-inline border border-2 bg-white my- w-100 py-1">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvizumLszgQpxraqoEOYygs5H9hMS5K9Kc3w&s" style="height:25px;height:20px;">
        <button type="submit" class="border border-0 bg-white">Google</button>
    </div>
        <div class="d-flex-inline border border-2 bg-white my-2 w-100 py-1 ">
        <img src="https://static.vecteezy.com/system/resources/previews/027/127/473/original/microsoft-logo-microsoft-icon-transparent-free-png.png" style="height:30px;height:30px;">
        <button type="submit" class=" border border-0 bg-white">Microsoft</button>
    </div>
    <div class="d-flex-inline border border-2 bg-white my-2 w-100  ">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTA5r0_FrSjm2OgttQLwh_CnVCnzbJ7dLv6oA&s" style="height:40px;height:40px;">
        <button type="submit" class="  border border-0 bg-white">Apple</button>
    </div>
    <div class="d-flex-inline border border-2 bg-white my-2 w-100  py-1">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9IyV_DW-z2jGVxjscYWM0vM3X68UgOOu4yA&s" style="height:30px;height:30px;">
        <button type="submit" class="border border-0 bg-white">Slack</button>
    </div>
        <p class="text-body-secondary py-3">Already have an Atlassian account? Log in</p><hr>
        <img src="https://1000logos.net/wp-content/uploads/2020/08/Atlassian-Logo.png" style="height:60px; width:150px;">
        <p style="font-size:12px";>One account for Trello, Jira, Confluence and more.</p>
        <p style="font-size:12px";>This site is protected by reCAPTCHA and the Google Privacy <br>Policy and Terms of Service apply.</p>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
</script>  
</body>
</html>