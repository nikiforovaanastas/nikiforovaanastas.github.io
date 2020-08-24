<?php

header('Content-Type: text/html; charset=UTF-8');


session_start();

if (!empty($_SESSION['login'])) {
    header('Location: ./');
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    $errors = array();
    $errors['login'] = !empty($_COOKIE['login_error']);
    $errors['password'] = !empty($_COOKIE['password_error']);


    if (!empty($errors['login'])) {

        setcookie('login_error', '', 100000);

        $messages[] = '<div class="error">You entered an invalid login.</div>';
    }
    else if(!empty($errors['password'])){

        setcookie('password_error', '', 100000);

        $messages[] = '<div class="error">You entered an invalid password. </div>';
    }
    ?>
<html lang="ru">
  	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   <meta name="viewport" content="width=device-wedth,initial-scale=1.0">
		<link rel="stylesheet" href = "style.css">
		<title>login in web5</title>
	</head>
  <?php
    if (!empty($messages)) {
      print('<div id="messages">');

      foreach ($messages as $message) {
        print($message);
      }
      print('</div>');
    }
  ?>
  <div class="container justify-content-center p=0 m=0" id="content">
    <form action="login.php" method="post">
      <h2> <p> Login to change data. </p>
      <p>Login:</p>
      <input name="login" id="login"  placeholder="11111"/>
      <p>Password:</p>
      <input name="password" id="password" placeholder=""/>
    <br />
      <input type="submit" id="in" value=""/>
      </h2>
    </form>
  </div>
</html>
<?php
}

else {
  $errors = FALSE;
    if (empty($_POST['login'])) {

      setcookie('login_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    }
    else {

      setcookie('login_value', $_POST['login'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($_POST['password'])) {
      setcookie('password_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    }
    else{
      setcookie('password_value', $_POST['password'], time() + 30 * 24 * 60 * 60);
    }
    if ($errors) {

      header('Location: login.php');
      exit();
    }
    else{

    setcookie('login_error', '', 100000);
    setcookie('password_error', '', 100000);

    $login = $_POST['login'];
    $password = $_POST['password'];

    $user = 'u20402';
    $pass = '9698907';

    $db = new PDO('mysql:host=localhost;dbname=u20402', $user, $pass);
    extract($_POST);

    try {
      foreach($db->query('SELECT * FROM app1') as $row){
        if($row['login']==$_POST['login']){
            if($row['password']==$_POST['password']){

            $_SESSION['login'] = $_POST['login'];

            $values['name'] = $row['name'];
            $values['email'] = $row['email'];
            $values['fieldname'] = $row['fieldname'];
            $values['year'] = $row['year'];
            $values['sex'] = $row['sex'];
            $values['limbs'] = $row['limbs'];
            $values['abilities'] = $row['abilities'];
            setcookie('save', '1');

            header('Location: index.php');
          }

          else{
            $errors = TRUE;
            setcookie('password_error', '1s', time() + 24 * 60 * 60);
          }
      }
      }
    }
    catch(PDOException $e){
      print('Error : ' . $e->getMessage());
      exit();
    }
    setcookie('save', '1');

    $errors = TRUE;
    setcookie('login_error', '1', time() + 24 * 60 * 60);

    if ($errors) {
      header('Location: login.php');
      exit();
    }
  }
}
