CREATE TABLE todos (
  item_id int(11) IDENTITY PRIMARY KEY not null,
  content varchar(256) not null
);

INSERT INTO todos (content)
     VALUES ('Cook Dinner');

INSERT INTO todos (content)
     VALUES ('Join Meeting');

INSERT INTO todos (content)
     VALUES ('Go Jogging');