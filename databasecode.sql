CREATE TABLE todos (
  item_id int(11) AUTO_INCREMENT not null,
  content varchar(256) not null,
  creation_date timestamp not null default current_timestamp,
  primary key (item_id)
);

CREATE TABLE users (
  user_id int(11) AUTO_INCREMENT not null,
  user_firstname varchar(256) not null,
  user_lastname varchar(256) not null,
  user_email varchar(256) not null,
  user_password varchar(256) not null,
  primary key (user_id)
)

INSERT INTO todos (content)
     VALUES ('Cook Dinner');

INSERT INTO todos (content)
     VALUES ('Join Meeting');

INSERT INTO todos (content)
     VALUES ('Go Jogging');