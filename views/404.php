<?php
$previous = "javascript:history.go(-1)";

if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

?>
<div class="centerDiv">
    <h1 class="title" style="font-family: roboto; font-weight: bold;">Congratulations !<br>You broke the internet...</h1>
    <button type="submit" class="sub" style="position:absolute;top:50%;left:50%;transform:translateX(-50%);"><a class="sub_text" href="'.$previous.'"><span>Go back</a></button>
</div>