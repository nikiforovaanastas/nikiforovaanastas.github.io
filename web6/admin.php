<meta charset="utf-8">
<head>

<style>

body {background: #D0E6A5;}
table{text-align: left;
border-collapse: separate;
border-spacing: 5px;
background:  #D0E6A5;
color: black;
border: 16px solid  #CCABD8;
border-radius: 20px;
}
th {
font-size: 18px;
padding: 10px;
}
td {
background:  #CCABD8;
padding: 10px;
}

.t1{background: #D0E6A5;}

. superbutton:focus{
outline:none;
}

</style>

</head>

<body style="padding-top:100px;">
<h1 style="text-align:center;">Database.</h1>

<form action='remove.php' method='POST' style='padding-right:100px; padding-left:100px;'>
<table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%" >
  <thead>
    <tr class='t1'>
      <th class="th-sm">id
      </th>
      <th class="th-sm">FIO
      </th>
      <th class="th-sm">email
      </th>
      <th class="th-sm">Bio
      </th>
      <th class="th-sm">YoB
      </th>
      <th class="th-sm">Gender
      </th>
      <th class="th-sm">Limbs
      </th>
      <th class="th-sm">Superpowers
      </th>
      <th class="th-sm">Login
      </th>
      <th class="th-sm">Password 
      </th>
      <th class="th-sm">Delete
      </th>
    </tr>
  </thead>
  <tbody >
<?php


if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != 'admin' ||
    md5($_SERVER['PHP_AUTH_PW']) != md5('123')) {
        header('HTTP/1.1 401 Unanthorized');
        header('WWW-Authenticate: Basic realm="My site"');
        print('<h1>401 You need login</h1>');
        exit();
    }
  //
    $db = new PDO('mysql:dbname=u20402;host=localhost', 'u20402', '9698907');

    $sql = "INSERT INTO foradmin SET
               admin = :admin,
               passadmin = :passadmin";

   $stmt = $db->prepare($sql);
    $stmt->execute(array(
        ':admin' => 'admin',
       ':passadmin' => MD5('123')));
//
    $stmt = $db->query('SELECT * FROM app1');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        echo "<tr><td >" . $row["id"]
        . "</td><td>" . $row["name"]
        . "</td><td>" . $row["email"]
        . "</td><td>" . $row["fieldname"]
        . "</td><td>" . $row["year"]
        . "</td><td>" . $row["sex"]
        . "</td><td>" . $row["limbs"]
        . "</td><td>" . $row["abilities"]
        . "</td><td>" . $row["login"]
        . "</td><td>" . $row["password"]
        . "</td><td><input type='checkbox' name='delete_row[]' value='" . $row["id"]
        . "'></td></tr>";
    }
    echo
    "</tbody>
    </table> <br>
    <div style='text-align:right;'><input type='submit' value='Delete'></div> <br>
    </form>
    <form action='http://u20402.kubsu-dev.ru/webb6/index.php' style='text-align:center;'>
    <button type='submit' style='width:150px;
        height:40px;
        border-radius:20px;
        background:#76B0E0;
        color:#fff;
        font-size:18px;
        cursor:pointer; '>Return.</button>
    </form>
";



?>

</tbody>
    </table>
    </form>
</body>
