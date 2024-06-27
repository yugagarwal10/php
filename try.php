<?php
$dbname = "try";
$servername = "localhost";
$username = "root";
$password = ""; 

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_FILES['file'])) {
    $email = $_POST['email'];
    $file = $_FILES['file'];
    
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO `try` (`username`, `image`) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $targetFile);

        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>
    function show() {
      document.querySelector('#fileInput').click();
    }
    function previewFile() {
      const preview = document.querySelector('#filePreview');
      const file = document.querySelector('#fileInput').files[0];
      const reader = new FileReader();

      reader.addEventListener("load", function () {
        preview.src = reader.result;
      }, false);

      if (file) {
        reader.readAsDataURL(file);
      }
    }
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('#fileInput').addEventListener("change", previewFile);
      });
  </script>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light ps-4">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Features</a>
      <a class="nav-item nav-link" href="#">Pricing</a>
      <a class="nav-item nav-link disabled" href="#">Disabled</a>
    </div>
  </div>
</nav>
<div class="d-flex justify-content-center my-3">
<form action="try.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleFormControlInput1">
  </div>
  <div class="form-group my-3 text-center" style="height:400px; width:400px; border:2px solid black;">
  <label for="fileLabel" onclick="show()" style="height:400px; width:400px; border:2px solid black;">Click to upload file or image
  <input type="file" id="fileInput" name="file" style="display: none;">
  <img id="filePreview" src="" style="height:100%; width:100%; object-fit:cover;">
  </label>
</div>
  <button type="submit" class="btn btn-primary my-2">Submit</button>
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>