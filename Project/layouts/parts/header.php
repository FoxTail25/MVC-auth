<?=
isset($_SESSION['user_name']) ? user() : "Anonim";
function user()
{
    return $_SESSION['user_name'] . " " . '<a href="/logout">выйти</a>';
}
?>
