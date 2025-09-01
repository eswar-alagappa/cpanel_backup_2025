create table users (	
	id bigint primary key auto_increment,
	username varchar(60) default '',
	password varchar(60) default '',
	role int default 0,
	first_name varchar(60) default '',
	last_name varchar(60) default '',
	roll_num varchar(15) default '',
	date_of_birth datetime,
	date_of_joining datetime,
	father_name varchar(60) default '',
	spouse_name varchar(60) default '',
	address text default '', 
	residential_address text default '', 
	pincode varchar(7) default '',
	city varchar(60) default '',
	state varchar(60) default '',
	country varchar(60) default '',
	phone varchar(15) default '',
	email_id varchar(125) default '', 
	course_id bigint default 0, 
	date_of_joining datetime,
	qualification varchar(25) default '', 
	designation varchar(60), 
	subject_taken varchar(60), 
	department_handling varchar(60), 
	employeed_experience float(5,2), 
	gender varchar(6), 
	martial_status varchar(10), 
	status int default 1,
	image_url varchar(125) default '', 
	community varchar(60),
	nationality varchar(25),
	book_issued_date datetime,
	id_card_issued_date datetime,
	highest_qualification varchar(25) default '',
	medium varchar(10) default '',
	university varchar(25) default '',
	fees float(15,2) default 0,
	semester varchar(15) default '',
	duration float(5,1) default 0.0,
	is_activated int default 0,
	verification_code varchar(60) default '',

	created_at datetime,
	updated_at datetime,
	updated_by varchar(15)
);


create table course (	
	id bigint primary key auto_increment,
	name text default '',
	fees float(15,2) default 0,
	semester varchar(15) default '',
	graduate varchar(2) default '',
	duration float(5,1) default 0.0,
	university varchar(25) default '',
	medium varchar(10) default '',
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15),
	status int default 1
);

create table semester (	
	id bigint primary key auto_increment,
	name text default '',
	fees float(15,2) default 0,
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15),
	status int default 1
);

create table subject (	
	id bigint primary key auto_increment,
	name text default '',
	code varchar(10) default '',
	course_id bigint default 0,
	semester_id bigint default 0,
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15),
	status int default 1
);

create table fee_type (	
	id bigint primary key auto_increment,
	name varchar(60) default '',
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15),
	status int default 1
);

create table settings (			
	key_name	varchar(125) default '',
	key_value	text default '',
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15)
);

create table latest_news (			
	id bigint primary key auto_increment,
	name	text default '',
	title	text default '',
	description	text default '',
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15)
);

create table gallery (			
	id bigint primary key auto_increment,
	title	text default '',
	description	text default '',
	image_url varchar(15) default '',
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15)
);

create table slider (			
	id bigint primary key auto_increment,
	title	text default '',
	description	text default '',
	image_url varchar(15) default '',
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15)
);

create table payment (			
	id bigint primary key auto_increment,
	date datetime,
	student_id bigint,
	fee_type_id	bigint default 0,
	course_id	bigint default 0,
	old_semester_id bigint default 0,
	semester_id	bigint default 0,
	received_amount float(15,2) default 0,
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15)
);

create table fee_details (			
	id bigint primary key auto_increment,
	course_id	bigint default 0,
	semester_id	bigint default 0,
	fee_type_id	bigint default 0,
	fees float(15,2) default 0,
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15)
);


create table exam_notification (			
	id bigint primary key auto_increment,
	graduate varchar(5) default '',
	apply_date datetime,
	last_date datetime,
	penalty float(10,2) default 0.0,
	fees float(10,2) default 0.0,
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15)
);

create table exam_venue (			
	id bigint primary key auto_increment,
	graduate varchar(5) default '',
	semester_id bigint default 0,
	session_start varchar(10) default '',
	session_end  varchar(10) default '',
	address text default '',
	area varchar(60) default '',
	city varchar(60) default '',
	pin varchar(8) default '',
	landmark varchar(60) default '',
	google_map text default '',
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15)
);

create table student_semester (			
	id bigint primary key auto_increment,
	user_id bigint default 0,
	semester_id bigint default 0,
	course_id bigint default 0,
	fees_total float(12,2) default 0,
	fees_received float(12,2) default 0,
	created_at datetime,
	updated_at datetime,
	updated_by varchar(15)
);


----------------------------------------------------------------
alter table users add verification_code varchar(60) default '';
ALTER TABLE users CHANGE username username VARCHAR(60) DEFAULT '';
alter table users add residential_address text default '';
alter table users add semester_joining_id int default 1;
alter table payment add old_semester_id bigint default 0;

-------------------------------------------------


insert into users (role, username, password, first_name, last_name, email_id, image_url) 
	values (1, 'admin', md5('admin123'), 'Admin', '', 'rrishwanth78+admin@gmail.com', 'photo1.gif');

insert into users (role, username, password, first_name, last_name, email_id, image_url) 
	values (2, 'staff', md5('admin123'), 'Staff', '', 'rrishwanth78+staff@gmail.com', 'photo1.gif');
---------------------
alter table mcks add welcome varchar(7) default '';


	





