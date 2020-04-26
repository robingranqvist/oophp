<?php

include("autoload.php");
include("config.php");

//Skapa guess-objekt & hemligt nummer
if (!isset($_SESSION["guess"])) {
    $_SESSION["guess"] = new Guess();
    $_SESSION["guess"]->random();
    $_SESSION["secretnumber"] = $_SESSION["guess"]->number();
}

//Kollar antalet försök varje reload
$tries = $_SESSION["guess"]->tries();

include("view/header.php");

//Skriv ut antalet försök
echo "<p class='tries'>You have <b> $tries </b> tries left</p>";

include("view/form.php");

//Meddelanden
echo "<div class='messages'>";

    //Visa rätt/fel
if (isset($_SESSION["answer"])) {
    echo $_SESSION["answer"];
}

//Fusk
echo "<div class='cheat'>";

if (isset($_SESSION["showsecretnumber"])) {
    echo "Here's your number you cheater: <b>" . $_SESSION["secretnumber"] . "</b>";
}

echo "</div>";
echo "</div>";

include("view/footer.php");


if (isset($_POST["restart-btn"])) {
    session_destroy();
} else if (isset($_POST["cheat-btn"])) {
    $_SESSION["showsecretnumber"] = true;
} else if (isset($_POST["guess-btn"])) {
    $number = $_POST["guess-input"];
    $_SESSION["answer"] = $_SESSION["guess"]->makeGuess($number);
}

require("view/debug_session_post-get.php");
