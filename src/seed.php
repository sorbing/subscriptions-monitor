<?php

function seedUsers(int $count) {
    $random = str_repeat('abcdefghijklmnopqrstuvwxyz__', 4);

    for ($i = 0; $i <= $count; $i++) {
        $random = str_shuffle($random);
        $username = trim(substr($random, 0, 16), '_');

        $email = "$username@example.com";

        $is_confirmed = mt_rand(0, 1);

        $valid_ts = $notified_at = null;

        if ($is_confirmed && rand(0, 1)) {
            $r = mt_rand(-5, 10);
            $valid_ts = strtotime("$r day");
        }

        if ($is_confirmed && $valid_ts <= strtotime('+1 day') && rand(0, 1)) {
            $notified_at = strtotime("-2 day", $valid_ts);
        }

        $query = vsprintf("INSERT INTO users (username, email, is_confirmed, valid_ts, notified_at) VALUES ('%s', '%s', %d, %s, %s)", [
            $username,
            $email,
            $is_confirmed,
            $valid_ts ?? 'null',
            $notified_at ?? 'null'
        ]);
        mysqli_query($GLOBALS['link'], $query);

        if ($is_confirmed && $notified_at) {
            $query = vsprintf("INSERT INTO emails (email, is_checked, is_valid) VALUES ('%s', %d, %d)", [$email, 1, 1]);
            mysqli_query($GLOBALS['link'], $query);
        }
    }
}
