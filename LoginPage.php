<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="LoginStyle.css">
  </head>
  <body>
    <form id="login-form">
      <h1>Sign into UniForum</h1>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <input type="submit" value="Login">
      <h3></h3>
      <a href="">Forget Password?</a>
      <div class="error">Incorrect username or password.</div>
    </form>
  </body>
</html>
