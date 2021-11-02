insert into users(mail, pass, name, login) values ('kazachkov99k@niuitmo.ru','123','Кирилл','kazachkov99k');
insert into news(title, create_time, author_id, announcement, full_text)
values ('test_title', current_date, (select user_id from users where login = 'kazachkov99k'), 'Аннотация к статье номер 1', 'lorem ipsum' );
insert into news(title, create_time, author_id, announcement, full_text)
values ('so tasty title', current_date, (select user_id from users where login = 'kazachkov99k'), 'Аннотация к статье номер 2', 'lorem ipsumets' );
