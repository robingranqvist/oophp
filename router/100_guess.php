<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the session for the gamestart
    
    //Skapa guess-objekt & hemligt nummer
    $_SESSION["guess"] = new Robn\Guess\Guess();
    $_SESSION["guess"]->random();
    
    return $app->response->redirect("guess/play");
});



/**
 * Play the game
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";
    
    //Kollar antalet försök
    $tries = $_SESSION["guess"]->tries();
    $triesText = "You have <b> $tries </b> tries left";

    $data = [
        "tries" => $triesText,
        "answer" => null,
        "secret" => null,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Post
 */
$app->router->post("guess/form", function () use ($app) {
    $title = "Play the game";
    
    $answer = null;
    $secret = null;

    //Restart
    if (isset($_POST["restart-btn"])) {
        return $app->response->redirect("guess/init");
    } else if (isset($_POST["cheat-btn"])) {
        $secret = $_SESSION["guess"]->number();
    } else if (isset($_POST["guess-btn"])) {
        $number = $_POST["guess-input"];
        $answer = $_SESSION["guess"]->makeGuess($number);
    }

    $tries = $_SESSION["guess"]->tries();
    $triesText = "You have <b> $tries </b> tries left";

    $data = [
        "tries" => $triesText,
        "answer" => $answer,
        "secret" => $secret,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
