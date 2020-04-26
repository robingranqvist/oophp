<?php

namespace Robn\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1 class="h1-guess">Play the game</h1>

<p class="p-guess"><?= $tries ?></p>

<p class="p-guess"><?= $secret ?></p>

<p class="p-guess"><?= $answer ?></p>

<form method="post" autocomplete="off" action="form">
    <input type="text" name="guess-input" placeholder="Write your guess here..." class="guess-input">
    <div class="buttons">
        <button name="guess-btn" class="btn">Make a guess</button>
        <button name="restart-btn" class="btn btn-2">Start from beginning</button>
        <button name="cheat-btn" class="btn">Cheat</button>
    </div>
</form>