<?php
header('Content-Type: text/html; charset=UTF-8');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['save'])) {
        print(',   .');
    }
    include('form.php');
    exit();
}


$errors = FALSE;
if (empty($_POST['name'])) {
    print(' .<br/>');
    $errors = TRUE;
}

if (empty($_POST['email'])) {
    print(' email.<br/>');
    $errors = TRUE;
}

if (empty($_POST['abilities'])) {
    print(' .<br/>');
    $errors = TRUE;
}

$abilities = serialize($_POST['abilities']);

if (empty($_POST['fieldname'])) {
    print(' .<br/>');
    $errors = TRUE;
}

if (empty($_POST['checks'])) {
    print(' .<br/>');
    $errors = TRUE;
}

if ($errors) {
    exit();
}


$user = 'u20402';
$pass = '9698907';
$db = new PDO('mysql:host=localhost;dbname=u20402', $user, $pass, 
    array(PDO::ATTR_PERSISTENT => true));

try {
    $stmt = $db->prepare("INSERT INTO app1  SET name = ?, email = ?, year = ? , sex = ?, limbs = ?, abilities = ? , fieldname = ?");
    $stmt -> execute(array($_POST['name'], $_POST['email'], $_POST['year'], $_POST['sex'], $_POST['limbs'], $abilities, $_POST['fieldname']));
}

catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
}

header('Location: ?save=1');
