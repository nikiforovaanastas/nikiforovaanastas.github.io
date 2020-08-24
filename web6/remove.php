<?php
$db_server = "localhost";
$db_user = "u20402";
$db_password = "9698907";
$db_name = "u20402";
try {

    $db = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $ids_to_delete = array();

    foreach($_POST['delete_row'] as $selected){
        $ids_to_delete[] = $selected;
    }

    if(empty($ids_to_delete)){
        echo "You have not allocated anything.";
        return;
    }

    if(sizeof($ids_to_delete > 0)){
        $sql = "DELETE FROM app1 WHERE id IN (" . implode(',', array_map('intval', $ids_to_delete)) . ")";

        $statement = $db->prepare($sql);

        $statement->execute();
        header('Location: admin.php');
    }
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$db = null;
?>
