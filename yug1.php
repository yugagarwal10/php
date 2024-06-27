
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trelomain";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo'])) {
    $todo = $_POST['todo'];

    $stmt = $conn->prepare("INSERT INTO trelotodo(todo) VALUES (?)");
    $stmt->bind_param("s",$todo);

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['doing'])) {
    $doing = $_POST['doing'];
    $stmt = $conn->prepare("INSERT INTO trelodoing(doing) VALUES (?)");
    $stmt->bind_param("s",$doing);

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['done'])) {
    $done = $_POST['done'];
    $stmt = $conn->prepare("INSERT INTO trelomain(done) VALUES (?)");
    $stmt->bind_param("s",$done);

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new'])) {
    $new = $_POST['new'];
    $stmt = $conn->prepare("INSERT INTO trelonew(new) VALUES (?)");
    $stmt->bind_param("s",$new);

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_todo_id'])) {
    $id = $_POST['update_todo_id'];
    $todo = $_POST['update_todo'];
    $stmt = $conn->prepare("UPDATE trelotodo SET todo = ? WHERE id = ?");
    $stmt->bind_param("si", $todo, $id);
    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_doing_id'])) {
  $id = $_POST['update_doing_id'];
  $doing = $_POST['update_doing'];
  $stmt = $conn->prepare("UPDATE trelodoing SET doing = ? WHERE id = ?");
  $stmt->bind_param("si", $doing, $id);
  if ($stmt->execute()) {
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
  } else {
      echo "Error updating record: " . $stmt->error;
  }
  $stmt->close();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_done_id'])) {
  $id = $_POST['update_done_id'];
  $done = $_POST['update_done'];
  $stmt = $conn->prepare("UPDATE trelomain SET done = ? WHERE id = ?");
  $stmt->bind_param("si", $done, $id);
  if ($stmt->execute()) {
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
  } else {
      echo "Error updating record: " . $stmt->error;
  }
  $stmt->close();
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['delete_todo_id'])) {
      $id = $_GET['delete_todo_id'];
      $stmt = $conn->prepare("DELETE FROM trelotodo WHERE id = ?");
      $stmt->bind_param("i", $id);
      if ($stmt->execute()) {
          header("Location: " . $_SERVER['PHP_SELF']);
          exit();
      } else {
          echo "Error deleting record: " . $stmt->error;
      }
      $stmt->close();
  }
  if (isset($_GET['delete_doing_id'])) {
    $id = $_GET['delete_doing_id'];
    $stmt = $conn->prepare("DELETE FROM trelodoing WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}
if (isset($_GET['delete_done_id'])) {
  $id = $_GET['delete_done_id'];
  $stmt = $conn->prepare("DELETE FROM trelomain WHERE id = ?");
  $stmt->bind_param("i", $id);
  if ($stmt->execute()) {
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
  } else {
      echo "Error deleting record: " . $stmt->error;
  }
  $stmt->close();
}
}
if (isset($_GET['delete_todo'])) {
  $stmt = $conn->prepare("DELETE FROM trelotodo");
  if ($stmt->execute()) {
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
  } else {
      echo "Error deleting records: " . $stmt->error;
  }
  $stmt->close();
}

if (isset($_GET['delete_doing'])) {
  $stmt = $conn->prepare("DELETE FROM trelodoing");
  if ($stmt->execute()) {
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
  } else {
      echo "Error deleting records: " . $stmt->error;
  }
  $stmt->close();
}

if (isset($_GET['delete_done'])) {
  $stmt = $conn->prepare("DELETE FROM trelomain");
  if ($stmt->execute()) {
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
  } else {
      echo "Error deleting records: " . $stmt->error;
  }
  $stmt->close();
}

if (isset($_GET['delete_new'])) {
  $stmt = $conn->prepare("DELETE FROM trelonew");
  if ($stmt->execute()) {
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
  } else {
      echo "Error deleting records: " . $stmt->error;
  }
  $stmt->close();
}
$sql_todo = "SELECT * FROM trelotodo" ;
$result_todo = $conn->query($sql_todo);


$sql_doing = "SELECT * FROM trelodoing";
$result_doing = $conn->query($sql_doing);

$sql_done = "SELECT * FROM trelomain";
$result_done = $conn->query($sql_done);

$sql_new = "SELECT * FROM trelonew";
$result_new = $conn->query($sql_new);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Trello Board</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
      * {
        padding: 0;
        margin: 0;
        font-family: roboto;
      }
    
      .display {
        display: none;
      }
      .inpu-1 {
        display: none;
      }
      .inpu-main {
        display:none;
      }
      .topbar{
        background-color: #5A639C;
        font-size:16px;
        font-weight: bold;
      }
      .second-bar{
        background-color: #7776B3;
        color: white;
        font-size: 14px;
        font-weight: bold;
      }
      .output{
        background-color: #9B86BD;
        display:flex;
        flex-wrap: wrap;
        justify-content: space-between;
      }
      .form-control{
        background: transparent;
      }
      .doingcard{
        border-radius:13px;
      }
      .input-done{
        display: none;
      }
     .card-result{
      width:250px;
      word-break:break-word;
      }
      .input-new{
        display: none;
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script>
  $(document).ready(function() {
    $('#output-main, #output-todo, #output-done, #output-doing').sortable();
    $('#output-main, #output-todo, #output-done, #output-doing').draggable();
  });
  </script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg topbar">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgXHKsrs6__jWtdlQcrZVUjdKeNWvYuh2_mg&s" style="height:55px;width:120px;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item active px-2">
            <a class="nav-link" href="#">Workspace</a>
          </li>
          <li class="nav-item px-2">
            <a class="nav-link" href="#">Recent</a>
          </li>
          <li class="nav-item px-2">
            <a class="nav-link" href="#">Starred</a>
          </li>
          <li class="nav-item dropdown px-2">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Templates
            </a>
            <li class="nav-item px-2">
              <button type="button" class="btn btn-outline-info">Create</button>
            </li>
          </li>
        </ul>
        <nav class="navbar px-2">
          <form class="form-inline d-flex">
            <input class="form-control mr-sm-2 w-100" type="search" placeholder="Search" aria-label="Search">
            <button type="button" class="btn btn-outline-info mx-2">Search</button>
          </form>
        </nav>
      </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light second-bar px-4 d-flex ">
      <a class="navbar-brand" href="#">MY TRELO BOARD</a>
      <i class="fa-regular fa-star px-2"></i>
      <i class="fa-regular fa-user px-2"></i>
      <button class="btn btn-outline-info px-4 mx-4" type="submit">BOARD</button>
      <div class="collapse navbar-collapse d-flex-inline justify-content-end">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <i class="fa-solid fa-rocket px-2 fs-5 pt-2"></i>
          </li>
          <li class="nav-item">
            <i class="fa-solid fa-bolt px-4 fs-5 pt-2"></i>
          </li>
          <li class="nav-item">
            <i class="fa-solid fa-filter ms-4"></i>
            <a class="navbar-brand" href="#">Filter</a>
          </li>
        </ul>
        <button class="btn btn-outline-info px-4" type="submit">Share</button>
      </div>
    </nav>
     <div class="output d-flex" id="output-main">
       <form name="form" action="yug1.php" method="post">
        <div class="card mx-4 my-3 doingcard" style="width: 18rem;">
          <div class="card-body">
            <div class="d-flex">
              <h5 class="card-title">To Do</h5>
              <i class="fa-solid fa-sliders pt-1 fs--5" style="margin-left:200px;"></i>
              <div class="display">
                <ul class="list-group">
                  <li class="list-group-item px-4 add">Add</li>
                  <li class="list-group-item px-4">Copy</li>
                  <li class="list-group-item px-4"><a href="yug1.php?delete_todo" class="text-black">Delete All</a></li>
                  <li class="list-group-item px-4">Watch</li>
                </ul>
              </div>
            </div>
            <p class="fw-normal border border-2 shadow rounded px-2 py-1 example" style="height:35px;">Project Planning</p>
            <p class="fw-normal border border-2 rounded shadow px-2 py-1" style="height:35px;">Kick-Off Meeting</p>
            <div  class="output-main" id="output-todo">
            <?php while ($row = $result_todo->fetch_assoc()): ?>
            <div class="card border  border-2 shadow rounded px-2 pt-1 mt-2">
              <p class="fw-normal card-result"><?php echo htmlspecialchars($row['todo']); ?></p>
              <div class="d-flex mb-1">
              <a  href='yug1.php?delete_todo_id=<?php echo $row['id']; ?>'><i class="fa-solid fa-trash"></i></a>
              <a class=" update-new mx-4" update_todo_id=<?php echo $row['id']; ?>><i class="fa-regular fa-pen-to-square"></i></a>
            </div>
            <form action="yug1.php" method="post">
            <div class="update-form mb-2"  style="display: none;">
            <input type="hidden" name="update_todo_id" value="<?php echo $row['id'];?>">
            <input class="form-control" type="search" placeholder="update" name="update_todo">
            <button class="rounded ms-1 px-2 bg-white border border-2 mt-2" type="submit"><i class="fa-solid fa-check"></i></button>
            <button class="rounded ms-1 px-2 bg-white border border-2 mt-2 cancel-new" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-xmark"></i></button>
        </div>
            </form>
            </div>
          <?php endwhile; ?>
            </div>
            <div class="d-flex">
              <button type="button" class="rounded px-1 bg-white border border-0 add-main pt-1"><i class="fa-solid fa-plus"></i> Add A Card</button> 
            </div>
            <div class="inpu-main mb-2">
                <input type="text" class="form-control" name="todo"  placeholder="Enter Title">
                <button class="rounded ms-1 px-2 bg-white border border-2 submit-main" name="submit" type="submit">Add</button>
              </div>
            </div>
        </div>
      </form> 
      <form action="yug1.php" method="post">
      <div class="doingcard mx-4 my-4">
        <div class="border border-2 card-body px-4 py-1 bg-white">
          <div class="d-flex">
            <h5 class="card-title pt-2">Doing</h5>
            <i class="fa-solid fa-sliders pt-3 fs--5" style="margin-left:200px;"></i>
            <div class="display">
              <ul class="list-group">
                <li class="list-group-item">Add</li>
                <li class="list-group-item">Copy</li>
                <li class="list-group-item"><a href="yug1.php?delete_doing" class="text-black">Delete</a></li>
                <li class="list-group-item">Watch</li>
              </ul>
            </div>
          </div>
          <div class="output-1" id="output-doing">
          <?php while ($row = $result_doing->fetch_assoc()): ?>
          <div class="card card-result border border-2 rounded px-2 py-1 mt-3 shadow">
            <p class="fw-normal"><?php echo htmlspecialchars($row['doing']); ?></p>
            <div class="d-flex">
              <a href='yug1.php?delete_doing_id=<?php echo $row['id']; ?>'><i class="fa-solid fa-trash"></i></a>
            <a class=" update-new mx-4" update_doing_id=<?php echo $row['id']; ?>><i class="fa-regular fa-pen-to-square"></i></a>
            </div>
            <form action="yug1.php" method="post">
            <div class="update-form mb-2"  style="display: none;">
            <input type="hidden" name="update_doing_id" value="<?php echo $row['id'];?>">
            <input class="form-control" type="search" placeholder="update" name="update_doing">
            <button class="rounded ms-1 px-2 bg-white border border-2 mt-2 add-new" type="submit"><i class="fa-solid fa-check"></i></button>
            <button class="rounded ms-1 px-2 bg-white border border-2 mt-2 cancel-new" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-xmark"></i></button>
        </div>
          </form>
          </div>
        <?php endwhile; ?>
          </div>
          <div class="d-flex">
            <button class="rounded px-1 pt-2 mt-2 bg-white border border-0 pb-1 add-1"><i class="fa-solid fa-plus"></i> Add A Card</button> 
          </div>
          <div class="inpu-1 mb-2">
            <input type="text" class="form-control " name="doing" placeholder="Add A Title">
            <button class="rounded ms-1 px-2 bg-white border border-2 submit-1 mt-2" type="submit">Add</button>
          </div>
        </div>
      </div>
    </form> 
      <form name="form2" action="yug1.php" method="post">
      <div class="doingcard mx-4 my-4">
        <div class="border border-2 card-body px-4 py-1 bg-white">
          <div class="d-flex">
            <h5 class="card-title pt-2">Done</h5>
            <i class="fa-solid fa-sliders pt-3 fs--5" style="margin-left:170px;"></i>
            <div class="display">
              <ul class="list-group">
                <li class="list-group-item">Add</li>
                <li class="list-group-item">Copy</li>
                <li class="list-group-item"><a href="yug1.php?delete_done" class="text-black">Delete</a></li>
                <li class="list-group-item">Watch</li>
              </ul>
            </div>
          </div>
          <div class="output-done" id="output-done">
          <?php while ($row = $result_done->fetch_assoc()): ?>
          <div class="card card-result border border-2 shadow rounded px-2 py-1 mt-3">
            <p class="fw-normal"><?php echo htmlspecialchars($row['done']); ?></p>
            <div class="d-flex">
              <a href='yug1.php?delete_done_id=<?php echo $row['id']; ?>'><i class="fa-solid fa-trash"></i></a>
              <a class=" update-new mx-4" update_done_id=<?php echo $row['id']; ?>><i class="fa-regular fa-pen-to-square"></i></a>
            </div>
            <form action="yug1.php" method="post">
            <div class="update-form mb-2"  style="display: none;">
            <input type="hidden" name="update_done_id" value="<?php echo $row['id'];?>">
            <input class="form-control" type="search" placeholder="update" name="update_done">
            <button class="rounded ms-1 px-2 bg-white border border-2 mt-2 add-new" type="submit"><i class="fa-solid fa-check"></i></button>
            <button class="rounded ms-1 px-2 bg-white border border-2 mt-2 cancel-new" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-xmark"></i></button>
          </div>
          </form>
          </div>
        <?php endwhile; ?>
          </div>
          <div class="d-flex">
            <button class="rounded px-1 pt-2 mt-2 bg-white border border-0 pb-1 add-done"><i class="fa-solid fa-plus"></i> Add A Card</button> 
          </div>
          <div class="input-done mb-2">
            <input type="text" class="form-control px-3" name="done" placeholder="Add A Title">
            <button class="rounded ms-1 px-2 bg-white border border-2 submit-done mt-2" type="submit">Add</button>
          </div>
        </div>
      </div>
    </form>
      <div class="doingcard mx-4 my-4">
        <div class="border border-2 card-body px-4 py-1 bg-white">
          <div class="d-flex">
            <button class="rounded px-1 mt-2 bg-white border border-0 pb-1 add-new-card"><i class="fa-solid fa-plus"></i> Add A Card</button>
          </div>
        </div>
      </div>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
         document.addEventListener('DOMContentLoaded', function() {
        const dots = document.querySelectorAll('.fa-sliders');
        dots.forEach(dot => {
          const display = dot.nextElementSibling;
          dot.addEventListener('click', function(event) {
            event.stopPropagation();
            display.style.display = display.style.display === 'block' ? 'none' : 'block';
          });
          document.querySelectorAll('.update-new').forEach(updateBtn => {
  updateBtn.addEventListener('click', function(event) {
    const card = event.target.closest('.card');
    const updateForm = card.querySelector('.update-form'); 
    updateForm.style.display = updateForm.style.display === 'flex'? 'flex' : 'flex';
  });
});
document.querySelectorAll('.cancel-new').forEach(updateBtn => {
  updateBtn.addEventListener('click', function(event) {
    event.preventDefault();
    const card = event.target.closest('.card');
    const updateForm = card.querySelector('.update-form'); 
    updateForm.style.display = updateForm.style.display === 'none'? 'none' : 'none';
  });
});
   document.addEventListener('click', (e) => {
            if (!dot.contains(e.target) && !display.contains(e.target)) {
              display.style.display = 'none';
            }
          });
        });
        document.querySelector('.add-main').addEventListener('click', function(event) {
          document.querySelector('.inpu-main').style.display = 'flex';
          event.preventDefault();
        });

        document.querySelector('.submit-main').addEventListener('click', function() {
          const inputField = document.querySelector('#input-main');
          inputField.value = '';
          document.querySelector('.inpu-main').style.display = 'none';
        });

        document.querySelector('.add-1').addEventListener('click', function(event) {
          document.querySelector('.inpu-1').style.display = 'flex';
          event.preventDefault();
        });

        document.querySelector('.submit-1').addEventListener('click', function() {
          const inputField = document.querySelector('#input-1');
          const newCard = document.createElement('div');
          inputField.value = '';
          document.querySelector('.inpu-1').style.display = 'none';
        });
        document.querySelector('.add-done').addEventListener('click', function(event) {
          document.querySelector('.input-done').style.display = 'flex';
          event.preventDefault();
        });

        document.querySelector('.submit-done').addEventListener('click', function() {
          const inputField = document.querySelector('#input-don');
          inputField.value = '';
          document.querySelector('.input-done').style.display = 'none';
        });
      });
      document.querySelector('.add-new-card').addEventListener('click', function(event) {
        event.preventDefault();
      const newCard = document.createElement("div");
       newCard.className = "card mx-4 my-4 doingcard";
       newCard.innerHTML = `
        <div class="card-body">
            <div class="mb-2">
                <input type="text" class="form-control new-input px-3" name="new" placeholder="Add A Title">
                <button class="rounded ms-1 px-2 bg-white border border-2 submit-new mt-2" type="submit">Add</button>
            </div>
        </div>`;
       document.querySelector('.output').appendChild(newCard);

    const submitButton = newCard.querySelector('.submit-new');
    submitButton.addEventListener('click', function(event) {
      event.preventDefault();
        const inputField = newCard.querySelector('.new-input');
        const newCard2 = document.createElement("div");
    newCard2.className = "card mx-4 my-4 doingcard";
    newCard2.innerHTML = 
        `<form action="yug1.php" method="post">
      <div class="doingcard mx-2 my-2">
        <div class="card-body px- py-1 bg-white">
          <div class="d-flex">
            <h5 class="card-title pt-2">Done</h5>
            <i class="fa-solid fa-sliders pt-3 fs--5" style="margin-left:190px;"></i>
            <div class="display">
              <ul class="list-group">
                <li class="list-group-item">Add</li>
                <li class="list-group-item">Copy</li>
                <li class="list-group-item"><a href="yug1.php?delete_done" class="text-black">Delete</a></li>
                <li class="list-group-item">Watch</li>
              </ul>
            </div>
          </div>
          <div class="output-new" id="output-new">
          <?php while ($row = $result_new->fetch_assoc()): ?>
          <div class="card card-result border border-2 shadow rounded px-2 py-1 mt-3">
            <p class="fw-normal"><?php echo htmlspecialchars($row['new']); ?></p>
            <div class="d-flex">
              <a href='yug1.php?delete_new_id=<?php echo $row['id']; ?>'><i class="fa-solid fa-trash"></i></a>
              <a class="update-form  mx-4" id="update-done" href='yug1.php?update_done_id=<?php echo $row['id']; ?>'><i class="fa-regular fa-pen-to-square"></i></a>
            </div>
          </div>
        <?php endwhile; ?>
          </div>
          <div class="d-flex">
            <button class="rounded px-1 pt-2 mt-2 bg-white border border-0 pb-1 add-new"><i class="fa-solid fa-plus"></i> Add A Card</button> 
          </div>
          <div class="input-new mb-2">
            <input type="text" class="form-control px-3" name="new" placeholder="Add A Title">
            <button class="rounded ms-1 px-2 bg-white border border-2 submit-done mt-2" type="submit">Add</button>
          </div>
        </div>
      </div>
    </form>`;
        newCard2.querySelector('.card-title').innerText=inputField.value;
        
        document.querySelector('.output').appendChild(newCard2);
        newCard.style.display='none';
        newCard2.querySelector('.add-new').addEventListener('click', function(event) {
          event.preventDefault();
          newCard2.querySelector('.input-new').style.display = 'flex';
        });

    const dots = document.querySelectorAll('.fa-sliders');
        dots.forEach(dot => {
          const display = dot.nextElementSibling;
          dot.addEventListener('click', function(event) {
            event.stopPropagation();
            display.style.display = display.style.display === 'block' ? 'block' : 'block';
          });
          
          document.addEventListener('click', (e) => {
            if (!dot.contains(e.target) && !display.contains(e.target)) {
              display.style.display = 'none';
            }
          });
        });
          const cards=newCard.querySelectorAll('.doingcard');
      cards.forEach(card => {
        if(display.style.display==='block'){
          newCard.querySelector('.card-body').style.height='auto';
        }
        else{
          newCard.querySelector('.card-body').style.height='initial';
        }
      });
      });
    });
    </script>
  </body>
</html>