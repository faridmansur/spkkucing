<script type="text/javascript">
  function Blank_TextField_Validator() {
    if (text_form.username.value == "") {
      alert("Isi dulu username !");
      text_form.username.focus();
      return (false);
    }
    if (text_form.password.value == "") {
      alert("Isi dulu password !");
      text_form.password.focus();
      return (false);
    }
    return (true);
  }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Pakar - D'Cat Care</title>
  <link rel="stylesheet" href="assets/login/css/style.css">
</head>

<body>
  <div class="formku">
  <img src="assets/logo2.png" alt="Profile headshot" style="width:80px; position: absolute; top: -44px; left: calc(50% - 40px)"/>
    <div class="info">
      <h4><i class="fa fa-paper-plane"></i> Login Pakar</h4><br>
    </div>
    <form class="login-form" action="login.php" method="post" name="text_form"
      onsubmit="return Blank_TextField_Validator()">
      <input type="text" name="username" id="username" placeHolder="&#xf007;  Username"
        style="font-family:Arial, FontAwesome" />
      <input type="password" name="password" id="password" placeHolder="&#xf023;  Password"
        style="font-family:Arial, FontAwesome" />
      <input type="submit" name="submit" id="submitku" value="   Login   " /><br>
    </form>
  </div>
</body>

</html>
<script>
  $('input[type="password"]').on('focus', () => {
    $('*').addClass('password');
  }).on('focusout', () => {
    $('*').removeClass('password');
  });;
</script>
<script>
  var d = document.getElementById("pakarKucing");
  d.className += " sidebar-collapse";
</script>