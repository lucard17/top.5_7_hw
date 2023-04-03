<h2 class="my-3">Регистрация</h2>

<?php
if (!isset($_POST["reg_btn"])) : ?>
    <form action="index.php?page=3" method="POST">
        <div class="form-group mb-3">
            <label for="login">Логин</label>
            <input type="text" class="form-control" name="login">
        </div>
        <div class="form-group mb-3">
            <label for="pass">Пароль</label>
            <input type="password" class="form-control" name="pass">
        </div>
        <div class="form-group mb-3">
            <label for="pass2">Повторите пароль</label>
            <input type="password" class="form-control" name="pass2">
        </div>
        <div class="form-group mb-3">
            <label for="pass2">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <button type="submit" name="reg_btn" class="btn btn-success">Регистрация</button>
    </form>
<?php else : ?>
    <?php if(register($_POST["login"], $_POST["pass"], $_POST["email"])) : ?>
        <h2 class="text-success">Пользователь зарегистрирован</h2>
    <?php endif ?>
<?php endif ?>