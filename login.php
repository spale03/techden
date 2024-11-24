<!DOCTYPE php>
<html>

<?php include_once 'head.php'; ?>

<link rel="stylesheet" href="style/login.css">

<body>
  <?php include_once 'header.php'; ?>
  <div class="container">
    <h1>Login</h1>
    <form action="logovanje.php" method="post">
      
    <?php if (isset ($_GET['error'])): ?>
     <!-- prikazuje gresku kada logovanje php prosledi sa error=1 -->
        <span style="color:red;">
          <?= 'INCORRECT CREDENTIALS' ?>
        </span>
      <?php endif; ?>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
  </div>

<?php include 'footer.php' ?>

</body>


</html>