-- DOCTORS
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Ramesh M","M",45,"DOCTOR",65000,1111111111);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Ramya G","F",47,"DOCTOR",70000,2222222222);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("James P","M",38,"DOCTOR",60000,3333333333);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Kavya S","F",55,"DOCTOR",80000,4444444444);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Rajesh K","M",53,"DOCTOR",75000,5555555555);
-- NURSES
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Suresh K","M",27,"NURSE",50000,1111122222);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("John D","M",39,"NURSE",50000,3333344444);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Jackson M","M",41,"NURSE",50000,5555566666);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Mary B","F",35,"NURSE",50000,7777788888);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Samantha O","F",29,"NURSE",50000,9999911111);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Shreya T","F",43,"NURSE",50000,2222233333);
-- HOUSEKEEPING
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Ramesh","M",37,"HKeeping",40000,123456789);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Ramesh","F",32,"HKeeping",40000,123456789);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Ramesh","F",35,"HKeeping",40000,123456789);
-- RECEPTIONISTS
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Jennifer P","F",32,"Recep",45000,123456789);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES("Bob M","M",29,"Recep",45000,123456789);

-- PATIENTS
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("John Doe","M",26,1234554321,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Jane Doe","F",25,1234554322,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Joseph S","M",48,1234554323,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Elizabeth H","F",63,1234554324,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Raju Ghosh","M",12,1234554325,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Ramya Sait","F",19,1234554326,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Jagdish Das","M",37,1234554327,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Kavita Ram","F",22,1234554328,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Sanjana Sham","F",41,1234554329,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Sanjay Shetty","M",39,1234554311,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Supriya Singh","F",10,1234554331,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Lokesh R","M",23,1234554341,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Molly Jane","F",46,1234554351,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Sam Joe","M",52,1234554361,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Rachel James","F",63,1234554371,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Sander Colnel","M",71,1234554381,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Alexa A","F",19,1234554391,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Donald Ronald","M",19,1234554121,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Siri A","F",26,1234554221,"15-03-2019");
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES("Steve Smith","M",37,1234554421,"15-03-2019");

-- DOCTOR TABLE
INSERT INTO Doctor(emp_id) SELECT emp_id FROM hospital_employee WHERE emp_type="DOCTOR";
-- NURSE TABLE
INSERT INTO NURSE(emp_id) SELECT emp_id FROM hospital_employee WHERE emp_type="NURSE";
-- RECEPTIONIST TABLE
INSERT INTO receptionist(emp_id) SELECT emp_id FROM hospital_employee WHERE emp_type="Recep";
-- HOUSEKEEPING TABLE
INSERT INTO housekeeping(emp_id) SELECT emp_id FROM hospital_employee WHERE emp_type="HKeeping";

-- ROOMS table
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(2500,"Ward");
INSERT INTO rooms(cost,room_type,status) VALUES(8500,"ICU");
INSERT INTO rooms(cost,room_type,status) VALUES(8500,"ICU");
INSERT INTO rooms(cost,room_type,status) VALUES(8500,"ICU");
INSERT INTO rooms(cost,room_type,status) VALUES(8500,"ICU");
INSERT INTO rooms(cost,room_type,status) VALUES(8500,"ICU");
INSERT INTO rooms(cost,room_type,status) VALUES(8500,"ICU");

-- 
-- 
--QUERIES INSERTING USING FORMS FROM WEBPAGE
-- 
-- 

-- ADDING NEW EMPLOYEES--
--HOSPITAL_EMPLOYEE table(query used to insert into table from form)
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES(emp_name,gen_der,age,job_desc,sal,ph_no);
--EMP_ADDRESS table (query used to insert from form)
SELECT emp_id FROM hospital_employee WHERE employee_name=emp_name 
INSERT INTO emp_address(house_no,street,area,city,emp_id) VALUES(h_no,st_name,ar_code,city_name,emp_id);
--depending on job desc one of the following queries will be called
INSERT INTO Doctor(emp_id) SELECT emp_id FROM hospital_employee WHERE employee_name=emp_name;
INSERT INTO Nurse(emp_id) SELECT emp_id FROM hospital_employee WHERE employee_name=emp_name;
INSERT INTO receptionist(emp_id) SELECT emp_id FROM hospital_employee WHERE employee_name=emp_name;
INSERT INTO housekeeping(emp_id) SELECT emp_id FROM hospital_employee WHERE employee_name=emp_name;

--UPDATING EMPLOYEE TABLE--
UPDATE hospital_employee SET salary=sal WHERE employee_id=emp_id;

-- CREATING(ADDING)/UPDATING/DELETING NEW ROOMS--
-- rooms table(query used to insert into table from form)
INSERT INTO rooms(cost,room_type) VALUES(price,r_type);
-- update room prices(query used to update room price)
UPDATE rooms SET cost=price WHERE room_no=r_id;
-- remove/deleting a room
DELETE FROM rooms WHERE room_no=r_id;