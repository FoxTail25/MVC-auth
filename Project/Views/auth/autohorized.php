<?php
if (isset($_SESSION['username'])) {
    echo "Привет $_SESSION[username]!";
} else {
    echo "Error!!! No user";
}
?>
<br />
<br />
<a href="logoff">выйти</a>