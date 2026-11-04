<?php

require_once __DIR__ . '/../utils/autoloader.php';

use Auth\Session;

(new Session())->logout();

header('Location: index.php');
exit;
