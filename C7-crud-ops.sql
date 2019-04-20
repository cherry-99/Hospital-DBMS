-- CRUD OPERATIONS --

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
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Ramesh', 'M', 37, 'HKeeping', 40000, 123666789);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Ramesh', 'F', 32, 'HKeeping', 40000, 123776789);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Ramesh', 'F', 35, 'HKeeping', 40000, 123886789);
-- RECEPTIONISTS
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Jennifer P', 'F', 32, 'Recep', 45000, 123996789);
INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) VALUES('Bob M', 'M', 29, 'Recep', 45000, 123456789);

-- PATIENTS
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('John Doe', 'M', 26, 1234554321, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Jane Doe', 'F', 25, 1234554322, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Joseph S', 'M', 48, 1234554323, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Elizabeth H', 'F', 63, 1234554324, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Raju Ghosh', 'M', 12, 1234554325, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Ramya Sait', 'F', 19, 1234554326, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Jagdish Das', 'M', 37, 1234554327, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Kavita Ram', 'F', 22, 1234554328, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Sanjana Sham', 'F', 41, 1234554329, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Sanjay Shetty', 'M', 39, 1234554311, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Supriya Singh', 'F', 10, 1234554331, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Lokesh R', 'M', 23, 1234554341, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Molly Jane', 'F', 46, 1234554351, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Sam Joe', 'M', 52, 1234554361, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Rachel James', 'F', 63, 1234554371, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Sander Colnel', 'M', 71, 1234554381, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Alexa A', 'F', 19, 1234554391, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Donald Ronald', 'M', 19, 1234554121, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Siri A', 'F', 26, 1234554221, '2019-03-15');
INSERT INTO patient(pat_name,gender,age,contact_no,admit_date) VALUES('Steve Smith', 'M', 37, 1234554421, '2019-03-15');

-- DOCTOR TABLE
INSERT INTO Doctor(em1) SELECT em1 FROM hospital_employee WHERE emp_type='DOCTOR';
-- NURSE TABLE
INSERT INTO NURSE(em1) SELECT em1 FROM hospital_employee WHERE emp_type='NURSE';
-- RECEPTIONIST TABLE
INSERT INTO receptionist(em1) SELECT em1 FROM hospital_employee WHERE emp_type='Recep';
-- HOUSEKEEPING TABLE
INSERT INTO housekeeping(em1) SELECT em1 FROM hospital_employee WHERE emp_type='HKeeping';

-- ROOMS table
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

-- updating the patient table --
-- (doctor treats and diagnoses the patient) --
UPDATE patient SET diagnosis=diag WHERE pat_id=pat_id;

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

--updating/assigning new doctor to a patient --
UPDATE treats SET doc_id=D_id WHERE pat_id=p_id;

-- deleting/firing employee with highest salary --
DELETE FROM hospital_employee WHERE salary=(SELECT max(salary) FROM hospital_employee);


-- 
-- 
--ADDITIONAL CRUD AND COMPLEX QUERIES USED FOR OPERATIONS FROM FORM INPUTS FROM WEBPAGE
-- 
-- 
-- ADDING NEW EMPLOYEES --
--HOSPITAL_EMPLOYEE table(query used to insert into table from form)
INSERT INTO hospital_employee
    (employee_name,gender,age,emp_type,salary,contact_no)
VALUES(emp_name, gen_der, age, job_desc, sal, ph_no);
--EMP_ADDRESS table (query used to insert from form)
INSERT INTO emp_address
    (house_no,street,area,city,emp_id)
VALUES(h_no, st_name, ar_code, city_name,(SELECT emp_id FROM hospital_employee WHERE employee_name=emp_name AND contact_no=ph_no));
--depending on job desc one of the following queries will be called
-- for doc
INSERT INTO Doctor
    (emp_id)
SELECT emp_id
FROM hospital_employee
WHERE employee_name=emp_name AND contact_no=ph_n;
-- for nurse
INSERT INTO Nurse
    (emp_id)
SELECT emp_id
FROM hospital_employee
WHERE employee_name=emp_name AND contact_no=ph_n;
-- and
UPDATE room_incharge SET nurse_id= (SELECT emp_id
FROM hospital_employee
WHERE employee_name=emp_name AND contact_no=ph_no) WHERE room_no=r_no;
-- for receptionist
INSERT INTO receptionist
    (emp_id)
SELECT emp_id
FROM hospital_employee
WHERE employee_name=emp_name AND contact_no=ph_n;
-- for housekeeping
INSERT INTO housekeeping
    (emp_id)
SELECT emp_id
FROM hospital_employee
WHERE employee_name=emp_name AND contact_no=ph_n;
-- and
UPDATE room_incharge SET h_id= (SELECT emp_id
FROM hospital_employee
WHERE employee_name=emp_name AND contact_no=ph_no)  WHERE room_no=r_no;
--UPDATING EMPLOYEE TABLE--
-- changing salary and phone number
UPDATE hospital_employee SET salary=sal WHERE emp_id=employee_id;
UPDATE hospital_employee SET contact_no=ph_no WHERE emp_id=employee_id;
-- DELETE AN EMPLOYEE--
DELETE FROM hospital_employee WHERE emp_id=employee_id;
-- ROOM TABLE OPS --
-- update room prices(query used to update room price)
UPDATE rooms SET cost=price WHERE room_no=r_id;
-- PATIENT TABLE OPS --
-- display availavle rooms and doctors QUERY--
-- ADDING A PATIENT -- (RECEPTIONIST)
-- (insert patient)
INSERT INTO patient
    (pat_name,gender,age,contact_no,admit_date)
VALUES(p_name, gen, p_age, ph_no, a_date);
-- (assign room)
INSERT INTO room_assigned
    (pat_id,room_no)
SELECT pat_id, room_no
FROM patient, rooms
WHERE pat_name=p_name AND contact_no=ph_no AND room_no=r_no;
-- (assign doctor)
INSERT INTO treats
    (pat_id,doc_id)
SELECT pat_id, doc_id
FROM patient, doctor
WHERE pat_name=p_name AND patient.contact_no=ph_no AND doc_id=d_id;

-- DELETE A PATIENT(DISCHARGE) -- (DOCTOR)
-- (update discharge date)
UPDATE patient SET discharge_date=d_date WHERE pat_id=p_id;
-- (generate patient bill)
INSERT INTO bills
    (pat_id,no_of_days,bill_date,med_fee,room_fee,lab_fee,hosp_charges,tax,total)
SELECT patient.pat_id, (patient.discharge_date-patient.admit_date), patient.discharge_date, medicine_inventory.cost, rooms.cost, lab_reports.amount, (medicine_inventory.cost+rooms.cost+lab_reports.amount)*0.25, (medicine_inventory.cost+rooms.cost+lab_reports.amount)*1.25*0.18, (medicine_inventory.cost+rooms.cost+lab_reports.amount)*1.25*1.18
FROM patient, rooms, lab_reports, medicine_inventory
WHERE patient.pat_id=p_id AND
    rooms.room_no=(SELECT room_no FROM room_assigned WHERE pat_id=p_id) AND
    lab_reports.lab_id=(SELECT lab_id FROM lab_test WHERE pat_id=p_id) AND
    medicine_inventory.med_id=(SELECT med_id FROM medication WHERE pat_id=p_id);
-- (store patient details as records)
INSERT INTO records
    (Patient_name,pat_id,doc_id,diagnosis,admit_date,discharge_date,medication,bill_id)
SELECT patient.patient_name, patient.pat_id, treats.doc_id, patient.diagnosis, patient.admit_date, patient.discharge_date, medicine_inventory.med_name
FROM patient, medicine_inventory, treats
WHERE patient.pat_id=p_id AND
    treats.pat_id=p_id AND
    medicine_inventory.med_id=(SELECT med_id
    FROM medication
    WHERE pat_id=p_id);
-- (remove from patient table)
DELETE FROM patient WHERE pat_id=p_id;
-- UPDATE PATIENT table --
-- (update personal details)
UPDATE patient SET contact_no=ph_no WHERE pat_id=p_id;
-- (update doctor in charge)
UPDATE treats SET doc_id=d_id WHERE pat_id=p_id;
-- (update room assigned)
UPDATE room_assigned SET room_no=r_no WHERE pat_id=p_id;
-- rooms table(query used to insert into table from form)
-- INSERT INTO rooms
--     (cost,room_type)
-- VALUES(price, r_type);
-- -- remove/deleting a room
-- DELETE FROM rooms WHERE room_no=r_id;