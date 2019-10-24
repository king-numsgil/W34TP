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

use dupe_store;
SET default_storage_engine=InnoDB;

create table users
(
    id         int auto_increment,
    first_name varchar(128) not null,
    last_name  varchar(128) not null,
    email      varchar(256) not null,
    password   varchar(128) not null,

    constraint users_pk
        primary key (id)
);

create unique index users_email_uindex
    on users (email);

create table duplicants
(
    id                int auto_increment,
    name              varchar(32)   not null,
    attr_construction int default 0 null,
    attr_excavation   int default 0 null,
    attr_machinery    int default 0 null,
    attr_athletics    int default 0 null,
    attr_science      int default 0 null,
    attr_cuisine      int default 0 null,
    attr_creativity   int default 0 null,
    attr_strength     int default 0 null,
    attr_medicine     int default 0 null,
    attr_agriculture  int default 0 null,
    attr_husbandry    int default 0 null,
    picture           varchar(32)   not null,

    constraint duplicants_pk
        primary key (id)
);

create table traits
(
    id          int auto_increment,
    title       varchar(64) not null,
    is_positive boolean     not null,
    description text        not null,

    constraint traits_pk
        primary key (id)
);

create unique index traits_title_uindex
    on traits (title);

create table duplicant_traits
(
	dupe_id int not null,
	trait_id int not null,

	constraint duplicant_traits_pk
		primary key (dupe_id, trait_id),

	constraint duplicant_traits___fk1
		foreign key (dupe_id) references duplicants (id),

	constraint duplicant_traits___fk2
		foreign key (trait_id) references traits (id)
);
