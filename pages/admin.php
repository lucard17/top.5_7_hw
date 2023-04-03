<?php if (!isset($_SESSION["user"]) || $_SESSION["user_role"] != 1) : ?>
    <h3 class="text-danger">Эта страница только для администраторов!</h3>

<?php
    exit();
endif ?>



<h2 class="py-3">Консоль администратора</h2>

<div class="row">
    <!-- ОТЕЛИ -->

    <div class="col-md-6 col-12 d-flex flex-column justify-content-between mb-3">
        <?php
        $link = connect();
        $sel = 'SELECT * FROM countries ORDER BY id';
        $res = mysqli_query($link, $sel);
        ?>
        <h3 class="mb-3">Страны:</h3>
        <form action="index.php?page=4" method="POST">
            <table class="table table-striped">
                <?php while ($row = mysqli_fetch_array($res)) : ?>
                    <tr>
                        <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row["country"] ?></td>
                        <td>
                            <input type="checkbox" name="<?php echo "cb" . $row["id"] ?>">
                        </td>
                    </tr>
                <?php endwhile;
                // unset($res);
                mysqli_free_result($res);
                ?>
            </table>

            <div class="form-group my-2  text-end">
                <input type="text" name="country" class="form-control  mb-2" placeholder="Страна">
                <button type="submit" class="btn btn-info" name="add_country">Добавить</button>
                <button type="submit" class="btn btn-danger" name="del_country">Удалить</button>
            </div>
        </form>

        <?php
        if (isset($_POST["add_country"])) {
            $country = trim(htmlspecialchars($_POST["country"]));

            if ($country == "") exit();

            $ins = 'INSERT INTO countries(country) VALUES("' . $country . '")';
            mysqli_query($link, $ins);
            echo "<script>window.location=document.URL</script>";
        }

        if (isset($_POST["del_country"])) {
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 2) == "cb") {
                    $countryId = substr($key, 2); // cb2 => 2
                    $del = 'DELETE FROM countries WHERE id=' . $countryId;
                    mysqli_query($link, $del);
                }
            }

            echo "<script>window.location=document.URL</script>";
        }
        ?>

    </div>
    <!-- ГОРОДА -->
    <div class="col-md-6 col-12 d-flex flex-column justify-content-between mb-3 ">
        <h3 class="mb-3">Города:</h3>
        <form action="index.php?page=4" method="POST" id="formCity">
            <?php
            $sel = 'SELECT CI.id, CI.city, CO.country FROM cities AS CI, countries AS CO WHERE CI.country_id = CO.id';
            $res = mysqli_query($link, $sel);
            ?>
            <table class="table table-striped">
                <?php while ($row = mysqli_fetch_array($res)) : ?>
                    <tr>
                        <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row["city"] ?></td>
                        <td><?php echo $row["country"] ?></td>
                        <td>
                            <input type="checkbox" name="<?php echo "cx" . $row["id"] ?>">
                        </td>
                    </tr>
                <?php endwhile;
                mysqli_free_result($res)
                ?>
            </table>

            <?php
            $sel = "SELECT * FROM countries";
            $res = mysqli_query($link, $sel);
            ?>
            <div class="form-group d-flex justify-content-between mb-3 gap-3">
                <select name="country_name" class="form-control">
                    <?php while ($row = mysqli_fetch_array($res)) : ?>
                        <option value="<?php echo $row["id"] ?>">
                            <?php echo $row["country"] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <input type="text" name="city" class="form-control" placeholder="Город">
            </div>
            <div class="form-group text-end">
                <button type="submit" class="btn btn-info" name="add_city">Добавить</button>
                <button type="submit" class="btn btn-danger" name="del_city">Удалить</button>
            </div>
        </form>

        <?php
        if (isset($_POST["add_city"])) {
            $city = trim(htmlspecialchars($_POST["city"]));
            if ($city == "") exit();

            $countryId = $_POST["country_name"];
            $ins = 'INSERT INTO cities(city, country_id) VALUES("' . $city . '", ' . $countryId . ')';
            mysqli_query($link, $ins);
            echo "<script>window.location=document.URL</script>";
        }

        if (isset($_POST["del_city"])) {
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 2) == "cx") {
                    $cityId = substr($key, 2); // cb2 => 2
                    $del = 'DELETE FROM cities WHERE id=' . $cityId;
                    mysqli_query($link, $del);
                }
            }
            echo "<script>window.location=document.URL</script>";
        }
        ?>
    </div>
    <!-- Отели -->
    <div class="col-md-6 col-12 d-flex flex-column justify-content-between mb-3">
        <h3 class="mb-3">Отели:</h3>
        <form action="index.php?page=4" method="POST" class="d-flex flex-column justify-content-between gap-2">
            <?php
            $sel = 'SELECT CI.id, CI.city, HO.id, HO.hotel, HO.city_id, HO.country_id, HO.stars, HO.info, CO.id, CO.country, HO.cost
                FROM cities AS CI, countries AS CO, hotels AS HO
                WHERE HO.city_id = CI.id AND HO.country_id = CO.id';

            $res = mysqli_query($link, $sel);
            ?>

            <table class="table table-striped">
                <?php while ($row = mysqli_fetch_array($res)) : ?>
                    <tr>
                        <td><?php echo $row[2] ?></td>
                        <td><?php echo $row[1] . "-" . $row[9] ?></td>
                        <td><?php echo $row[3] ?></td>
                        <td><?php echo $row[6] ?></td>
                        <td><?php echo $row[10] ?></td>
                        <td>
                            <input type="checkbox" name="<?php echo "ch" . $row[2] ?>">
                        </td>
                    </tr>
                <?php endwhile;
                mysqli_free_result($res) ?>
            </table>

            <?php
            $sel = 'SELECT CI.id, CI.city, CO.country, CO.id FROM countries AS CO, cities AS CI WHERE CO.id = CI.country_id';
            $res = mysqli_query($link, $sel);
            $cSel = [];
            ?>

            <select name="h_city" class="form-control">
                <?php while ($row = mysqli_fetch_array($res)) : ?>
                    <option value="<?php echo $row[0] ?>">
                        <?php echo $row[1] . " : " . $row[2] ?>
                    </option>
                    <?php $cSel[$row[0]] = $row[3] ?>
                <?php endwhile;
                mysqli_free_result($res) ?>
            </select>
            <input type="text" name="hotel" class="form-control" placeholder="Название отеля">
            <input type="text" name="cost" class="form-control" placeholder="Стоимость">
            <input type="number" name="stars" class="form-control" placeholder="Звезды" min="1" max="5">
            <textarea name="info" class="form-control"></textarea>

            <div class="form-group text-end">
                <button type="submit" class="btn btn-info" name="add_hotel">Добавить</button>
                <button type="submit" class="btn btn-danger" name="del_hotel">Удалить</button>
            </div>
        </form>

        <?php

        if (isset($_POST["add_hotel"])) {
            $hotel = trim(htmlspecialchars($_POST["hotel"]));
            $cost = trim(htmlspecialchars($_POST["cost"]));
            $stars = trim(htmlspecialchars($_POST["stars"]));
            $info = trim(htmlspecialchars($_POST["info"]));

            if ($hotel == "" || $cost == "" || $stars == "") {
                exit();
            }

            $cityId = $_POST["h_city"];
            $countryId = $cSel[$cityId];

            $ins = 'INSERT INTO hotels(hotel, stars, cost, info, country_id, city_id) 
                    VALUES("' . $hotel . '","' . $stars . '","' . $cost . '","' . $info . '",' . $countryId . ',' . $cityId . ')';

            mysqli_query($link, $ins);
            echo "<script>window.location=document.URL</script>";
        }


        if (isset($_POST["del_hotel"])) {
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 2) == "ch") {
                    $hotelId = substr($key, 2); // cb2 => 2
                    $del = 'DELETE FROM hotels WHERE id=' . $hotelId;
                    mysqli_query($link, $del);
                }
            }
            echo "<script>window.location=document.URL</script>";
        }
        ?>
    </div>
    <!-- Добавить изображения -->
    <div class="col-md-6 col-12 d-flex flex-column justify-content-between mb-3">
        <h3 class="mb-3">Добавить изображения:</h3>
        <form action="index.php?page=4" method="POST" enctype="multipart/form-data" class="d-flex flex-column justify-content-between gap-2">
            <div class="form-group">
                <select name="hotel_id" id="" class="form-control">

                    <?php
                    $sel = 'SELECT HO.id, CO.country, CI.city, HO.hotel 
                            FROM countries AS CO, cities AS CI, hotels AS HO 
                            WHERE CO.id = HO.country_id AND CI.id = HO.city_id 
                            ORDER BY CO.country';

                    $res = mysqli_query($link, $sel);
                    while ($row = mysqli_fetch_array($res)) : ?>
                        <option value="<?php echo $row[0] ?>">
                            <?php echo $row[3] . " : " . $row[2] . " : " .  $row[1] ?>
                        </option>
                    <?php endwhile;
                    mysqli_free_result($res) ?>
                </select>
            </div>
            <div class="form-group">
                <input type="file" name="file[]" multiple accept="image/*" class="form-control">
            </div>
            <div class="form-group text-end">
                <button type="submit" class="btn btn-info" name="add_images">Добавить</button>
            </div>
        </form>


        <?php

        if (isset($_REQUEST["add_images"])) {

            foreach ($_FILES["file"]["name"] as $key => $value) {

                if ($_FILES["file"]["error"][$key] != 0) {
                    echo '<script>alert("Ошибка загрузки изображения. Ошибка файла: ' . $value . '")</script>';
                    continue;
                }

                if (move_uploaded_file($_FILES["file"]["tmp_name"][$key], 'images/' . $value)) {
                    $ins = 'INSERT INTO images(hotel_id, image_path) VALUES(' . $_REQUEST["hotel_id"] . ', "images/' . $value . '")';
                    mysqli_query($link, $ins);
                }
            }
        }

        ?>
    </div>
</div>