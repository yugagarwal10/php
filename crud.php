<?php
$servername = "localhost";
$dbname = "abc";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_FILES['file'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $file=$_FILES['file'];
        $targetDir = "uploads/";
        $targetFile = $targetDir.basename($_FILES["file"]["name"]);

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            $stmt = $conn->prepare("INSERT INTO `abc` (`email`, `password`, `image`) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $password, $targetFile);

            if ($stmt->execute()) {
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    if (isset($_POST['update_id']) && isset($_POST['update_email']) && isset($_POST['update_password'])) {
        $update_id = $_POST['update_id'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];

        $stmt = $conn->prepare("UPDATE `abc` SET `email` = ?, `password` = ? WHERE `id` = ?");
        $stmt->bind_param("ssi", $update_email, $update_password, $update_id);

        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM `abc` WHERE `id` = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    if (!empty($search)) {
        $stmt = $conn->prepare("SELECT * FROM `abc` WHERE `id` = ?");
        $stmt->bind_param("i", $search);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query("SELECT * FROM `abc`");
    }
} else {
    $result = $conn->query("SELECT * FROM `abc`");
}
$sql = "SELECT * FROM abc";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PHP CRUD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true">About</a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="crud.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<div class="d-flex justify-content-center my-3">
    <form action="crud.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" name=email required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control " id="exampleInputPassword1" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputphoto1" class="form-label">Image</label>
            <input type="file" name="file" class="form-control " id="exampleInputimage1" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Image</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['password']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($row['image']); ?>" width="100" height="100" alt="User Image"></td>
                    <td>
                        <a class="btn btn-primary" href="crud.php?delete_id=<?php echo $row['id']; ?>">Delete</a>
                        <button class="btn btn-primary ms-2 edit-btn" data-id="<?php echo $row['id']; ?>">Edit</button>

                    </td>
                </tr>
                <tr class="update-form" style="display: none;" data-id="<?php echo $row['id']; ?>">
                    <td colspan="4">
                        <form action="crud.php" method="post">
                        <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label ">Update Email</label>
                              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="update_email">
                         </div>
                         <div class="mb-3">
                             <label for="exampleInputPassword1" class="form-label ">UpdatePassword</label>
                            <input type="password" class="form-control " id="exampleInputPassword1" name="update_password">
                        </div>
                <div class="mb-3 form-check">
                       <input type="checkbox" class="form-check-input" id="exampleCheck1">
                       <label class="form-check-label" for="exampleCheck1">Check me out</label>
               </div>
                     <button type="submit" class="btn btn-primary ">Submit</button>
                     <button class="btn btn-primary cancel-edit" data-id="<?php echo $row['id']; ?>">cancel</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".edit-btn");
        const cancelButtons = document.querySelectorAll(".cancel-edit");
        editButtons.forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            const email = document.querySelector(`.update-form[data-id='${id}'] input[name='update_email']`);
            const password = document.querySelector(`.update-form[data-id='${id}'] input[name='update_password']`);
            const emailValue = this.closest("tr").querySelector("td:nth-child(2)").innerText.trim();
            const passwordValue = this.closest("tr").querySelector("td:nth-child(3)").innerText.trim();
            
            email.value = emailValue;
            password.value = passwordValue;
            
            document.querySelector(`.update-form[data-id='${id}']`).style.display = 'table-row';
        });
        });

        cancelButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const id = this.getAttribute("data-id");
                const updateForm = document.querySelector(`.update-form[data-id='${id}']`);
                if (updateForm) {
                    updateForm.style.display = 'none';
                }
            });
        });
    });
</script>
</body>
</html>
<?php
$conn->close();
?>
