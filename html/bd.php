<?php
$mysqli = new mysqli("localhost", "newuser" , "password" ,"laravel");
if ($mysqli -> connect_errno ) {
    echo  " Не удалось подключиться к MySQL: ( "  .  $mysqli -> connect_errno  .  " ) "  .  $mysqli -> connect_error ;
}
else {
    $mysqli -> set_charset ( " utf8 " );
    define ('SALT', 'u2yDJR5aHTmrctQLwWFQUVCX7jWt7v4s9YEXkwkQ');
}
