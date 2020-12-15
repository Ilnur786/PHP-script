<?php
$link = mysqli_connect('localhost', 'root', 'root') or die ("Не могу подключиться к серверу");
mysqli_select_db( $link,'test') or die ("Не могу подключиться к серверу");
