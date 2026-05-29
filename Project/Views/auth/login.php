<h2>
    Вход
</h2>
<?php
// if (isset($_SESSION['msg'])) {
//     echo "<div>$_SESSION[msg]</div>";
//     unset($_SESSION['msg']);
// }
?>
<form action="" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Войти</button>
    </div>
</form>
<a class="btn btn-outline-primary" href="/reg">
    <button>
        Зарегистрироваться
    </button>
</a>