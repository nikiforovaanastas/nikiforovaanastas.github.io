<?php

header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {

    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('password', '', 100000);

    $messages[] = 'Thank you, the form has been submitted successfully.';
  }
  if (!empty($_COOKIE['password'])) {
      $messages[] = sprintf(' You could
                             <a href="login.php">use</a>
                             this login <strong>%s</strong>
                             and this password <strong>%s</strong>
                             to change data.',
       strip_tags($_COOKIE['login']),
       strip_tags($_COOKIE['password']));
  }

    $errors = array();
    $errors['name'] = !empty($_COOKIE['name_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['year'] = !empty($_COOKIE['year_error']);
    $errors['sex'] = !empty($_COOKIE['sex_error']);
    $errors['limbs'] = !empty($_COOKIE['limbs_error']);
    $errors['abilities'] = !empty($_COOKIE['abilities_error']);
    $errors['fieldname'] = !empty($_COOKIE['fieldname_error']);
    $errors['checks'] = !empty($_COOKIE['checks_error']);

    if ($errors['name']) {
      setcookie('name_error', '', 100000);
      $messages[] = '<div class="error"> The name is either empty or invalid characters are used.</div>';
    }

    if ($errors['email']) {
        setcookie('email_error', '', 100000);
        $messages[] = '<div class="error"> Email is either empty or incorrect.</div>';
    }

    if ($errors['year']) {
        setcookie('year_error', '', 100000);
        $messages[] = '<div class="error">Fill in the year.</div>';
    }

    if ($errors['sex']) {
        setcookie('sex_error', '', 100000);
        $messages[] = '<div class="error"> Please enter a gender.</div>';
    }

    if ($errors['limbs']) {
        setcookie('limbs_error', '', 100000);
        $messages['limbs'] = '<div class="errors"> Indicate the number of limbs.</div>';
    }

    if ($errors['fieldname']) {
        setcookie('fieldname_error', '', 100000);
        $messages['fieldname'] = '<div class="errors">Fill in the bio.</div>';
    }

    if ($errors['abilities']) {
        setcookie('abilities_error', '', 100000);
        $messages['abilities'] = '<div class="errors"> Choose superpower.</div>';
    }

    if ($errors['checks']) {
        setcookie('checks_error', '', 100000);
       $messages['checks'] = '<div class="errors"> Check the checkbox.</div>';
    }


    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' :
                            strip_tags($_COOKIE['name_value']);
    $values['email'] = empty($_COOKIE['email_value']) ? '' :
                            strip_tags($_COOKIE['email_value']);
    $values['year'] = empty($_COOKIE['year_value']) ? '' :
                            strip_tags($_COOKIE['year_value']);
    $values['sex'] = empty($_COOKIE['sex_value']) ? '' :
                            strip_tags($_COOKIE['sex_value']);
    $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' :
                            strip_tags($_COOKIE['limbs_value']);
    $values['fieldname'] = empty($_COOKIE['fieldname_value']) ? '' :
                            strip_tags($_COOKIE['fieldname_value']);
    $values['abilities'] = empty($_COOKIE['abilities_value']) ? '' :
                            strip_tags($_COOKIE['abilities_value']);
    $values['checks'] = empty($_COOKIE['checks_value']) ? '' :
                            strip_tags($_COOKIE['checks_value']);

    session_start();
    if ($errors && !empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {

            $login = $_SESSION['login'];


            $user = 'u20402';
            $pass = '9698907';
            $db = new PDO('mysql:host=localhost;dbname=u20402', $user, $pass);

            try {
                foreach($db->query('SELECT * FROM app1') as $row){
                    if($row['login'] == $login){

                            $values['name'] = $row['name'];
                            $values['email'] = $row['email'];
                            $values['fieldname'] = strip_tags($row['fieldname']);
                            $values['year'] = $row['year'];
                            $values['sex'] = $row['sex'];
                            $values['limbs'] = $row['limbs'];
                            $values['abilities'] = strip_tags($row['abilities']);


                            printf('Login with %s, you could 
                                <a href="logout.php">log off</a>', $_SESSION['login']);
                            break;
                        }
                }
            }
            catch(PDOException $e){
                print('Error : ' . $e->getMessage());
                exit();
            }
        }

    include('form.php');
}

else {

    $errors = FALSE;
    if (empty($_POST['name'])) {
        setcookie('name_error', '1', time() + 365 * 24 * 60 * 60);
        $errors = TRUE;
    }
    else{
        if (!preg_match('/^[a-zA-Z--ߨ\s\-]+$/u', $_POST['name'])){
            setcookie('name_error', '1', time() + 365 * 24 * 60 * 60);
            $errors = TRUE;
        }
        else
            setcookie('name_value', $_POST['name'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['email'])) {
        setcookie('email_error', '2', time() + 365 * 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
            setcookie('email_error', '2', time() + 365 * 24 * 60 * 60);
            $errors = TRUE;
        }
        else {
        setcookie('email_value', $_POST['email'], time() + 365 * 24 * 60 * 60);
        }
    }

    if (empty($_POST['year'])) {
        setcookie('year_error', '3', time() + 365 * 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('year_value', $_POST['year'], time() + 365 * 24 * 60 * 60);
    }

    if (!$_POST['sex']){
        setcookie('sex_error', '4', time() + 365 * 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('sex_value', $_POST['sex'], time() + 365 * 24 * 60 * 60);
    }

    if (!$_POST['limbs']){
        setcookie('limbs_error', '5', time() + 365 * 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('limbs_value', $_POST['limbs'], time() + 365 * 24 * 60 * 60);
    }

    if (!$_POST['fieldname']){
        setcookie('fieldname_error', '6', time() + 365 * 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('fieldname_value', $_POST['fieldname'], time() + 365 * 24 * 60 * 60);
    }

    if (!$_POST['abilities']){
        setcookie('abilities_error', '7', time() + 365 * 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('abilities_value', $_POST['abilities'], time() + 365 * 24 * 60 * 60);
    }

    if (!$_POST['checks']){
        setcookie('checks_error', '8', time() + 365 * 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('checks_value', $_POST['checks'], time() + 365 * 24 * 60 * 60);
      }


    if ($errors) {
        header('Location: index.php');
        exit();
    }
      else {
        setcookie('name_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('year_error', '', 100000);
        setcookie('sex_error', '', 100000);
        setcookie('limbs_error', '', 100000);
        setcookie('fieldname_error', '', 100000);
        setcookie('abilities_error', '', 100000);
        setcookie('checks_error', '', 100000);
      }

      if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {

          setcookie('login', $login);
          setcookie('password', $password);
          extract($_POST);

          $user = 'u20402';
          $pass = '9698907';
          $db = new PDO('mysql:host=localhost;dbname=u20402', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
          extract($_POST);

          $login = $_SESSION['login'];
          $name = $_POST['name'];
          $email = $_POST['email'];
          $year = $_POST['year'];
          $sex = $_POST['sex'];
          $limbs = $_POST['limbs'];
          $abilities = $_POST['abilities'];
          $fieldname = $_POST['fieldname'];
          $checks = $_POST['checks'];

          try {
              $sql = "UPDATE app1
                      SET name = :name,
                      email = :email,
                      fieldname = :fieldname,
                      year = :year,
                      sex = :sex,
                      limbs = :limbs,
                      abilities = :abilities
                      WHERE login = :login";

                $stmt = $db->prepare($sql);
                $stmt->execute(array(':name' => $name,
                    ':email' => $email,
                    ':fieldname' => $fieldname,
                    ':year' => $year,
                    ':sex' => $sex,
                    ':limbs' => $limbs,
                    ':abilities' => $abilities,
                    ':login' => $login));
          }

          catch(PDOException $e){
              print('Error : ' . $e->getMessage());
              exit();
          }
          setcookie('save', '1');
          $messages[] = 'Thank you, the results are saved.';
          header('Location: index.php');
      }

        else {

            $user = 'u20402';
            $pass = '9698907';
            $db = new PDO('mysql:host=localhost;dbname=u20402', $user, $pass,
                array(PDO::ATTR_PERSISTENT => true));
            extract($_POST);

            $b=TRUE;
            try {
                while($b){
                    $login = rand(100, 1000);
                    $password = rand(100, 1000);
                    $b=FALSE;
                    foreach($db->query('SELECT login FROM app1') as $row){
                        if($row['login']==$login){
                            $b=TRUE;
                        }
                    }
                }
            }

            catch(PDOException $e){
                print('Error : ' . $e->getMessage());
                setcookie('save', '1');
                exit();
            }

            setcookie('login', $login);
            setcookie('password', $password);
            extract($_POST);

            $name = $_POST['name'];
            $email = $_POST['email'];
            $year = $_POST['year'];
            $sex = $_POST['sex'];
            $limbs = $_POST['limbs'];
            $abilities = $_POST['abilities'];
            $fieldname = $_POST['fieldname'];
            $checks = $_POST['checks'];

            try{
                $sql = "INSERT INTO app1
                        SET name = :name,
                        email = :email,
                        fieldname = :fieldname,
                        year = :year,
                        sex = :sex,
                        limbs = :limbs,
                        abilities = :abilities,
                        login = :login,
                        password = :password";

                $stmt = $db->prepare($sql);
                $stmt->execute(array(':name' => $_POST['name'],
                    ':email' => $_POST['email'],
                    ':fieldname' => $_POST['fieldname'],
                    ':year' => $_POST['year'],
                    ':sex' => $_POST['sex'],
                    ':limbs' => $_POST['limbs'],
                    ':abilities' => $_POST['abilities'],
                    ':login' => $login,
                    ':password' => $password));
            }

            catch(PDOException $e){
                print('Error : ' . $e->getMessage());
                exit();
            }
        }

      setcookie('save', '1');
      $messages[] = 'Thank you, the results are saved.';
      header('Location: index.php');
    }
