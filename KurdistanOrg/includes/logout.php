<?php

// Destroy all the Sessions
session_start();
session_unset();
session_destroy();

header('Location: ../home.php?info=logoutsuccess');
exit();
