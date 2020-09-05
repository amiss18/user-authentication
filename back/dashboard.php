<?php
session_start();

if (empty($_SESSION['user']))
   header('Location: ./../index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../assets/app.css">
    <title>Home</title>
</head>
<body>
   

<nav>
    <?php require_once '../_menu.php'; ?>
</nav>

 
<div class="container">
   <h1 class="h1">Private area</h1> 
   <p> Welcome <strong><?php echo $_SESSION['user']['name']?> </strong></p>
  <p>You are successfully authenticated!"</p>
</div>

</body>
</html>