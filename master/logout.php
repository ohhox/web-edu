<?php

setcookie('userid', $userInformation->user_id, -time() + (3600 * 24));
header("Location: login.php");
