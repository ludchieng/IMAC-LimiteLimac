<?php
    header('HTTP/1.1 404 Not Found');
?>
<div class="centered">
    <h1 class="title" style="font-family: roboto; font-weight: bold;">
        Congratulations !<br> ou broke the internet...
    </h1>
    <button type="submit" class="sub" style="position:absolute;top:50%;left:50%;transform:translateX(-50%);">
        <a class="sub_text" href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>">
            <span>Go back</span>
        </a>
    </button>
</div>