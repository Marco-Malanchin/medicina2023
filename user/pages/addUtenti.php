<?php

session_start(); 
if(empty($_SESSION['user_id'])){
    header('location: ../login.php'); 
}

?>
<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fantacalcio | CreaUtenti</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/style.css">
        <link rel="icon" type="image/x-icon" href="../assets/img/logo.png">
    </head>

    <body>
  <?php require_once(__DIR__.'\navbar.php'); ?>

  <div class="container">
    <div class="row mt-5">
      <h2>Crea nuovo Utente</h2>
    </div>
    <div class="row mt-5">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row"></th>
            <form method="post">
              <td>
                <input class="form-control" type="" id="name" placeholder="name" name="name"
                  maxlength="50" required>
              </td>
              <td>
                <input class="form-control" type="" id="surname" placeholder="surname" name="surname"
                  maxlength="50" required>
              </td>
              <td>
                <input class="form-control" type="" id="email" placeholder="email" name="email"
                  maxlength="50" required>
              </td>
              <td>
                <input class="form-control" type="" id="password" placeholder="password" name="password"
                  maxlength="50" required>
              </td>
              <td>
                <button type="submit" class="btn btn-success" name="legha">Conferma</button>
</td>
</tr>
            <?php

include_once dirname(__FILE__) . '\..\function\user.php';
$err = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name'])|| !empty($_POST['surname'])||!empty($_POST['email'])||!empty($_POST['password'])) {
      $data = array(
        "name"  => $_POST ['name'],
        "surname"  => $_POST ['surname'],
        "email"  => $_POST ['email'],
        "password"  => $_POST ['password'],
        );
          $response =(array) addUser($data);
          if (!empty($response)){
               echo ('<p class="text-success fw-bold mt-3 ms-3">' . $response['Message'] . '</p>'); 
                   }
                   $id = getLastUserIdFromEmail($_POST['email']);
                   $data2 = array(
                    "user"  => $id,
                    "name"  => "user",
                    );
                    $response2 =addPrivileges($data2);
           }
        }
?>
        </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>