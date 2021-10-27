<?php

function check_email(string $email): int
{
    // @note Предполагаю, что `email` это кеширующая таблица.

    $sql = "SELECT * FROM emails WHERE email = '$email' ORDER BY id DESC;";
    $result = mysqli_query($GLOBALS['link'], $sql, MYSQLI_USE_RESULT);
    $row = mysqli_fetch_assoc($result);

    $is_valid = 0;

    if ($row && $row['is_checked']) {
        $is_valid = $row['is_valid'];
    } else {
        // @todo Send request to 3-party payable service
        sleep(mt_rand(1, 60));
        $is_valid = mt_rand(0, 1);

        $query = vsprintf("INSERT INTO emails (email, is_checked, is_valid) VALUES ('%s', %d, %d)", [$email, 1, $is_valid]);
        mysqli_query($GLOBALS['link'], $query);
    }

    return $is_valid;
}

function send_email($from, $to, $subj, $body): bool
{
    // Предполагаю, что ошибка в параметрах: ($email, $from, $to, ...)

    sleep(mt_rand(1, 10));

    // Ставим timestamp-метку после успешной отправки email.
    // После подписки метку затираем. Если подписку не продлили - можно повторно напомнить через какое-то время.
    mysqli_query($GLOBALS['link'], "UPDATE users SET notified_at = UNIX_TIMESTAMP() WHERE email = '$to' LIMIT 1");

    // @todo We throw in the queue.
    // @todo Handle errors & write log

    return true;
}
