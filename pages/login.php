<?php

// include_once("pages/functions.php") 
?>

<?php

function login($login, $pass)
{
    $login = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($pass));

    // Проверка на пустые поля
    if ($login == "" || $pass == "") {
        echo '<h4 class="text-danger">Все поля обязательны!</h4>';
        return false;
    }

    $sel = "SELECT * FROM users";
    $res = mysqli_query(connect(), $sel);

    while ($row = mysqli_fetch_array($res)) {

        if ($login == $row["login"] && md5($pass) == $row["password"]) {
            $_SESSION["user"] = $row["login"];
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_role"] = $row["role_id"];
            return true;
        }
    }
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container py-5 container-sm">
        <h2 class="my-3">Войти на сайт</h2>

        <?php
        if (!isset($_POST["login_btn"])) : ?>
            <form action="index.php?page=5" method="POST">
                <div class="form-group mb-3">
                    <label for="login">Логин</label>
                    <input type="text" class="form-control" name="login">
                </div>
                <div class="form-group mb-3">
                    <label for="pass">Пароль</label>
                    <input type="password" class="form-control" name="pass">
                </div>
                <button type="submit" name="login_btn" class="btn btn-success">Регистрация</button>
            </form>
        <?php else : ?>


            <?php if (login($_POST["login"], $_POST["pass"])) : ?>
                <script>
                    window.location = window.location.origin
                </script>
            <?php endif ?>
        <?php endif ?>

</body>

</html>