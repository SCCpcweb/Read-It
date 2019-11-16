<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="css/login.css" />
  <script src="https://kit.fontawesome.com/7d78b719fc.js" crossorigin="anonymous"></script>
  <title>Read-It</title>
</head>

<body>
  <div class="container">
    <div class="signup-card">
      <div class="signup-card-left">
        <form action="index.php" method="POST">
          <h2 class="login-title">Log In</h2>
          <div class="image">
            <i class="fas fa-user"></i>
          </div>
          <div class="input-section">
            <label for="username">Username</label><input type="text" name="username" value="<?php if (!empty($username)) {
                                                                                              echo htmlspecialchars($username);
                                                                                            } ?>" required>
          </div>
          <div class="input-section">
            <label for="password">Password</label><input type="password" name="password" required>
          </div>
          <div class="input-section">
            <?php if (!empty($loginErrors)) {
              echo '<div class="error">';
              foreach ($loginErrors as $error) {
                echo '<p>' . htmlspecialchars($error) . '</p>';
              }
              echo '</div>';
            } ?>
          </div>
          <div class="input-section">
            <input type="submit" value="Login">
            <input type="hidden" name="action" value="loginValidation">
          </div>
        </form>
      </div>
      <div class="signup-card-right">
        <form action="index.php" method="POST">
          <h2 class="login-title" style="margin-bottom: 10px;">Sign up</h2>
          <div class="input-section">
            <label for="username-signUp">Username</label><input type="text" name="username-signUp" required>
          </div>
          <div class="input-section">
            <label for="email-signUp">Email</label><input type="email" name="email-signUp" required>
          </div>
          <div class="input-section">
            <label for="password-signup">Password</label><input type="password" name="password-signUp" required>
          </div>
          <div class="input-section">
            <label for="password-verify">Verify Password</label><input type="password" name="password-verify" required>
          </div>
          <div class="input-section">
            <?php if (!empty($registrationErrors)) {
              echo '<div class="error">';
              foreach ($registrationErrors as $error) {
                echo '<p>' . htmlspecialchars($error) . '</p>';
              }
              echo '</div>';
            } ?>
            <?php if (!empty($passwordErrors)) {
              echo '<div class="error">';
              foreach ($passwordErrors as $error) {
                echo '<p>' . htmlspecialchars($error) . '</p>';
              }
              echo '</div>';
            } ?>
          </div>
          <div class="input-section">
            <input type="submit" value="Sign Up">
            <input type="hidden" name="action" value="registrationValidation">
          </div>
      </div>

      </form>
    </div>
  </div>
  </div>
  <div class="back">
    <a href="index.php?action=home">← Go Back</a>
  </div>


  <script>
    function toggleClass() {
      var element = document.getElementById("error-right");
      alert(element.innerHTML.length);
      if (element.innerHTML.length !== 41) {
        element.style.display = "block";
      }
    }

    toggleClass();
  </script>
</body>

</html>