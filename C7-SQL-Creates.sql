CREATE TABLE "Doctor" (
	"doc_id" serial(6) NOT NULL PRIMARY KEY,
	"emp_id" serial(6) NOT NULL UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES "hospital_employee"("emp_id")
);

CREATE TABLE "Nurse" (
	"nurse_id" VARCHAR(6) NOT NULL PRIMARY KEY,
	"emp_id" VARCHAR(6) NOT NULL UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES "hospital_employee"("emp_id")
);

CREATE TABLE "receptionist" (
	"r_id" VARCHAR(6) NOT NULL PRIMARY KEY,
	"emp_id" VARCHAR(6) NOT NULL UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES "hospital_employee"("emp_id")
);

CREATE TABLE "housekeeping" (
	"h_id" VARCHAR(6) NOT NULL PRIMARY KEY,
	"emp_id" VARCHAR(6) NOT NULL UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES "hospital_employee"("emp_id")
);

CREATE TABLE "hospital_employee" (
	"employee_name" VARCHAR(30) NOT NULL,
	"gender" VARCHAR(2),
	"age" INTEGER NOT NULL,
	"emp_id" serial(6) NOT NULL PRIMARY KEY,
	"emp_type" VARCHAR(8) NOT NULL,
	"salary" DECIMAL NOT NULL,
	"contact_no" INTEGER NOT NULL UNIQUE
);

CREATE TABLE "emp_address" (
	"house_no" INTEGER NOT NULL,
	"street" VARCHAR(10) NOT NULL,
	"area" VARCHAR(10) NOT NULL,
	"city" VARCHAR(10) NOT NULL,
	"emp_id" VARCHAR(6) NOT NULL,
	FOREIGN KEY ("emp_id") REFERENCES "hospital_employee"("emp_id")
);

CREATE TABLE "records" (
	"Patient_name" VARCHAR(30) NOT NULL,
	"pat_id" VARCHAR(6) NOT NULL,
	"doc_id" VARCHAR(6) NOT NULL,
	"diagnosis" VARCHAR(30) NOT NULL,
	"admit_date" DATE NOT NULL,
	"discharge_date" DATE NOT NULL,
	"medication" VARCHAR(30) NOT NULL,
	"bill_amt" FLOAT NOT NULL
);

CREATE TABLE "lab_reports" (
	"lab_id" serial(5) NOT NULL PRIMARY KEY,
	"amount" FLOAT NOT NULL,
	"date" DATE NOT NULL
);

CREATE TABLE "medicine_inventory" (
	"med_id" serial(5) NOT NULL PRIMARY KEY,
	"med_name" VARCHAR(30) NOT NULL UNIQUE,
	"exp_date" DATE NOT NULL,
	"cost" FLOAT NOT NULL
);

CREATE TABLE "bill" (
	"pat_id" VARCHAR(6) NOT NULL,
	"no_of_days" INTEGER NOT NULL,
	"bill_date" DATE NOT NULL,
	"doc_fee" DECIMAL NOT NULL,
	"med_fee" DECIMAL NOT NULL,
	"room_fee" DECIMAL NOT NULL,
	"lab_fee" DECIMAL NOT NULL,
	"tax" DECIMAL NOT NULL,
	"total" DECIMAL NOT NULL,
	FOREIGN KEY ("pat_id") REFERENCES "patient"("pat_id")
);

CREATE TABLE "rooms" (
	"room_no" serial(3) NOT NULL PRIMARY KEY,
	"cost" DECIMAL NOT NULL,
	"room_type" VARCHAR(5) NOT NULL,
	"status" VARCHAR(5) NOT NULL DEFAULT 'unocc'
);

CREATE TABLE "patient" (
	"pat_id" VARCHAR(6) NOT NULL PRIMARY KEY,
	"pat_name" VARCHAR(30) NOT NULL UNIQUE,
	"gender" VARCHAR(3) NOT NULL,
	"age" INTEGER NOT NULL,
	"contact_no" INTEGER NOT NULL,
	"admit_date" DATE NOT NULL,
	"discharge_date" DATE NOT NULL
);

CREATE TABLE "room_incharge" (
	"room_no" INTEGER NOT NULL,
	"nurse_id" VARCHAR(6) NOT NULL,
	"h_id" VARCHAR(6) NOT NULL,
	FOREIGN KEY ("room_no") REFERENCES "rooms"("room_no"),
	FOREIGN KEY ("nurse_id") REFERENCES "Nurse"("nurse_id"),
	FOREIGN KEY ("h_id") REFERENCES "housekeeping"("h_id")
);

CREATE TABLE "room_assigned" (
	"room_no" INTEGER NOT NULL,
	"pat_id" VARCHAR(6) NOT NULL,
	FOREIGN KEY ("room_no") REFERENCES "rooms"("room_no"),
	FOREIGN KEY ("pat_id") REFERENCES "patient"("pat_id")
);

CREATE TABLE "lab_test" (
	"pat_id" VARCHAR(6) NOT NULL,
	"lab_id" VARCHAR(6) NOT NULL,
	FOREIGN KEY ("pat_id") REFERENCES "patient"("pat_id"),
	FOREIGN KEY ("lab_id") REFERENCES "lab_reports"("lab_id")
);

CREATE TABLE "medication/treatment" (
	"med_id" INTEGER(5) NOT NULL,
	"pat_id" VARCHAR(6) NOT NULL,
	FOREIGN KEY ("med_id") REFERENCES "medicine_inventory"("med_id"),
	FOREIGN KEY ("pat_id") REFERENCES "patient"("pat_id")
);

CREATE TABLE "treats" (
	"doc_id" VARCHAR(6) NOT NULL,
	"pat_id" VARCHAR(6) NOT NULL,
	FOREIGN KEY ("doc_id") REFERENCES "Doctor"("doc_id"),
	FOREIGN KEY ("pat_id") REFERENCES "patient"("pat_id")
);