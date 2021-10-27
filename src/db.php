<?php

$config = $GLOBALS['config'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

$GLOBALS['link'] = $link;
