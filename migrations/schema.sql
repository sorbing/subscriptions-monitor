CREATE SCHEMA subscriptions_monitor DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE subscriptions_monitor.users (
    id BIGINT AUTO_INCREMENT NOT NULL,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    is_confirmed TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    valid_ts INT(11) NULL,
    notified_at INT(11) NULL,
    PRIMARY KEY (id),
    UNIQUE INDEX users_email_index (email)
);

CREATE TABLE subscriptions_monitor.emails (
    id BIGINT AUTO_INCREMENT NOT NULL,
    email VARCHAR(50) NOT NULL,
    is_checked TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    is_valid TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    INDEX emails_email_index (email)
);
