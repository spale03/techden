<!DOCTYPE php>
<html>
<?php include_once 'head.php'; ?>
<link rel="stylesheet" href="style/register.css">
<body>
  <?php include_once 'header.php'; ?>

  <div class="container">
    <form action="dodaj_korisnika.php" method="post">
      <h1>Register</h1>
      <!-- ako dodavanje korisnika preusmeri na gresku prikazi je -->
      <?php if (isset ($_GET['error'])): ?>
        <span style="color:red;">
          <?= 'Password not matching' ?>
        </span>
      <?php endif; ?>
      <input type="text" name="username" placeholder="Username" required minlength="8" maxlength="25">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required minlength="8" maxlength="15">
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit">Register</button>
    </form>
  </div>
  <?php include 'footer.php' ?>
</body>

</html>