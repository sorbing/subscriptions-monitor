<?php

// Скрипт стоит запускать как демон, вместо CRON (чтобы не возиться с lock-ами)

$config = $GLOBALS['config'];

$left_sec = $config['left_days'] * 3600;
$sql = "SELECT * FROM users WHERE is_confirmed = 1 AND notified_at IS NULL AND valid_ts <= (UNIX_TIMESTAMP() + {$left_sec}) LIMIT 20;";
$result = mysqli_query($GLOBALS['link'], $sql, MYSQLI_USE_RESULT);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}


foreach ($users as $user) {
    $email = $user['email'];

    echo "$email\n";

    if (check_email($email)) {
        $body = sprintf('%s, your subscription is expiring soon', $user['username']);
        send_email($config['email_from'], $email, $config['left_days_subject'], $body);
    }
}



