-- patient table
CREATE TABLE patient (
  _id int(10) unsigned NOT NULL AUTO_INCREMENT,
  pn varchar(11) DEFAULT NULL,
  first varchar(15) DEFAULT NULL,
  last varchar(25) DEFAULT NULL,
  dob date DEFAULT NULL,
  PRIMARY KEY (_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- insurance table
CREATE TABLE insurance (
  _id int(10) unsigned NOT NULL AUTO_INCREMENT,
  patient_id int(10) unsigned DEFAULT NULL,
  iname varchar(40) DEFAULT NULL,
  from_date date DEFAULT NULL,
  to_date date DEFAULT NULL,
  PRIMARY KEY (_id),
  CONSTRAINT FK_Insurance FOREIGN KEY (patient_id) REFERENCES patient (_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- sample data for patient table
INSERT INTO patient (pn, first, last, dob) VALUES ('001','Michael','Scott','1974-03-20');
INSERT INTO patient (pn, first, last, dob) VALUES ('002','James','Pine','1962-12-04');
INSERT INTO patient (pn, first, last, dob) VALUES ('003','Mary Lou','Johnson','1944-01-01');
INSERT INTO patient (pn, first, last, dob) VALUES ('004','Richard','Dickson','1990-02-28');
INSERT INTO patient (pn, first, last, dob) VALUES ('005','Jaagup','Joonaste','1996-07-05');

-- sample data for insurance table
INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES (1, 'United Health','2014-01-01','2016-01-01');
INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES (1, 'United Health','2016-01-01','2018-01-01');
INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES (2, 'Kaiser Foundation','2013-05-12','2015-05-12');
INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES (2, 'Kaiser Foundation','2015-05-12','2017-05-12');
INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES (3, 'Humana','2018-03-10','2020-03-10');
INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES (3, 'Humana','2020-03-10','2022-03-10');
INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES (4, 'Cigna Health','2017-04-30','2019-04-30');
INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES (4, 'Cigna Health','2019-04-30','2021-04-30');
INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES (5, 'Centene Corp','2010-02-10','2012-02-10');
INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES (5, 'Centene Corp','2012-02-10','2014-02-10');