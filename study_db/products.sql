create table study_db.products
(
    id    int auto_increment
        primary key,
    name  varchar(255) null,
    price int          null,
    image varchar(255) null
)
    collate = utf8mb3_unicode_ci;

