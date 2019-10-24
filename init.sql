DROP USER IF EXISTS 'dupe_store'@'localhost';
DROP DATABASE IF EXISTS dupe_store;

CREATE USER 'dupe_store'@'localhost' IDENTIFIED WITH mysql_native_password AS 'ewHE4eNuPikdxIxP';
GRANT USAGE ON *.* TO 'dupe_store'@'localhost' REQUIRE NONE WITH
    MAX_QUERIES_PER_HOUR 0
    MAX_CONNECTIONS_PER_HOUR 0
    MAX_UPDATES_PER_HOUR 0
    MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS dupe_store;
GRANT ALL PRIVILEGES ON dupe_store.* TO 'dupe_store'@'localhost';
