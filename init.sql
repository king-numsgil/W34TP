DROP USER IF EXISTS 'dupe_store'@'localhost';
DROP DATABASE IF EXISTS dupe_store;

CREATE USER 'dupe_store'@'localhost' IDENTIFIED BY 'ewHE4eNuPikdxIxP';
GRANT USAGE ON *.* TO 'dupe_store'@'localhost';
CREATE DATABASE IF NOT EXISTS dupe_store;
GRANT ALL PRIVILEGES ON dupe_store.* TO 'dupe_store'@'localhost';
FLUSH PRIVILEGES;

use dupe_store;
SET default_storage_engine = InnoDB;

create table users
(
    id         int auto_increment,
    first_name varchar(128)       not null,
    last_name  varchar(128)       not null,
    email      varchar(256)       not null,
    password   varchar(128)       not null,
    is_admin   bool default false not null,

    constraint users_pk
        primary key (id)
);

create unique index users_email_uindex
    on users (email);

insert into users(first_name, last_name, email, password, is_admin)
VALUES ('Daniel', 'Grondin', 'king@numsgil.co', 'salut', true),
       ('Alexis', 'Lepine', 'exerapidoxthorn@gmail.com', 'P@ssw0rd', true),
       ('Joseph', 'Desjardins', 'jo_dej@gmail.com', 'salut', false);

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

insert into duplicants(name, attr_construction, attr_excavation, attr_machinery, attr_athletics, attr_science,
                       attr_cuisine, attr_creativity, attr_strength, attr_medicine, attr_agriculture, attr_husbandry,
                       picture, price)
VALUES ('Hannah', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'pics_test/01.png', 10),
       ('Judy', 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'pics_test/02.png', 14),
       ('Bobby', 0, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 'pics_test/03.png', 19),
       ('Gerald', 0, 0, 0, 5, 0, 0, 0, 0, 0, 0, 0, 'pics_test/04.png', 47),
       ('Troy', 0, 0, 0, 0, 5, 0, 0, 0, 0, 0, 0, 'pics_test/05.png', 2),

       ('Yeep', 0, 0, 3, 0, 0, 0, 3, 0, 0, 0, 0, 'pics_test/06.png', 25),
       ('Leia', 0, 7, 0, 0, 0, 0, 7, 0, 0, 0, 0, 'pics_test/07.png', 68),
       ('Daniel', 0, 0, 0, -5, 7, 0, 0, 0, 0, 0, 0, 'pics_test/08.png', 30),
	   ('Annie', 0, 0, 4, 0, 0, 0, 0, 1, 0, 0, 0, 'pics_test/09.png', 12),
	   ('Felix', 0, 0, 7, 0, 0, 0, -2, 0, 0, 0, 2, 'pics_test/10.png', 35),

	   ('Mitaku', 0, 0, 0, 0, 0, 0, 10, -5, 0, 0, 0, 'pics_test/11.png', 81),
	   ('Jeremia', 0, 6, 0, 0, 0, 6, 0, 0, 0, 0, 0, 'pics_test/12.png', 13),
	   ('Penelope', 0, 0, 0, 10, 0, 10, 0, 0, 0, 0, 0, 'pics_test/13.png', 74),
	   ('Elsa', 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'pics_test/14.png', 57),
	   ('Dandr Fumperdink', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'pics_test/15.png', 420),

	   ('Dr Moopiepoof', 0, 0, 0, -2, 0, 0, 0, 0, 8, 0, 0, 'pics_test/16.png', 29),
	   ('Alexis', 0, 0, 0, -3, 3, 0, 0, 0, 0, 0, 0, 'pics_test/17.png', 1),
	   ('Doodlepoofie', 0, 5, 0, 0, 0, 0, 0, 5, 0, 0, 0, 'pics_test/18.png', 30),
	   ('Snoogydumpy', 0, 0, 0, 0, 0, 7, 4, 0, 0, 1, 0, 'pics_test/19.png', 69),
	   ('Marc-Andre', 10, 10, 10, 10, 15, 10, 10, 10, 10, 10, 10, 'pics_test/20.png', 999),

	   ('Cutielove', 0, 0, 0, 0, 0, -5, 0, 0, 5, 0, 10, 'pics_test/21.png', 24),
	   ('Foofiepoof', 10, 3, -5, 0, 0, 0, 0, 3, 0, 0, 0, 'pics_test/22.png', 35),
	   ('Poofiewuggy', 0, 5, 0, -5, 0, 0, 0, 5, 0, 0, 0, 'pics_test/23.png', 35),
	   ('Shnookumschooglips', 0, 0, 0, 0, 0, 0, 7, 0, 0, 7, 0, 'pics_test/24.png', 7),
	   ('Wooglecute', 0, 0, 0, 0, 0, -5, 10, 0, 0, 0, 0, 'pics_test/25.png', 44),

	   ('Jackflr', 0, 0, 10, 0, 5, 0, 0, 0, 0, 0, 0, 'pics_test/26.png', 76),
	   ('Munph', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'pics_test/27.png', 9.5),
	   ('Bonkface', 0, 0, 0, 0, 0, 4, 0, 4, 0, 4, 0, 'pics_test/28.png', 35),
	   ('Kloronfomph', 6, 5, 8, 7, 10, 2, 3, 1, 9, 4, 0, 'pics_test/04.png', 100),
	   ('Flulf', 0, 0, 0, 0, 0, 0, 5, 5, 0, 0, 5, 'pics_test/08.png', 29.75);

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

insert into traits(title, is_positive, description)
VALUES ('Bottomless Stomach', false, 'Decreased <b>Callories</b>'),
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
       ('Interior Decorator', true, 'Increased <b>Creativity</b><br/>Decreased <b>Decor Morale Bonus</b>'),
       ('Uncultured', true, 'Increased <b>Decor Morale Bonus</b><br/>Cannot do <b>Decorating Errands</b>'),
       ('Mouth Breather', false, 'Increased <b>Air Consumption Rate</b>'),
       ('Irritable Bowel', false, 'Decreased <b>Bathroom Use Speed</b>'), /*25*/
	   ('Godlike', true, 'Increased <b>Handsomeness</b><br/>Boosts <b>Morale</b> for other Duplicants'),
	   ('Mortal', false, 'Still vulnerable to <b>Death</b><br/>Has basic needs');

create table duplicant_traits
(
    dupe_id  int not null,
    trait_id int not null,

    constraint duplicant_traits_pk
        primary key (dupe_id, trait_id),

    constraint duplicant_traits___fk1
        foreign key (dupe_id) references duplicants (id),

    constraint duplicant_traits___fk2
        foreign key (trait_id) references traits (id)
);

insert into duplicant_traits(dupe_id, trait_id)
VALUES (1, 1), (1, 2),
       (2, 3), (2, 4),
       (3, 5), (3, 6),
       (4, 19), (4, 15),
       (5, 14), (5, 11),
       (6, 13), (6, 8),
       (7, 17), (7, 22), (7, 4),
       (8, 11), (8, 20),
	   (15, 11), (15, 18),
	   (20, 26), (20, 27);
