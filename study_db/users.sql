create table study_db.users
(
    id     int auto_increment
        primary key,
    name   varchar(255) null,
    email  varchar(255) null,
    gender int          null,
    avatar varchar(255) null
)
    collate = utf8mb3_unicode_ci;

