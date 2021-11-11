create table users(
    user_id serial not null unique ,
    mail varchar not null unique,
    pass varchar not null,
    name varchar,
    login varchar not null unique ,
    primary key (user_id)
);
create table news(
    article_id serial not null unique,
    title varchar,
    create_time timestamp default current_timestamp,
    author_id bigint not null,
    announcement varchar(200),
    full_text text,
    primary key (article_id),
    foreign key (author_id) references users (user_id)

)

