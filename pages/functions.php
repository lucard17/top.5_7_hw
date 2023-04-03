
<?php
const debug_mode = false;
session_start();
if (isset($_POST["logout"])) {
    unset(
        $_SESSION["user"],
        $_SESSION["user_id"],
        $_SESSION["user_role"],
        $_SESSION["country_id"],
        $_SESSION["city_id"]
    );

    session_destroy();
}
function connect($host = "localhost", $user = "root", $pass = "", $db = "web221.nikolaev.5_7_hotels")
{
    $link = mysqli_connect($host, $user, $pass, $db) or die("Ошибка соединения");
    mysqli_query($link, 'SET NAMES "utf8"');
    return $link;
}
function db_query_array($query)
{
    global $link;
    try {
        $responce = mysqli_query($link, $query);
        $rows = mysqli_fetch_all($responce, MYSQLI_ASSOC);
        mysqli_free_result($responce);
        return $rows;
    } catch (mysqli_sql_exception $e) {
        return [];
    }
}
function db_query($query)
{
    global $link;
    try {
        $responce = mysqli_query($link, $query);
        return $responce;
    } catch (mysqli_sql_exception $e) {
        return false;
    }
}
function register($login, $pass, $email): bool
{
    $login = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));

    // Проверка на пустые поля
    if ($login == "" || $pass == "" || $email == "") {
        echo '<h4 class="text-danger">Все поля обязательны!</h4>';
        return false;
    }

    // Проверка на длину слов
    if (strlen($login) < 3 || strlen($login) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo '<h4 class="text-danger">Количество символов должно быть от 3 до 30!</h4>';
        return false;
    }

    $ins = 'INSERT INTO users(login, password, email, role_id) VALUES("' . $login . '", "' . md5($pass) . '", "' . $email . '", 2)';
    mysqli_query(connect(), $ins);

    return true;
}

function flash($text = "")
{
    static $flush_msg;
    if ($text !== "") {
        $flush_msg = $flush_msg . $text . "\\n";
    } else {
        if ($flush_msg != "") {
            echo "<script defer>alert( \"$flush_msg\" );</script>";
            $flush_msg = "";
        }
    }
}
function debug_to_console($data = "")
{
    static $logs = [];
    if (debug_mode == false) return false;
    if ($data !== "") {
        $logs[] = $data;
    } else {
        echo "<script> 
        const logs = (JSON.parse(decodeURIComponent('" . addslashes(json_encode($logs)) . "')));
        logs.forEach(log=>console.log(log));
        </script>";
    }
}
function server_info()
{
    if (debug_mode == false) return false;
    echo "<hr>";
    echo "\$_SERVER[DOCUMENT_ROOT]: " . $_SERVER['DOCUMENT_ROOT'];
    echo "<hr>";
    echo "GET info:<br>";
    foreach ($_GET as $key => $value) {
        echo "\$_GET ($key) : $value <br>";
    };
    echo "<hr>";
    echo "POST info:<br>";
    foreach ($_POST as $key => $value) {
        echo "\$_POST ($key) : $value <br>";
    };
    echo "<hr>";
    echo "SESSION info:<br>";
    echo "session_id() : " . session_id() . "<br>";
    foreach ($_SESSION as $key => $value) {
        echo "\$_SESSION ($key) : $value <br>";
    };
    echo "<hr>";
}
