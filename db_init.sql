create table page_visits(
id INT NOT NULL AUTO_INCREMENT,
visitor_ip varchar(40) NOT NULL,
visit_time datetime NOT NULL,
author varchar(40) NOT NULL,
PRIMARY KEY (id));

create table page_form_commits(
id INT NOT NULL AUTO_INCREMENT,
visitor_name VARCHAR(40) NOT NULL,
visitor_email VARCHAR(40) NOT NULL,
page_visit_id INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (page_visit_id) REFERENCES page_visits(id));