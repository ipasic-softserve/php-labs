<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    if (empty($first_name) || empty($last_name)) {
        echo "<br>Please fill in all fields!";
    } else {
        echo "<br>Hello, $first_name $last_name!";
    }
}
