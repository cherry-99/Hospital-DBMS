CREATE TABLE hospital_employee (
	"employee_name" VARCHAR(30),
	"gender" VARCHAR(2),
	"age" INTEGER,
	"emp_id" serial PRIMARY KEY,
	"emp_type" VARCHAR(8),
	"salary" DECIMAL,
	"contact_no" INTEGER UNIQUE
);

CREATE TABLE Doctor (
	"doc_id" serial PRIMARY KEY,
	"emp_id" serial UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE Nurse (
	"nurse_id" VARCHAR(6) PRIMARY KEY,
	"emp_id" INTEGER UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE receptionist (
	"r_id" VARCHAR(6) PRIMARY KEY,
	"emp_id" INTEGER UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE housekeeping (
	"h_id" VARCHAR(6) PRIMARY KEY,
	"emp_id" INTEGER UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE patient (
	"pat_id" serial PRIMARY KEY,
	"pat_name" VARCHAR(30) UNIQUE,
	"gender" VARCHAR(3),
	"age" INTEGER,
	"contact_no" INTEGER,
	"admit_date" DATE,
	"discharge_date" DATE
);

CREATE TABLE emp_address (
	"house_no" INTEGER,
	"street" VARCHAR(10),
	"area" VARCHAR(10),
	"city" VARCHAR(10),
	"emp_id" INTEGER,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE records (
	"Patient_name" VARCHAR(30),
	"pat_id" serial,
	"doc_id" VARCHAR(6),
	"diagnosis" VARCHAR(30),
	"admit_date" DATE,
	"discharge_date" DATE,
	"medication" VARCHAR(30),
	"bill_amt" FLOAT,
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE
);

CREATE TABLE lab_reports (
	"lab_id" serial PRIMARY KEY,
	"amount" FLOAT,
	"date" DATE
);

CREATE TABLE medicine_inventory (
	"med_id" serial PRIMARY KEY,
	"med_name" VARCHAR(30) UNIQUE,
	"exp_date" DATE,
	"cost" FLOAT
);

CREATE TABLE bill (
	"pat_id" serial,
	"no_of_days" INTEGER,
	"bill_date" DATE,
	"doc_fee" DECIMAL,
	"med_fee" DECIMAL,
	"room_fee" DECIMAL,
	"lab_fee" DECIMAL,
	"tax" DECIMAL,
	"total" DECIMAL,
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE
);

CREATE TABLE rooms (
	"room_no" serial PRIMARY KEY,
	"cost" DECIMAL,
	"room_type" VARCHAR(5),
	"status" VARCHAR(5) DEFAULT 'unocc'
);

CREATE TABLE room_incharge (
	"room_no" INTEGER ,
	"nurse_id" VARCHAR(6) ,
	"h_id" VARCHAR(6),
	FOREIGN KEY ("room_no") REFERENCES rooms("room_no") ON DELETE CASCADE,
	FOREIGN KEY ("nurse_id") REFERENCES Nurse("nurse_id") ON DELETE SET NULL,
	FOREIGN KEY ("h_id") REFERENCES housekeeping("h_id") ON DELETE SET NULL
);

CREATE TABLE room_assigned (
	"room_no" INTEGER,
	"pat_id" serial,
	FOREIGN KEY ("room_no") REFERENCES rooms("room_no") ON DELETE CASCADE,
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE
);

CREATE TABLE lab_test (
	"pat_id" serial,
	"lab_id" INTEGER,
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE,
	FOREIGN KEY ("lab_id") REFERENCES lab_reports("lab_id") ON DELETE CASCADE
);

CREATE TABLE medication (
	"med_id" INTEGER,
	"pat_id" serial,
	FOREIGN KEY ("med_id") REFERENCES medicine_inventory("med_id"),
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE
);

CREATE TABLE treats (
	"doc_id" integer,
	"pat_id" serial,
	FOREIGN KEY ("doc_id") REFERENCES Doctor("doc_id"),
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE
);