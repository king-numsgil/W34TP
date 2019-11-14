DROP USER IF EXISTS 'dupe_store'@'localhost';
DROP DATABASE IF EXISTS dupe_store;

CREATE USER 'dupe_store'@'localhost' IDENTIFIED BY 'ewHE4eNuPikdxIxP';
GRANT USAGE ON *.* TO 'dupe_store'@'localhost';
CREATE DATABASE IF NOT EXISTS dupe_store;
GRANT ALL PRIVILEGES ON dupe_store.* TO 'dupe_store'@'localhost';
FLUSH PRIVILEGES;

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

insert into users(first_name, last_name, email, password) VALUES
    ('Daniel', 'Grondin', 'king@numsgil.co', 'salut'),
    ('Alexis', 'Lepine', 'exerapidoxthorn@gmail.com', 'P@ssw0rd');

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
	price             float         not null,

    constraint duplicants_pk
        primary key (id)
);

insert into duplicants(name, attr_construction, attr_excavation, attr_machinery, attr_athletics, attr_science, attr_cuisine, attr_creativity, attr_strength, attr_medicine, attr_agriculture, attr_husbandry, picture, price) VALUES
    ('Hannah', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'pics_test/01.png', 10),
    ('Judy', 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'pics_test/02.png', 14),
    ('Bobby', 0, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 'pics_test/03.png', 19),
    ('Gerald', 0, 0, 0, 5, 0, 0, 0, 0, 0, 0, 0, 'pics_test/04.png', 47),
    ('Troy', 0, 0, 0, 0, 5, 0, 0, 0, 0, 0, 0, 'pics_test/05.png', 2),
    ('Yeep', 0, 0, 3, 0, 0, 0, 3, 0, 0, 0, 0, 'pics_test/06.png', 25),
    ('Leia',0,7,0,0,0,0,7,0,0,0,0,'pics_test/07.png',68);

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

insert into traits(title, is_positive, description) VALUES
    ('Bottomless Stomach', false, 'Decreased <b>Callories</b>'),
    ('Night Owl', true, 'Gains nighttime Attribute bonuses'),
    ('Gourmet', true, 'Increased <b>Cuisine</b><br/>Decreased <b>Food Morale Bonus</b>'),
    ('Loud Sleeper', false, 'Snores loudly'),
    ('Diver\'s Lung', true, 'Decreased <b>Air Consumption Rate</b>'),/*5*/
    ('Allergies', false, 'Allergic reaction to Floral Scent'),
    ('Early Bird', true, 'Gains morning Attribute bonuses'),
    ('Flatulent', false, 'Farts frequently'),
    ('Yokel', false, 'Cannot do <b>Researching Errands</b>'),
    ('Biohazardous', false, 'Decreased <b>Germ Resistance</b>'),/*10*/
    ('Quick Learner', true, 'Increased <b>Science</b>'),
    ('Caregiver', true, 'Increased <b>Medicine</b>'),
    ('Grease Monkey', true, 'Increased <b>Machinery</b>'),
    ('Narcoleptic', false, 'Falls asleep periodically'),
    ('Iron Gut', true, 'Immune to <b>Food Poisoning</b>'),/*15*/
    ('Gastrophobia', false, 'Cannot do <b>Cooking Errands</b>'),
    ('Mole Hands', true, 'Increased <b>Excavation</b>'),
    ('Small Bladder', false, 'Increased <b>Bladder</b>'),
    ('Squeamish', false, 'Cannot do <b>Doctoring Errands</b>'),
    ('Anemic', false, 'Decreased <b>Athletics</b>'), /*20*/
    ('Buff', true, 'Increased <b>Strength</b>'),
    ('Interior Decorator', true, 'Increased <b>Creativity</b><br/>Decreased <b>Decor Morale Bonus</b>');

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

insert into duplicant_traits(dupe_id, trait_id) VALUES
    (1, 1), (1, 2),
    (2, 3), (2, 4),
    (3, 5), (3, 6),
    (4, 19), (4, 15),
    (5, 14), (5, 11),
    (7,17), (7, 22);
