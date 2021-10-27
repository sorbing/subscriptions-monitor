<?php

$help = "
Usage as:
<code>php public/script.php seed</code>
<code>php public/script.php check</code>
Or:
<p>http://localhost/script.php?action=seed</p>
<p>http://localhost/script.php?action=check</p>
";

if (php_sapi_name() === 'cli') {
    $help = trim(strip_tags($help));
} else {
    $help = preg_replace('/\n/', '<br>', $help);
}

echo $help . "\n";
