<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/app.css">
    <title>Register</title>
</head>
<body>
   

<nav>
    <?php require_once '_menu.php'; ?>
</nav>

 
<div class="container">

  <?php require_once 'errors.php' ?>

  <form action="actions.php?action=register" class="mt-10" method="POST">

    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="<?php echo $_POST['name'] ?? '' ?>" placeholder="Your name..">

    <label for="login">Login</label>
    <input type="email" id="login" name="email" value="<?php echo $_POST['email'] ?? '' ?>" placeholder="Your email..">

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Your password..">
    
    
    <input type="submit" value="Submit">
  
  </form>
</div>

</body>
</html>