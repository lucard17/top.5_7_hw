<?php
function active($pageNumder, $prefix = "", $sufix = "")
{
    if (isset($_GET["page"])) {
        return $prefix . $_GET["page"] == $pageNumder ? " active" : "" . $sufix;
    }
}
?> <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">HOTELS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav w-100">
                <a class="nav-link rounded<?= active(1, " ") ?>" aria-current="page" href="/index.php?page=1">Туры</a>
                <!-- <a class="nav-link rounded<?= active(2, " ") ?>" href="/index.php?page=2">Комментарии</a> -->
                <?php if (isset($_SESSION["user"]) && $_SESSION["user_role"] == 1) : ?>
                    <a class="nav-link rounded<?= active(4, " ") ?>" href="/index.php?page=4">Консоль администратора</a>
                <?php endif; ?>
                <?php if (!isset($_SESSION["user"])) : ?>
                    <a class="nav-link rounded ms-auto<?= active(5, " ") ?>" href="/index.php?page=5">Вход</a>
                    <a class="nav-link rounded<?= active(3, " ") ?>" href="/index.php?page=3">Регистрация</a>
                <?php else : ?>
                    <form action="" method="POST" class="d-flex ms-auto">
                        <span class="nav-link active fw-bold"><?= $_SESSION["user"] ?></span>
                        <button type="submit" name="logout" class="btn btn-sm btn-danger">Выйти</button>
                    </form>

                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>