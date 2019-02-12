CREATE TABLE "Doctor" (
	"doc_id" serial(6) NOT NULL,
	"emp_id" serial(6) NOT NULL UNIQUE,
	CONSTRAINT Doctor_pk PRIMARY KEY ("doc_id")
);



CREATE TABLE "Nurse" (
	"nurse_id" varchar(6) NOT NULL,
	"emp_id" varchar(6) NOT NULL UNIQUE,
	CONSTRAINT Nurse_pk PRIMARY KEY ("nurse_id")
);



CREATE TABLE "receptionist" (
	"r_id" varchar(6) NOT NULL,
	"emp_id" varchar(6) NOT NULL UNIQUE,
	CONSTRAINT receptionist_pk PRIMARY KEY ("r_id")
);



CREATE TABLE "housekeeping" (
	"h_id" varchar(6) NOT NULL,
	"emp_id" varchar(6) NOT NULL UNIQUE,
	CONSTRAINT housekeeping_pk PRIMARY KEY ("h_id")
);



CREATE TABLE "hospital_employee" (
	"employee_name" varchar(30) NOT NULL,
	"gender" varchar(2),
	"age" integer NOT NULL,
	"emp_id" serial(6) NOT NULL,
	"emp_type" varchar(8) NOT NULL,
	"salary" DECIMAL NOT NULL,
	"contact_no" integer NOT NULL UNIQUE,
	CONSTRAINT hospital_employee_pk PRIMARY KEY ("emp_id")
);



CREATE TABLE "emp_address" (
	"house_no" integer NOT NULL,
	"street" varchar(10) NOT NULL,
	"area" varchar(10) NOT NULL,
	"city" varchar(10) NOT NULL,
	"emp_id" varchar(6) NOT NULL
);



CREATE TABLE "records" (
	"Patient_name" varchar(30) NOT NULL,
	"pat_id" varchar(6) NOT NULL,
	"doc_id" varchar(6) NOT NULL,
	"diagnosis" varchar(30) NOT NULL,
	"admit_date" DATE NOT NULL,
	"discharge_date" DATE NOT NULL,
	"medication" varchar(30) NOT NULL,
	"bill_amt" FLOAT NOT NULL
);



CREATE TABLE "lab_reports" (
	"lab_id" serial(5) NOT NULL,
	"amount" FLOAT NOT NULL,
	"date" DATE NOT NULL,
	CONSTRAINT lab_reports_pk PRIMARY KEY ("lab_id")
);



CREATE TABLE "medicine_inventory" (
	"med_id" serial(5) NOT NULL,
	"med_name" varchar(30) NOT NULL UNIQUE,
	"exp_date" DATE NOT NULL,
	"cost" FLOAT NOT NULL,
	CONSTRAINT medicine_inventory_pk PRIMARY KEY ("med_id")
);



CREATE TABLE "bill" (
	"pat_id" varchar(6) NOT NULL,
	"no_of_days" integer NOT NULL,
	"bill_date" DATE NOT NULL,
	"doc_fee" DECIMAL NOT NULL,
	"med_fee" DECIMAL NOT NULL,
	"room_fee" DECIMAL NOT NULL,
	"lab_fee" DECIMAL NOT NULL,
	"tax" DECIMAL NOT NULL,
	"total" DECIMAL NOT NULL
);



CREATE TABLE "rooms" (
	"room_no" serial(3) NOT NULL,
	"cost" DECIMAL NOT NULL,
	"room_type" varchar(5) NOT NULL,
	"status" varchar(5) NOT NULL DEFAULT 'unocc',
	CONSTRAINT rooms_pk PRIMARY KEY ("room_no")
);



CREATE TABLE "patient" (
	"pat_id" varchar(6) NOT NULL,
	"pat_name" varchar(30) NOT NULL UNIQUE,
	"gender" varchar(3) NOT NULL,
	"age" integer NOT NULL,
	"contact_no" integer NOT NULL,
	"admit_date" DATE NOT NULL,
	"discharge_date" DATE NOT NULL,
	CONSTRAINT patient_pk PRIMARY KEY ("pat_id")
);



CREATE TABLE "room_incharge" (
	"room_no" integer NOT NULL,
	"nurse_id" varchar(6) NOT NULL,
	"h_id" varchar(6) NOT NULL
);



CREATE TABLE "room_assigned" (
	"room_no" integer NOT NULL,
	"pat_id" varchar(6) NOT NULL
);



CREATE TABLE "lab_test" (
	"pat_id" varchar(6) NOT NULL,
	"lab_id" varchar(6) NOT NULL
);



CREATE TABLE "medication/treatment" (
	"med_id" integer(5) NOT NULL,
	"pat_id" TIMESTAMP(6) NOT NULL
);



CREATE TABLE "treats" (
	"doc_id" varchar(6) NOT NULL,
	"pat_id" varchar(6) NOT NULL
);



ALTER TABLE "Doctor" ADD CONSTRAINT "Doctor_fk0" FOREIGN KEY ("emp_id") REFERENCES "hospital_employee"("emp_id");

ALTER TABLE "Nurse" ADD CONSTRAINT "Nurse_fk0" FOREIGN KEY ("emp_id") REFERENCES "hospital_employee"("emp_id");

ALTER TABLE "receptionist" ADD CONSTRAINT "receptionist_fk0" FOREIGN KEY ("emp_id") REFERENCES "hospital_employee"("emp_id");

ALTER TABLE "housekeeping" ADD CONSTRAINT "housekeeping_fk0" FOREIGN KEY ("emp_id") REFERENCES "hospital_employee"("emp_id");

ALTER TABLE "emp_address" ADD CONSTRAINT "emp_address_fk0" FOREIGN KEY ("emp_id") REFERENCES "hospital_employee"("emp_id");

ALTER TABLE "bill" ADD CONSTRAINT "bill_fk0" FOREIGN KEY ("pat_id") REFERENCES "patient"("pat_id");

ALTER TABLE "room_incharge" ADD CONSTRAINT "room_incharge_fk0" FOREIGN KEY ("room_no") REFERENCES "rooms"("room_no");
ALTER TABLE "room_incharge" ADD CONSTRAINT "room_incharge_fk1" FOREIGN KEY ("nurse_id") REFERENCES "Nurse"("nurse_id");
ALTER TABLE "room_incharge" ADD CONSTRAINT "room_incharge_fk2" FOREIGN KEY ("h_id") REFERENCES "housekeeping"("h_id");

ALTER TABLE "room_assigned" ADD CONSTRAINT "room_assigned_fk0" FOREIGN KEY ("room_no") REFERENCES "rooms"("room_no");
ALTER TABLE "room_assigned" ADD CONSTRAINT "room_assigned_fk1" FOREIGN KEY ("pat_id") REFERENCES "patient"("pat_id");

ALTER TABLE "lab_test" ADD CONSTRAINT "lab_test_fk0" FOREIGN KEY ("pat_id") REFERENCES "patient"("pat_id");
ALTER TABLE "lab_test" ADD CONSTRAINT "lab_test_fk1" FOREIGN KEY ("lab_id") REFERENCES "lab_reports"("lab_id");

ALTER TABLE "medication/treatment" ADD CONSTRAINT "medication/treatment_fk0" FOREIGN KEY ("med_id") REFERENCES "medicine_inventory"("med_id");
ALTER TABLE "medication/treatment" ADD CONSTRAINT "medication/treatment_fk1" FOREIGN KEY ("pat_id") REFERENCES "patient"("pat_id");

ALTER TABLE "treats" ADD CONSTRAINT "treats_fk0" FOREIGN KEY ("doc_id") REFERENCES "Doctor"("doc_id");
ALTER TABLE "treats" ADD CONSTRAINT "treats_fk1" FOREIGN KEY ("pat_id") REFERENCES "patient"("pat_id");