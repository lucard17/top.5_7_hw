<?php include_once("functions.php");
if (!isset($_GET['hotel'])) {
    die();
} else {
    $hotel_id = $_GET['hotel'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="\css\bootstrap.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="\css\styles.css">

</head>

<body>
    <!-- NAVBAR -->

    <?php include_once("menu.php") ?>


    <!-- HOTEL INFO -->
    <div class="container py-5">
        <?php if (isset($_GET["hotel"])) :
            $link = connect();
            $sel = 'SELECT * FROM hotels WHERE id=' . $hotel_id;
            $res = mysqli_query($link, $sel);
            $hotel = mysqli_fetch_array($res);

            $hotelName = $hotel["hotel"];
            $hotelStars = $hotel["stars"];
            $hotelCost = $hotel["cost"];
            $hotelInfo = $hotel["info"];

            mysqli_free_result($res);
        endif ?>


        <h2><?php echo $hotelName ?></h2>

        <div class="my-3">
            <div class="d-flex">
                <?php

                $sel = 'SELECT * FROM images WHERE hotel_id=' . $hotel_id;
                $res = mysqli_query($link, $sel);

                while ($row = mysqli_fetch_array($res)) :
                ?>
                    <img src="<?php echo "../" . $row["image_path"] ?>" alt="" width="300">
                <?php endwhile;
                mysqli_free_result($res) ?>
            </div>
        </div>

        <div class="my-3">
            <ul class="d-flex justify-content-start" style="list-style: none;">
                <?php for ($i = 1; $i <= $hotelStars; $i++) : ?>
                    <li><img src="../images/star.png" alt="" width="40"></li>
                <?php endfor ?>
            </ul>
        </div>

        <div class="my-3">
            <p><?php echo $hotelInfo ?></p>
        </div>

        <div class="my-3 text-end fw-bold">
            <p><?php echo $hotelCost . " руб." ?></p>
        </div>
    </div>
    <!-- COMMENT ADD FORM -->

    <?php
    // Обработчик добавления комментария
    // Проверка заполнения обоих полей
    // БД дает возможность оставлять не более одного комментария в день

    if (isset($_SESSION["user"]) && isset($_POST['comment'])) {
        $date = date("Y-m-d");
        $comment = ($_POST['comment']);
        $comment = strip_tags($_POST['comment']);
        $comment = htmlspecialchars($comment);
        $comment = mysqli_escape_string($link, $comment);
        $_SESSION["comment"] = $comment;
        $_SESSION["comment_rate"] = $_POST["rate"];

        if ($_POST['comment'] == "" || $_POST["rate"] == "") {
            flash("Запалните все поля чтобы оставить комментарий");
        } else {
            try {
                $result = mysqli_query($link, "INSERT INTO commentaries(user_id, hotel_id, date, text, rate) 
            VALUES ($_SESSION[user_id], $hotel_id, \"$date\", \"$comment\",$_POST[rate])");
            } catch (mysqli_sql_exception $e) {
                $errno =  $e->getCode();
                if ($errno == 1062) {
                    flash("Вы уже добавляли сегодня комментарий на этой странице");
                } else {
                    flash("Произошла ошибка");
                };
            }
        }
    }
    
    //Обрабатываем запрос удаления комментария
    if (isset($_POST['comment-btn-delete'])) {
        $query = "DELETE FROM commentaries WHERE id = $_POST[comment_id] AND user_id = $_SESSION[user_id] AND hotel_id = $hotel_id";
        db_query($query);
        // debug_to_console("PHP(".__LINE__.")\\nЗапрос удаления: $query");
    }

    // Вывод формы "Оставить комментарий"
    // Только для авторизованных пользователей
    if (isset($_SESSION["user"])) :
    ?>
        <div class="container py-5">
            <form action="/pages/hotel_info.php?hotel=<?= $hotel_id ?>" method="POST">
                <div class="form-group mb-3">
                    <label for="comment">Ваш комментарий:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3"><?php
                                                                                        echo isset($_SESSION["comment"]) ? $_SESSION["comment"] : ""; ?></textarea>
                </div>
                <label for="comment" id="rate">Оценка:</label>
                <div class="form-group mb-3 text-end d-flex gap-3">
                    <input type="number" min="1" max="5" step="0.1" name="rate" id="rate" class="form-control" value="<?php
                                                                                                                        echo isset($_SESSION["comment_rate"]) ? $_SESSION["comment_rate"] : ""; ?>">
                    <button type="submit" name="comment-btn" class="btn btn-success">Отправить</button>
                </div>
            </form>
        </div>
    <?php endif; ?>


    <!-- ALL COMMENTARIES -->
    <?php
    //Получаем комментарии к выбранному отелю
    $query = "SELECT c.id, user_id, login, text, date, rate FROM commentaries AS c, users as u
WHERE c.user_id = u.id AND hotel_id = $hotel_id ORDER BY date DESC, c.id DESC";
    debug_to_console("PHP(" . __LINE__ . "):\n $query");
    $rows = db_query_array($query); ?>

    <?php if (count($rows) > 0) :
        //Выводим все комментарии
    ?>
        <div class="container py-5">
            <?php foreach ($rows as $row) : ?>
                <div class="card comment">
                    <div class="card-body comment_info-row">
                        <div class="comment_info">
                            <div class="comment_author-avatar"></div>
                            <div class="">
                                <p class="comment_author-name">
                                    <?= "$row[login]" ?>
                                </p>
                                <p class="comment_date">
                                    <?= "$row[date]" ?></p>
                            </div>
                        </div>


                        <div class="comment_rate">
                            <img src="../images/star.png" alt="" class="comment_rate-star">
                            <span class="comment_rate-value"><?= "$row[rate]" ?></span>
                        </div>
                    </div>
                    <div class="card-body comment_text">
                        <?= "$row[text]" ?>
                        <?php
                        //Добавляем админам и владельцам комментариев кнопку удалить
                        if ($row['user_id'] == $_SESSION['user_id'] || $_SESSION['user_role'] == 1) : ?>
                            <form action="<?= "/pages/hotel_info.php?hotel=$hotel_id" ?>" method="post" class="comment_delete">
                                <input type="number" name="comment_id" value="<?= "$row[id]" ?>" hidden>
                                <button type="submit" name="comment-btn-delete" class="comment_btn-delete rounded">&#9851</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endforeach; // echo "$row[user_id]<br>";
            ?>
        </div>
    <?php endif; ?>
    <?php server_info(); ?>
    <?php debug_to_console(); ?>
    <?php flash(); ?>
</body>

</html>