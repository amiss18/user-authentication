<ul>
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
  <li class="push-right"><a href="register.php">Sign up</a></li>
  <?php if (empty($_SESSION['user'])): ?>
    <li class="pusqh-right"><a href="login.php">Login</a></li>
  <?php else: ?>
      <li class="pusqh-right"><a href="/actions.php?action=logout">Logout</a></li>
  <?php endif ?>
</ul>
