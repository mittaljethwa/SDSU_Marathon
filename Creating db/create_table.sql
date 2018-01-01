use jadrn020;

drop table if exists runner;

create table runner(
    id int AUTO_INCREMENT PRIMARY KEY,
    fname varchar(50) NOT NULL,
	mname varchar(50) NULL,
	lname varchar(50) NOT NULL,
    address1 varchar(100) NOT NULL,
    address2 varchar(100) NULL,
    city varchar(30) NOT NULL,
    state char(2) NOT NULL,
    zip char(5) NOT NULL,
    email varchar(50) NOT NULL,
    phone varchar(10) NOT NULL,
    dob date NOT NULL,
    gender varchar(10) NOT NULL,
    category VARCHAR(20) NOT NULL,
    med_conditions VARCHAR(2000) NULL,
    exp_level VARCHAR(20) NOT NULL,
    img_path VARCHAR(1000) NOT NULL
    ); 

INSERT INTO runner VALUES (0,'Mittal',NULL,'Jethwa','12 Main Street',NULL,'San Diego','CA','92115','mittal@gmail.com','1234567890','1993-03-08','Female','Adult',NULL,'Experienced','uploaded_images/1.jpg');
INSERT INTO runner VALUES (0,'Madhuri',NULL,'Dhodi','123 M Street',NULL,'San Diego','CA','92115','mdhodi@gmail.com','1234353434','1996-02-07','Female','Adult',NULL,'Novice','uploaded_images/2.jpg');
INSERT INTO runner VALUES (0,'Robert',NULL,'Jones','1252 Abbott St','21','San Diego','CA','92121','abc@gmail.com','2323232323','2003-02-01','Male','Teen','Asthama','Novice','uploaded_images/3.jpg');
INSERT INTO runner(fname,mname,lname,address1,address2,city,state,zip,email,phone,dob,gender,category,med_conditions,exp_level,img_path) VALUES('Mittal','','Jethwa','My Street','123','San Diego','CA','92115','mittaljethwa9383@gmail.com','6196840258','19930803','female','Adult','','Experienced','uploaded_images/4.jpg');  
/* 
INSERT INTO person VALUES(0,'Jim',NULL,'Robeson','3456 30th St','San Diego','CA','92104','jrobeson@yahoo.com');    
INSERT INTO person VALUES(0,'Robert Jones','1512 Abbott St','San Diego','CA','92106','rjones@gmail.com');
INSERT INTO person VALUES(0,'Henry Carter','914 Albion St','San Diego','CA','92106','hcarter@yahoo.com');
INSERT INTO person VALUES(0,'Jason Johnson','225 7th St','San Diego','CA','92103','jjson@gmail.com');
INSERT INTO person VALUES(0,'Sarah Joseph','9339 Via Rapida St','San Diego','CA','92101','sjoseph22@yahoo.com');
INSERT INTO person VALUES(0,'Bill Krump','1445 Camino Del Rio','San Diego','CA','92108','bkrmp@gmail.com');
INSERT INTO person VALUES(0,'Matt Mathison','887 10 St','San Diego','CA','92101','mmathison12@gmail.com');
INSERT INTO person VALUES(0,'Sam Stevens','6782 Ivy St','San Diego','CA','92103','sam.stevens@gmail.com');
INSERT INTO person VALUES(0,'Jerome Jacobs','5354 Maple St','San Diego','CA','92103','jjacobs@mail.sdsu.edu');
INSERT INTO person VALUES(0,'Adam Selig','3634 7th Ave','San Diego','CA','92103','superstar156@yahoo.com');
INSERT INTO person VALUES(0,'Sally Reese','2910 Market St','San Diego','CA','92101','sallyR@cox.net');
*/


