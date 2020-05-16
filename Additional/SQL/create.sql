CREATE TABLE `heroku_dd67cd94965d526`.`users`(
id int NOT NULL AUTO_INCREMENT,
username VARCHAR(20),
password VARCHAR(40),
continent VARCHAR(20),
status VARCHAR(20),
PRIMARY KEY (id)
);


CREATE TABLE `heroku_dd67cd94965d526`.`scores` (
user_id int ,
traffic_score int,
internet_score int,
job_score int,
table_score int,
church_score int,
bus_score int,
FOREIGN KEY (user_id) REFERENCES `heroku_dd67cd94965d526`.`users` (id)
);