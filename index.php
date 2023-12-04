<?php

include __DIR__ . '/Views/header.php';
include __DIR__ . '/Model/Movie.php';

?>

<main class="container">
    <div class="row gy-5">
        <?php
        foreach ($movies as $movie) {
            $movie->printCard();
        } ?>
    </div>
</main>

</body>

</html>