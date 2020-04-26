<?php

include("autoload.php");
include("config.php");

//Restart
if (isset($_POST["restart-btn"])) {
    session_destroy();
} else if (isset($_POST["cheat-btn"])) {
    $_SESSION["showsecretnumber"] = true;
} else if (isset($_POST["guess-btn"])) {
    $number = $_POST["guess-input"];
    $_SESSION["answer"] = $_SESSION["guess"]->makeGuess($number);
}

header('Location: index.php');
