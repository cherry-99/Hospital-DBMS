CREATE TABLE hospital_employee (
	"emp_id" serial PRIMARY KEY,
	"employee_name" VARCHAR(30),
	"gender" VARCHAR(7),
	"age" INTEGER,
	"emp_type" VARCHAR(12),
	"salary" DECIMAL,
	"contact_no" bigint UNIQUE
);

CREATE TABLE employee_login(
	"emp_id" INTEGER,
	"password" INTEGER,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE Doctor (
	"doc_id" serial PRIMARY KEY,
	"emp_id" INTEGER UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE Nurse (
	"nurse_id" serial PRIMARY KEY,
	"emp_id" INTEGER UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE receptionist (
	"r_id" serial PRIMARY KEY,
	"emp_id" INTEGER UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE housekeeping (
	"h_id" serial PRIMARY KEY,
	"emp_id" INTEGER UNIQUE,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE patient (
	"pat_id" serial PRIMARY KEY,
	"pat_name" VARCHAR(30),
	"gender" VARCHAR(7),
	"date_of_birth" DATE,
	"contact_no" bigint UNIQUE,
	"admit_date" DATE,
	"diagnosis" VARCHAR(30),
	"discharge_date" DATE
);

CREATE TABLE patient_login(
	pat_id INTEGER,
	password INTEGER,
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE
);

CREATE TABLE emp_address (
	"house_no" INTEGER,
	"street" VARCHAR(20),
	"area" VARCHAR(40),
	"city" VARCHAR(20),
	"emp_id" INTEGER,
	FOREIGN KEY ("emp_id") REFERENCES hospital_employee("emp_id") ON DELETE CASCADE
);

CREATE TABLE pat_address (
	"house_no" INTEGER,
	"street" VARCHAR(20),
	"area" VARCHAR(40),
	"city" VARCHAR(20),
	"pat_id" INTEGER,
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE
);

CREATE TABLE bill (
	"bill_id" serial PRIMARY KEY,
	"pat_id" INTEGER,
	-- "no_of_days" INTEGER,
	"bill_date" DATE,
	"hosp_charges" DECIMAL,
	"med_fee" DECIMAL,
	"room_fee" DECIMAL,
	"tax" DECIMAL,
	"total" DECIMAL
);

CREATE TABLE records (
	"patient_name" VARCHAR(30),
	"pat_id" serial PRIMARY KEY,
	"doc_id" INTEGER,
	"diagnosis" VARCHAR(30),
	"admit_date" DATE,
	"discharge_date" DATE,
	"medication" VARCHAR(30),
	"bill_id" INTEGER,
	FOREIGN KEY ("bill_id") REFERENCES bill("bill_id") ON DELETE CASCADE
);

CREATE TABLE medicine_inventory (
	"med_id" serial PRIMARY KEY,
	"med_name" VARCHAR(30) UNIQUE,
	"cost" FLOAT,
	"quantity" INTEGER
);

CREATE TABLE rooms (
	"room_no" serial PRIMARY KEY,
	"cost" DECIMAL,
	"room_type" VARCHAR(5),
	"status" VARCHAR(5) DEFAULT 'unocc'
);

CREATE TABLE room_incharge (
	"room_no" INTEGER ,
	"nurse_id" INTEGER ,
	"h_id" INTEGER,
	FOREIGN KEY ("room_no") REFERENCES rooms("room_no") ON DELETE CASCADE,
	FOREIGN KEY ("nurse_id") REFERENCES Nurse("nurse_id") ON DELETE SET NULL,
	FOREIGN KEY ("h_id") REFERENCES housekeeping("h_id") ON DELETE SET NULL
);

CREATE TABLE room_assigned (
	"room_no" INTEGER,
	"pat_id" INTEGER,
	FOREIGN KEY ("room_no") REFERENCES rooms("room_no") ON DELETE CASCADE,
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE
);

CREATE TABLE medication (
	"med_id" INTEGER,
	"pat_id" INTEGER,
	FOREIGN KEY ("med_id") REFERENCES medicine_inventory("med_id"),
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE
);

CREATE TABLE treats (
	"doc_id" INTEGER,
	"pat_id" INTEGER,
	FOREIGN KEY ("doc_id") REFERENCES Doctor("doc_id") ON DELETE SET NULL,
	FOREIGN KEY ("pat_id") REFERENCES patient("pat_id") ON DELETE CASCADE
);