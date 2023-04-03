<?php $link = connect();


if (isset($_POST["sel_country"])) {
    if (!isset($_SESSION["country_id"])) {
        $_SESSION["country_id"] = $_POST["country_id"];
        unset($_SESSION["city_id"]);
    } else {
        if ($_SESSION["country_id"] !== $_POST["country_id"]) {
            $_SESSION["country_id"] = $_POST["country_id"];
            unset($_SESSION["city_id"]);
        }
    }
}
if (isset($_POST["sel_city"])) {
    $_SESSION["city_id"] = $_POST["city_id"];
}

function setSelection($value, $sessionKey)
{
    if (isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey] == $value) {
        return "selected";
    }
    return "";
}

?>
<h2 class="py-3">Список туров</h2>
<form action="index.php?page=1" method="POST">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="d-flex">
                <select name="country_id" class="form-control">
                    <?php
                    $sel = 'SELECT * FROM countries ORDER BY country';
                    $res = mysqli_query($link, $sel);

                    while ($row = mysqli_fetch_array($res)) :
                    ?>
                        <option value="<?php echo $row["id"] ?>" <?= setSelection($row["id"], "country_id") ?>>
                            <?php echo $row["country"] ?>
                        </option>

                    <?php endwhile;
                    mysqli_free_result($res) ?>
                </select>

                <button type="submit" name="sel_country" class="btn btn-info">OK</button>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="d-flex">
                <select name="city_id" class="form-control">
                    <?php if (isset($_SESSION["country_id"])) :
                        $countryId = $_SESSION["country_id"];
                        if ($countryId == "") exit();

                        $sel = 'SELECT * FROM cities WHERE country_id=' . $countryId . ' ORDER BY city';
                        $res = mysqli_query($link, $sel);

                        while ($row = mysqli_fetch_array($res)) : ?>

                            <option value="<?php echo $row["id"] ?>" <?= setSelection($row["id"], "city_id") ?>>
                                <?php echo $row["city"] ?>
                            </option>

                        <?php endwhile;
                        mysqli_free_result($res); ?>

                    <?php endif; ?>
                </select>
                <button type="submit" name="sel_city" class="btn btn-info">OK</button>
            </div>
        </div>
    </div>
</form>

<?php
if (isset($_POST["sel_city"])) :
    $cityId = $_POST["city_id"];
    $sel = 'SELECT CO.country, CI.city, HO.hotel, HO.cost, HO.stars, HO.id 
            FROM hotels AS HO, cities AS CI, countries AS CO 
            WHERE HO.city_id = CI.id AND HO.country_id = CO.id AND HO.city_id =' . $cityId;
    $res = mysqli_query($link, $sel);
?>

    <table class="table table-striped my-5">
        <thead>
            <tr>
                <th>Отель</th>
                <th>Страна</th>
                <th>Город</th>
                <th>Цена</th>
                <th>Звезды</th>
                <th>Ссылка</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($res)) : ?>

                <tr>
                    <td><?php echo $row[2] ?></td>
                    <td><?php echo $row[0] ?></td>
                    <td><?php echo $row[1] ?></td>
                    <td><?php echo $row[3] ?></td>
                    <td><?php echo $row[4] ?></td>
                    <td><a href="<?php echo "pages/hotel_info.php?hotel=" . $row[5] ?>">Перейти</a></td>
                </tr>

            <?php endwhile;
            mysqli_free_result($res) ?>
        </tbody>
    </table>

<?php endif ?>