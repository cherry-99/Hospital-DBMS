-- NURSES
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Suresh K', 'M', 27, 'NURSE', 50000, 1111122222);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('John D', 'M', 39, 'NURSE', 50000, 3333344444);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Jackson M', 'M', 41, 'NURSE', 50000, 5555566666);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Mary B', 'F', 35, 'NURSE', 50000, 7777788888);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Samantha O', 'F', 29, 'NURSE', 50000, 9999911111);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Shreya T', 'F', 43, 'NURSE', 50000, 2222233333);
-- DOCTORS
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Ramesh M', 'M', 45, 'DOCTOR', 65000, 1111111111);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Ramya G', 'F', 47, 'DOCTOR', 70000, 2222222222);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('James P', 'M', 38, 'DOCTOR', 60000, 3333333333);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Kavya S', 'F', 55, 'DOCTOR', 80000, 4444444444);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Rajesh K', 'M', 53, 'DOCTOR', 75000, 5555555555);
-- HOUSEKEEPING
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Ramesh', 'M', 37, 'HOUSEKEEPING', 40000, 123666789);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Ramesh', 'F', 32, 'HOUSEKEEPING', 40000, 123776789);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Ramesh', 'F', 35, 'HOUSEKEEPING', 40000, 123886789);
-- RECEPTIONISTS
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Jennifer P', 'F', 32, 'RECEPTIONIST', 45000, 123996789);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Bob M', 'M', 29, 'RECEPTIONIST', 45000, 123456789);

-- employee_login table insert
INSERT INTO employee_login(emp_id,password) SELECT emp_id,emp_id from hospital_employee where emp_type='DOCTOR';
INSERT INTO employee_login(emp_id,password) SELECT emp_id,emp_id from hospital_employee where emp_type='NURSE';
INSERT INTO employee_login(emp_id,password) SELECT emp_id,emp_id from hospital_employee where emp_type='RECEPTIONIST';

-- DOCTOR TABLE
INSERT INTO Doctor(emp_id) SELECT emp_id FROM hospital_employee WHERE emp_type='DOCTOR';
-- NURSE TABLE
INSERT INTO NURSE(emp_id) SELECT emp_id FROM hospital_employee WHERE emp_type='NURSE';
-- RECEPTIONIST TABLE
INSERT INTO receptionist(emp_id) SELECT emp_id FROM hospital_employee WHERE emp_type='RECEPTIONIST';
-- HOUSEKEEPING TABLE
INSERT INTO housekeeping(emp_id) SELECT emp_id FROM hospital_employee WHERE emp_type='HOUSEKEEPING';

-- insert patients
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('John Doe', 'M', '1996-04-27', 1234554321, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Jane Doe', 'F', '1997-04-27', 1234554322, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Joseph S', 'M', '1998-04-27', 1234554323, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Elizabeth H', 'F', '1999-04-27', 1234554324, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Raju Ghosh', 'M', '1986-04-27', 1234554325, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Ramya Sait', 'F', '1976-04-27', 1234554326, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Jagdish Das', 'M', '1976-04-27', 1234554327, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Kavita Ram', 'F', '1986-04-27', 1234554328, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Sanjana Sham', 'F', '1992-04-27', 1234554329, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Sanjay Shetty', 'M', '1991-04-27', 1234554311, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Supriya Singh', 'F', '1998-04-27', 1234554331, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Lokesh R', 'M', '1994-04-27', 1234554341, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Molly Jane', 'F', '1999-04-27', 1234554351, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Sam Joe', 'M', '1993-04-27', 1234554361, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Rachel James', 'F', '1995-04-27', 1234554371, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Sander Colnel', 'M', '1997-04-27', 1234554381, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Alexa A', 'F', '1999-04-27', 1234554391, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Donald Ronald', 'M', '1991-04-27', 1234554121, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Siri A', 'F', '1976-04-27', 1234554221, '2019-03-15');
INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES('Steve Smith', 'M', '1974-04-27', 1234554421, '2019-03-15');

-- patient login
INSERT INTO patient_login(pat_id,password) SELECT pat_id,pat_id from patient;

-- rooms
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(2500, 'Ward');
INSERT INTO rooms(cost,room_type) VALUES(8500, 'ICU');
INSERT INTO rooms(cost,room_type) VALUES(8500, 'ICU');
INSERT INTO rooms(cost,room_type) VALUES(8500, 'ICU');
INSERT INTO rooms(cost,room_type) VALUES(8500, 'ICU');
INSERT INTO rooms(cost,room_type) VALUES(8500, 'ICU');
INSERT INTO rooms(cost,room_type) VALUES(8500, 'ICU');

-- inserting into treats database --
insert into treats(doc_id,pat_id) values (1,1),(1,2),(1,3),(1,4),(2,5),(2,6),(2,7),(2,8),(3,9),
                                         (3,10),(3,11),(3,12),(4,13),(4,14),(4,15),(4,16),(5,17),
                                         (5,18),(5,19),(5,20);

-- assign rooms to nurses and housekeeping
INSERT INTO room_incharge values (1,1,2),(2,2,1),(3,3,2),(4,4,1),(5,5,2),(6,6,1),(7,1,2),(8,2,1),(9,3,2),(10,4,1),(11,5,2),(12,6,1),(13,1,2),
                                 (14,2,1),(15,3,2),(16,4,1),(17,5,2),(18,6,1),(19,1,2),(20,2,1),(21,3,2),(22,4,1),(23,5,2),(24,6,1),(25,1,2),(26,2,1);

-- assign rooms to patients
INSERT INTO room_assigned VALUES (1, 1),(2, 2),(3, 3),(4, 4),(5, 5),(6, 6),(7, 7),(8, 8),(9, 9),(10, 10),(11, 11),(12, 12),
                                 (13, 13),(14, 14),(15, 15),(16, 16),(17, 17),(18, 18),(19, 19),(20,20);

-- insert medicines
insert into medicine_inventory(med_name,cost,quantity) values ('aaaaa',10,100);
insert into medicine_inventory(med_name,cost,quantity) values ('bbbbb',8,90);
insert into medicine_inventory(med_name,cost,quantity) values ('ccccc',9,80);
insert into medicine_inventory(med_name,cost,quantity) values ('ddddd',12,70);
insert into medicine_inventory(med_name,cost,quantity) values ('eeeee',15,60);
insert into medicine_inventory(med_name,cost,quantity) values ('aaaab',10,100);
insert into medicine_inventory(med_name,cost,quantity) values ('bbbbc',8,90);
insert into medicine_inventory(med_name,cost,quantity) values ('ccccd',9,80);
insert into medicine_inventory(med_name,cost,quantity) values ('dddde',12,70);
insert into medicine_inventory(med_name,cost,quantity) values ('eeeef',15,60);

-- update patient and set diagnosis
UPDATE patient SET diagnosis='dengue' WHERE pat_id=1;
UPDATE patient SET diagnosis='viral fever' WHERE pat_id=5;
UPDATE patient SET diagnosis='tubercolosis' WHERE pat_id=7;
UPDATE patient SET diagnosis='viral fever' WHERE pat_id=13;
UPDATE patient SET diagnosis='malaria' WHERE pat_id=20;
UPDATE patient SET diagnosis='dengue' WHERE pat_id=3;
UPDATE patient SET diagnosis='tubercolosis' WHERE pat_id=8;
UPDATE patient SET diagnosis='viral fever' WHERE pat_id=16;
UPDATE patient SET diagnosis='hypothyroidism' WHERE pat_id=18;
UPDATE patient SET diagnosis='viral fever' WHERE pat_id=11;
UPDATE patient SET diagnosis='hyperglycemia' WHERE pat_id=14;

-- insert pat_address
INSERT INTO emp_address VALUES (5,'25th Floor Palton Road','Mohatta Market','Mumbai',1);
INSERT INTO emp_address VALUES (25,'67 Mudalapalya','Nagarabhavi','Bangalore',2);
INSERT INTO emp_address VALUES (13,'Lamington Road','Grant Road','Mumbai',3);
INSERT INTO emp_address VALUES (45,'63th Flr Mittal Chambers', 'Nariman Point','Mumbai',4);
INSERT INTO emp_address VALUES (43,'320 , Vice Regal', 'Old Padra Road','Mumbai',5);
INSERT INTO emp_address VALUES (12,'Gr Flr, Dattpada Road', 'Borivali (east)','Mumbai',6);
INSERT INTO emp_address VALUES (76,'K G Marg','Connaught Place','Delhi',7);
INSERT INTO emp_address VALUES (26,'Ankit, Ambadi Rd','Vasai(w)','Mumbai',8);
INSERT INTO emp_address VALUES (22,'Bara Imam Rd','Mandvi','Mumbai',9);
INSERT INTO emp_address VALUES (96,'Bombay Samachar Marg','Hutatma Chowk','Mumbai',10);
INSERT INTO emp_address VALUES (34,'Kusumkala Apt, Sai Baba Nagar', 'Borivali (west)','Mumbai',11);
INSERT INTO emp_address VALUES (31,'Sandhya Nagar Society', 'Vishwamitri Road','Vadodara',12);
INSERT INTO emp_address VALUES (61,'Satyam Bldg, Shiv Mandir Road', 'Ramnagar, Dombivli (east)','Mumbai',13);
INSERT INTO emp_address VALUES (18,'Mithakali Six Road', 'Navrangpura','Ahmedabad',14);
INSERT INTO emp_address VALUES (28,'Arun Bazar, S.v.road', 'Nr.bank Of India, Malad(w)','Mumbai',15);
INSERT INTO emp_address VALUES (38,'5th Main Traveni', 'Yeshwanthpur','Bangalore',16);


--  pat_address

INSERT INTO pat_address VALUES (5,'25th Floor Palton Road','Mohatta Market','Mumbai',1);
INSERT INTO pat_address VALUES (25,'67 Mudalapalya','Nagarabhavi','Bangalore',2);
INSERT INTO pat_address VALUES (13,'Lamington Road','Grant Road','Mumbai',3);
INSERT INTO pat_address VALUES (45,'63th Flr Mittal Chambers', 'Nariman Point','Mumbai',4);
INSERT INTO pat_address VALUES (43,'320 , Vice Regal', 'Old Padra Road','Mumbai',5);
INSERT INTO pat_address VALUES (12,'Gr Flr, Dattpada Road', 'Borivali (east)','Mumbai',6);
INSERT INTO pat_address VALUES (76,'K G Marg','Connaught Place','Delhi',7);
INSERT INTO pat_address VALUES (26,'Ankit, Ambadi Rd','Vasai(w)','Mumbai',8);
INSERT INTO pat_address VALUES (22,'Bara Imam Rd','Mandvi','Mumbai',9);
INSERT INTO pat_address VALUES (96,'Bombay Samachar Marg','Hutatma Chowk','Mumbai',10);
INSERT INTO pat_address VALUES (34,'Kusumkala Apt, Sai Baba Nagar', 'Borivali (west)','Mumbai',11);
INSERT INTO pat_address VALUES (31,'Sandhya Nagar Society', 'Vishwamitri Road','Vadodara',12);
INSERT INTO pat_address VALUES (61,'Satyam Bldg, Shiv Mandir Road', 'Ramnagar, Dombivli (east)','Mumbai',13);
INSERT INTO pat_address VALUES (18,'Mithakali Six Road', 'Navrangpura','Ahmedabad',14);
INSERT INTO pat_address VALUES (28,'Arun Bazar, S.v.road', 'Nr.bank Of India, Malad(w)','Mumbai',15);
INSERT INTO pat_address VALUES (38,'5th Main Traveni', 'Yeshwanthpur','Bangalore',16);
