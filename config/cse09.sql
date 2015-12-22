CREATE DATABASE if not exists `CSE09`;
USE `CSE09`;

CREATE TABLE IF NOT EXISTS `CSE09_Students` (
  `Id` varchar(10) NOT NULL,
  `RNo` int(2) NOT NULL DEFAULT '0',
  `Name` varchar(50) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Branch` varchar(5) NOT NULL,
  `Class` int(1) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Picture` varchar(30) NOT NULL,
  `PhoneNo` varchar(10) NOT NULL DEFAULT '0',
  `Position` varchar(5) NOT NULL,
  PRIMARY KEY (`Id`)
);


INSERT INTO `CSE09_Students` (`Id`, `RNo`, `Name`, `Gender`, `Branch`, `Class`, `Password`, `Picture`, `PhoneNo`, `Position`) VALUES
('N081720', 1, 'DUMMU KOTESWARI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N082465', 1, 'KUMBURU SURYA KUMARI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N082667', 2, 'BANDELA ANUPAMA', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N082841', 1, 'PALETI KEERTHI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N083353', 1, 'PATI RENUKA SATYA HEMALATHA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N090012', 2, 'KORUMILLI SREE LAXMI PHANI PRIYANKA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090026', 2, 'ADARI RAMU', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N090036', 1, 'ALLAKA VENKATA VINAY', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N090038', 3, 'SONTI GOPINADH', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N090041', 3, 'POLAMARASETTY BALA KISHORE', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'BA'),
('N090049', 1, 'GONTHINA RAMA LINGA RAJENDRA KUMAR', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N090053', 3, 'AKULA NAGA CHANDRA DEVI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090055', 2, 'KADUPUTLA RAMATULASI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N090062', 4, 'ANEM SAILAJA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090066', 5, 'BONTHU HARIKA CHOWDARY', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090069', 4, 'MOKKALA SRI LAKSHMI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090084', 6, 'ALLA BAPIRAJU', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090096', 7, 'ARISETTI PRASANTHA KUMAR', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090102', 2, 'TANNIRU RAJANI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N090109', 2, 'DOGGA DEVIKA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090110', 4, 'PONNANA GOWTHAMI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090112', 8, 'AIKAM HIMABINDU', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090121', 3, 'ENAGADAPA NAGA VENKATA BHANUPRAKASH', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N090125', 9, 'BONAM VENKATESWARLU', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090136', 5, 'TANAKALA DHARMA', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090151', 6, 'RUTTALA JAYALAKSHMI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090157', 3, 'BALAGA SUKUMARI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090177', 5, 'BASWA SANTHOSH', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'CR'),
('N090180', 7, 'BENDALAM MANI BABU', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090189', 10, 'POOJA ASHOK KUMAR', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090191', 4, 'BHOGISETTI N V V DURGAPRASAD', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090192', 4, 'GAMPALA SRINIVASU', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090194', 11, 'MUNGAMURI DEEPU', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090217', 3, 'BILLA MEHER MOUNIKA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090220', 4, 'RAYALA SUDHANJALI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090227', 5, 'PENTAKOTA MANEENDRA', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090233', 5, 'CHITROTU SURESH', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090243', 12, 'CHILAKALA BRAHMA REDDY', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090246', 8, 'KOKKILIGADDA VASU', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090247', 6, 'THANGELLA ANEESHKUMAR', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090260', 6, 'PRAYAGA MADHURI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090266', 13, 'CHEBOLU VENKATA RENUKA DEVI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090276', 14, 'BODDEDA SAIBABU', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090287', 7, 'MOHAMMAD UMAR', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090289', 7, 'MANTHINA GANESH', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090299', 8, 'DEVARAPALLI SATHIBABU', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090300', 5, 'DEVARAPALLI RAJU', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090301', 15, 'CHERUKU LAKSHMI PRASANNA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090309', 9, 'CHINDURUPU SRAVYA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090312', 6, 'CHINTAPALLI RENUKA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090315', 7, 'SRIRAJATYADAPUSAPATI SOWJANYA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090316', 9, 'PENTA SAI LAKSHMI PRASANNA', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090317', 6, 'CHUKKA JYOTHSNA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090331', 7, 'KOMMURI NARESH CHOWDARY', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/users/N090331.png', '9999999999', 'S'),
('N090336', 8, 'KANCHI VENKATA JAGADEESH', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090352', 8, 'DANTHULURI SRI SAI MADHURI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090354', 10, 'DASARI SARANYA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090379', 11, 'GOKADA SANYASI NAIDU', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090385', 9, 'GOSALA SURESH BABU', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090386', 9, 'GOTTAM MAHESH', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090425', 16, 'GUNTRU VEERA BABU', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090427', 10, 'GUNTURU VIDYASAGAR', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090428', 8, 'GURRAM VINAY', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090435', 12, 'VELUGURI MADHU', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090440', 17, 'NALLANI ANIRUDH', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090449', 10, 'ISTALAMURI BALA OBULA REDDY', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090451', 11, 'CHALLA CHANDRIKA', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090455', 10, 'GANGURU BALA TRIPURASUNDARI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090456', 11, 'GUNDUBOGULA LALITHA DEVI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090460', 11, 'GARUGU VENKATA SREEDEVI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090461', 13, 'GAVARA REVATHI RANI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090462', 9, 'GAVARA SUSHEELA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090464', 12, 'GOLKONDA DELPHINE JOYNEER', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090465', 14, 'GOLLA SWATHI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090468', 18, 'VARDHANAPU JUISREE', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090473', 12, 'AMBATI BHARATH', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090474', 10, 'GUNTU NAVEEN KUMAR', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090485', 15, 'DANDU MUNI BHUPATHI REDDY', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090487', 16, 'JAYANTHI RAVI TEJA', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090488', 12, 'KOJJA PRAKASH', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090491', 11, 'JUJJUVARAPU RATNA PRAKASH', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090493', 12, 'KUDARI PRAVEENKUMAR', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090495', 13, 'AMARLAPUDI RANJITH KUMAR', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090510', 13, 'GUDIVAKA NAGA SIVA SRUTHI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090518', 13, 'PRASADAM GOWTAMI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090529', 17, 'PILLI MANOJ KUMAR', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090534', 19, 'KARANI ANAND KUMAR', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090537', 20, 'KARRI ANIL KUMAR', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090541', 21, 'KATTEPOGU RAVI VARMA', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090548', 14, 'MASEED SHAIK HUSUNU ZAMA', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090552', 14, 'TADEPALLI MEENAKSHI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090553', 22, 'GUNDABATHINA SRAVANI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090554', 15, 'CHITTURI CHAYA USHA PADMINI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090555', 18, 'GONDU RAMA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090557', 14, 'INDUKURI NAGA PRASANNA', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090559', 16, 'INDURI KOTESWARI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090560', 13, 'GANTELA SUSHMA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090562', 14, 'JUJJURI JHANSILAKSHMI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090565', 15, 'KOMMOJU LAKSHMI KEERTHI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090566', 16, 'SRINGARAPU MADHAVI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090568', 19, 'JAJIMOGGALA SATYANARAYANAMMA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090569', 17, 'JAJJARA NAGA MANI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090573', 15, 'KOLLURI RAJESH', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090577', 16, 'KONA MANIKANTASRINIVAS', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090582', 15, 'KOPPULA PRAVEEN KUMAR', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090583', 16, 'KORIKANA JAGADEESH', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090587', 17, 'PUDI JAYACHANDRA KUMAR', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090588', 17, 'PERISETLA KUMAR BABU', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090593', 18, 'KOVVALI SYAMBABU', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090594', 18, 'KOVVURI AMMI REDDY', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090596', 19, 'POTNURU SIVA O', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090597', 23, 'GANTEDA VINAY', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090598', 19, 'TADDI PRASANTH', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090618', 20, 'BATHULA JASMINE', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090619', 20, 'JUTURI RAMA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090631', 17, 'KARNAM KANNA RAO', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090634', 21, 'VEDULAPURAPU TIRUPATHI RUSHI', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090636', 20, 'MEERAVATU DATTA NAIK', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090639', 18, 'LENKA YOGESWARA RAO', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090641', 21, 'CHOPPARA AJAY PRATHAP', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090645', 22, 'NALLURI SAIRAM', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090653', 24, 'KALANGI MADHAVI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090656', 18, 'MONDI DEVI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090664', 25, 'CHUKKA VIJAYA SINDHU', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090669', 26, 'KARETI AVANTHI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090678', 27, 'MAGAPU NANDEESH', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090679', 21, 'MAHAMMAD SULTHAN', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090680', 19, 'YERRAMSETTY VENKATESWARA RAO', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090686', 19, 'MOLABANTI SATISH KUMAR', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090695', 22, 'MALLESWARAPU SRINIVASA RAO', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090701', 23, 'KASINA BUNNI BHAGYASRI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090715', 24, 'KOLUSU RAMADEVI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090716', 25, 'KOMARA RAMALAKSHMI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090719', 20, 'TULIMILLI NAGA MOUNIKA', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090720', 28, 'THATI HIMABINDU', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090722', 22, 'BOMMIREDDY MEENA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090728', 23, 'MANDA RAJESH', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090735', 21, 'VARANASI TEJA', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090739', 22, 'MEDA VIJAYAKUMAR', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090741', 24, 'MEDI MURALI KRISHNA', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090749', 25, 'MIRIYALA JANARDHAN', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090756', 26, 'GUTTI LEELA KUMARI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090763', 27, 'PENTAKOTA VINAYA V S S NEERAJA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090792', 20, 'MOTHA BALA MURALI KRISHNA', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090797', 26, 'MUKKU TATAGANESH', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090798', 21, 'KAMANA NARSIMHA MURTHY', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090802', 23, 'TALLAPUREDDY LAKSHMI SRAVANTHI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090806', 28, 'KUNTAM SUSMITHA PRASANNA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090808', 23, 'MALISETTI MOUNIKA', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090809', 24, 'ORUGANTI MOUNIKA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090820', 29, 'DARLA GRACE LEENA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090823', 29, 'MACHARLA ANUSHA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090825', 22, 'KONDA SINDHURA', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090828', 30, 'MUVVA V V R MURALI KRISHNA RAO', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090834', 27, 'NADAKUDITI CHANDU', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090848', 31, 'BATTULA MAHESH VARMA', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090853', 30, 'MADDIBOINA SARANYA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090854', 31, 'BHIMAVARAPU HIMAJA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090855', 24, 'NURBASHA KARISHMA', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090858', 25, 'MALLA SIREESHA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090870', 23, 'MARELLA SIVANAGAJYOTHI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090884', 26, 'NANDARAPU VARAPRASAD', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090889', 32, 'MIDASALA SREEHARI', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090891', 32, 'MOPADA SANYASIRAO', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090904', 33, 'MEDISETTI BINDU MAHALAKSHMI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090907', 28, 'MEKALA ANUSHA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090908', 34, 'MEKALA SOWJANYA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090910', 35, 'MERIGA PAVANI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090912', 36, 'ANTIPETA SOUMYA DEVI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090913', 27, 'NEELAM SRUTHI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090920', 24, 'MOHAMMAD KAREEMUNNISHA', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090935', 28, 'NETTI VENKATA SATEESH', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090959', 25, 'MURARI SRI VARA LAKSHMI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090961', 33, 'MUSUNURI SRIDEVI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090965', 29, 'NADUKURU MOUNIKA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090968', 37, 'MOPARTHI KARUNA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090977', 29, 'PARVATHA ANESH', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090980', 34, 'BHAGYA RAJU PATI', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090981', 25, 'PATNANA SREERAJ', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090983', 38, 'PATTAPAGALU VEERASWAMI', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090990', 35, 'PEKALA JYOTHIRAM', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090991', 30, 'PENKI BUJJI', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090994', 31, 'PERUMALLAPALLI PAVAN KALYAN', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090997', 36, 'PINGUVADA ESWARA RAO', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N090999', 30, 'PINNINTI UMAMEHESWARA RAO', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091017', 31, 'TEDLAPU HYMAVATHI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091025', 26, 'CHODIPILLI SANTHI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091028', 39, 'PITTU RAMAKRISHNA', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091030', 32, 'PODILAPU NAGESWARA RAO', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091032', 26, 'PODUGU RAVI TEJA', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091033', 32, 'NALLAGORLA VARA PRASAD', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091043', 27, 'VANGAPANDU REVATHI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091058', 33, 'ADDAGARLA JAHNAVI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091060', 33, 'ATLA PRAVALLIKA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091078', 40, 'PRUDHIVI SRINIVASARAO', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091090', 37, 'PUTTA RAMACHANDRAIAH', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091096', 38, 'PATTAN MANSOOR ALI KHAN', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091100', 34, 'KUDARAVALLI SRAVANA GANGA KUMAR', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091101', 35, 'PATCHIGOLLA SINDHU', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091111', 34, 'PERIKALA BHAGYALATHA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091126', 36, 'RAJABOYINA SIVA NAGA DURGA PRASAD', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091130', 37, 'PANGI SUSANTH', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091131', 27, 'BADUGU STANDLI', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091136', 28, 'MALLELA VIJAY KUMAR', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091158', 35, 'PULA JAYASRI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091162', 41, 'PUVVULA SAI LEELA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091163', 36, 'RAMACHANDRUNI MADHURI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091165', 28, 'SHAIK KAUSARMUBEENA', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091166', 29, 'RAGAM DHARANI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091174', 39, 'MADHAVILATHA VEERAPANENI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091179', 38, 'CHERAKANI RAJESH', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091185', 42, 'BHUMIREDDY SRINIVASULU', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091187', 43, 'PUTTA SANDEEP', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091194', 30, 'MARRA ASHOK KUMAR', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091198', 31, 'PATHRI PAVAN KUMAR', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091199', 37, 'BASAVA SYAM KUMAR', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091203', 32, 'SURE VIJAYA LAKSHMI GOWTHAMI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091207', 40, 'MALLULA DURGA BHAVANI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091224', 33, 'YERRA BHAVANI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091226', 34, 'POLASAPALLI KANAKARAJU', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091230', 38, 'NAKKA VIJAYA SIMHA', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091233', 39, 'VEMURI ASHOK KRISHNA', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091239', 40, 'PITCHUKA SIVA SANKARA PRASAD', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091248', 35, 'PALAPARTHI SYAM BABU', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091249', 29, 'POTNURU PRASANTH', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091253', 39, 'PARISE HARITHA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091255', 41, 'CHALLAPALLI RAJYALAKSHMI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091261', 44, 'GUTTHA SAHITYA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091263', 45, 'MADDALA PRIYADARSHINI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091268', 36, 'RAMISETTI SUDHA RANI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091272', 42, 'NALLAGOPU N V LAKSHMI MOUNIKA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091273', 40, 'RAYAVARAPU JANAKI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091274', 43, 'BAHATAM GAYATHRI DEVI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091277', 44, 'PALAM BHARGAV REDDY', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091315', 46, 'GUNUGUNTLA NAVEEN', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091326', 47, 'SATTI SESHAREDDY', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091327', 48, 'SANAPALLI LOKESH', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091328', 30, 'VASUPALLI MANIKANTA', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091330', 31, 'KILLO VENKATA RAO', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091335', 37, 'KAPARAPU GANESH', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091338', 41, 'NETALA KISHORE KUMAR', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091361', 42, 'VALLURU VISWASAHITHI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091367', 32, 'SAI MANOGNA NALLAMOTHU', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091373', 38, 'GADI NAGA RANI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091385', 41, 'CHOUDABOYINA RAMU', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091386', 33, 'SETTY BALAKRISHNA', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091390', 49, 'SHAIK KALISHAVALI', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091396', 39, 'SHAIK HANEEF', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091402', 43, 'KASULANATI SRAVANTHI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091406', 40, 'POTTI KUSUMAKUMARI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091417', 42, 'LINGISETTI LAKSHMI PRASANNA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091434', 50, 'RAYI RAMBABU', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091445', 41, 'THAVITI EDUKONDALU', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091446', 51, 'MULAVEESALA NIRANJAN', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091450', 34, 'GAMPALA SATISH', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091457', 35, 'SHAIK SHARMILA SHAHANAZ', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091463', 42, 'SIKHILE HARIKA', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091466', 45, 'SIMMA PADMA VATHI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091467', 43, 'VELVADAPU RAJITHA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091470', 52, 'KARRI MOUNIKA RANI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091475', 43, 'KILARU JYOTHI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091477', 44, 'KATTA JAGADEESH', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091485', 36, 'KURELLA SATHISH PHANI', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091487', 46, 'THOTA NAGA RAJU', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091501', 44, 'GANGULA RAJYA LAKSHMI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091503', 44, 'KADALI JYOTHSNA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091506', 47, 'AKULA SINDHURA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091507', 37, 'PONDURU SOBHA RANI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091509', 38, 'VEGI SINDHU', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091515', 48, 'VARNAKAVI MAHA LAKSHMI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091516', 39, 'VELICHETY V V S S VAMSI KRISHNA', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091519', 46, 'VEERAMALLU NAGA JYOTSNA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091529', 47, 'PANJA KUMARA SATYA GOPAL', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091539', 45, 'PILLUTLA JANARDHAN', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091540', 49, 'DONEPUDI SURESH', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091548', 45, 'SAYYAD AESHA HALIMA BEEBI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091551', 53, 'KOPPULA SUMANTHA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091553', 48, 'VANAPALLI SRIJA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091563', 46, 'PALETI SESHA SWETHA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091583', 40, 'GOGULA VENKATA KRISHNA REDDY', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091584', 47, 'PATIVADA RAJ KUMAR', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091589', 46, 'ESUB BEIG', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091601', 47, 'UNDELA JYOTHI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091610', 49, 'CHOPPARAPU NAGA MANI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091613', 41, 'BHOGA OOHA', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091615', 50, 'KOUSIKA NAGA JYOTHI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091619', 48, 'UMMADISING SIRISHA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091621', 48, 'NUTHALAPATI SUDARSINI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091652', 50, 'DUNNA SRAVYA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091663', 51, 'SYED KARISHMA FARHIN', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091674', 42, 'TAMMINEEDI HARIKA', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091676', 49, 'KANURI DURGA SRINIVAS', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091685', 51, 'THOTA SIVANARAYANA', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091687', 43, 'KUNDLAMAHANTI SRINU', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091688', 44, 'CHODAVARAPU SANDEEP', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091699', 45, 'JILLA SRIRAM', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091701', 52, 'TATA SRILATHA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091704', 53, 'BHEEMIREDDY JYOTSNA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091708', 50, 'BUDATI SOWJANYA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091719', 52, 'VAKADA SWATHI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091727', 54, 'USURUPATI SANTHOSH BOBBY', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091733', 55, 'VANABATHINA SURYA', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091738', 54, 'VANUMU VENKATA DURGA PRASAD', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091748', 46, 'SEERAM VINOD VENKATA KUMAR', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091750', 47, 'KALAM ASHOK REDDY', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091755', 51, 'VARANASI APARNA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091764', 48, 'KUNCHA SWATHI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091765', 49, 'KANTETI KAMALA DEVI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091768', 49, 'PERABATHULA SATYAMANIKYAM', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091771', 50, 'VELAGA GANGA BHAVANI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091775', 52, 'CHOWDARI SONYA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091780', 55, 'DANGUDUBIYYAM SRIKANTH KONDALARAO', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091792', 56, 'VEMPATI VAMSI', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091801', 53, 'VENAM SRAVANI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091803', 56, 'VINJAMURI NIHARIKA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091804', 51, 'GUBBALA RADHIKA', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091808', 53, 'DHAVALESWARAPU DURGA PRASANNA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091815', 57, 'PANDI SWATHI', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091822', 50, 'GANTA MOUNIKA', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091825', 52, 'BALIVADA SOMESWARARAO', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091834', 58, 'RONGALI M VENKATA RAMANA', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091835', 54, 'POLAKI MANIKANTA', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091841', 55, 'SABBELLA VEERRAGHAVA REDDY', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091843', 51, 'MULIKI DURGA ABHINESH', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091845', 54, 'CHINTALACHERUVU SAI CHARAN', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091849', 52, 'GONTHIREDDY SRINIVAS', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091850', 53, 'PEKETI V V SATYANARAYANA REDDY', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091866', 54, 'KONDURI ANJANI DEVI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091869', 56, 'MURAKONDA SRAVANI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091875', 55, 'KARI UTTEJ', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091882', 53, 'MENNI YESWANTH', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091887', 55, 'KANDULA VEERANJANEYULU', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091891', 54, 'KOVURI NARESH', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091892', 55, 'KANDREGULA MAHESH BABU', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091895', 57, 'SAIKAM VEERA VENKATA BALA SURYAVAMSI', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091898', 56, 'DUPPALA SATEESHKUMAR', 'M', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091901', 59, 'KOKKILIGADDA RADHA', 'F', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091904', 56, 'AKULA RAMYA SRI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091906', 57, 'KARANKI LAKSHMI THIRUPATHAMMA', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091908', 56, 'PAMARTHI VENKATAKOMALI', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091910', 57, 'MALLAVARAPU SIREESHA', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091912', 57, 'DUBBAKU VENKATA LAKSHMI', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091922', 58, 'KOPPULA RAJASRI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091936', 60, 'T KRISHNA SUMANTH', 'M', 'CSE', 4, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091941', 58, 'KALUKURI NAGARJUNA', 'M', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091942', 58, 'PATAPANTULA VAMSI', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091943', 58, 'CHALAMALASETTI SUDARSHAN', 'M', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091944', 59, 'ANNAPUREDDI KALI VARA PRASAD', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091954', 59, 'VULISETTI NAGA VENKATA VIJAYA DURGA', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091965', 59, 'YEJJALA REVATHI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091966', 57, 'REDDY NAGASIREESHA', 'F', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091970', 60, 'YERROJU TEJARMAI', 'F', 'CSE', 2, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091977', 58, 'BOODU PARDHA SARADHI', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091985', 61, 'YADAGIRI BHASKARARAO', 'M', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N091986', 59, 'GUDIPUDI ANANDA BABU', 'M', 'CSE', 6, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N092026', 59, 'KILLO DEEPTHI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N092027', 60, 'PYLA VENKATA VASUDHA RANI', 'F', 'CSE', 3, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N092035', 60, 'PENUGANTI HARIKA DEVI', 'F', 'CSE', 1, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S'),
('N092038', 60, 'NRUSIMHADEVARA SRI SAI HYMA', 'F', 'CSE', 5, 'd4c9fcb601ebe8aa8d4ab59dcdbf692a', 'assets/img/avatar.jpg', '9999999999', 'S');

CREATE TABLE IF NOT EXISTS `CSE09_CRs` (
  `Id` varchar(7) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Branch` varchar(5) NOT NULL,
  `Class` int(1) NOT NULL,
  `Key` varchar(32) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `CSE09_CRs` (`Id`, `Name`, `Gender`, `Branch`, `Class`, `Key`) VALUES
('N081720', 'DUMMU KOTESWARI', 'F', 'CSE', 6, 'ynhw68i0x'),
('N082465', 'KUMBURU SURYA KUMARI', 'F', 'CSE', 2, 'sehirfu7o'),
('N082841', 'PALETI KEERTHI', 'F', 'CSE', 3, 's41h9nbug'),
('N083353', 'PATI RENUKA SATYA HEMALATHA', 'F', 'CSE', 4, 'q1i6yf4lm'),
('N090026', 'ADARI RAMU', 'M', 'CSE', 6, '3bm9a2y5q'),
('N090036', 'ALLAKA VENKATA VINAY', 'M', 'CSE', 5, 'cf238e6hq'),
('N090038', 'SONTI GOPINADH', 'M', 'CSE', 4, 'gfw32e1uo'),
('N090049', 'GONTHINA RAMA LINGA RAJENDRA KUMAR', 'M', 'CSE', 1, '3sk7mdixp'),
('N090055', 'KADUPUTLA RAMATULASI', 'F', 'CSE', 5, 'f9y0ki4ge'),
('N090102', 'TANNIRU RAJANI', 'F', 'CSE', 1, '1q45oyz3l'),
('N090121', 'ENAGADAPA NAGA VENKATA BHANUPRAKASH', 'M', 'CSE', 3, '1sl4fkvzo'),
('N090177', 'BASWA SANTHOSH', 'M', 'CSE', 2, 'zmrode1cp');

update `CSE09_Students` SET `Position`='CR' WHERE `Id` in (select `Id` from `CSE09_CRs`);


CREATE TABLE IF NOT EXISTS `CSE09_Admins` (
  `Id` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Branch` varchar(5) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);


CREATE TABLE IF NOT EXISTS `CSE09_Feedback` (
  `SNo` int(11) NOT NULL AUTO_INCREMENT,
  `Ftype` varchar(20) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Feedback` text NOT NULL,
  `Sentby` varchar(20) NOT NULL,
  `DateTime` varchar(30) NOT NULL,
  `IP` varchar(20) NOT NULL,
  PRIMARY KEY (`SNo`)
);


CREATE TABLE IF NOT EXISTS `CSE09_Logs` (
  `SNo` int(7) NOT NULL AUTO_INCREMENT,
  `Id` varchar(30) NOT NULL,
  `Location` varchar(80) NOT NULL,
  `Action` varchar(80) NOT NULL,
  `DateTime` varchar(30) NOT NULL,
  `Ip` varchar(15) NOT NULL,
  PRIMARY KEY (`SNo`),
  KEY `Id` (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

CREATE TABLE IF NOT EXISTS `CSE09_Notifications` (
  `SNo` int(5) NOT NULL AUTO_INCREMENT,
  `To` varchar(20) NOT NULL,
  `From` varchar(32) NOT NULL,
  `Subject` tinytext NOT NULL,
  `Message` text NOT NULL,
	`Attachment` text,
  `DateTime` varchar(20) NOT NULL,
  `IP` varchar(15) NOT NULL,
  PRIMARY KEY (`SNo`),
  KEY `From` (`From`),
	foreign key (`From`) references `CSE09_Students`(`Id`)
);

CREATE TABLE IF NOT EXISTS `CSE09_Pageviews` (
  `SNo` int(11) NOT NULL AUTO_INCREMENT,
  `Path` varchar(100) NOT NULL,
  `Visitor` varchar(50) NOT NULL,
  `DateTime` varchar(50) NOT NULL,
  `IP` varchar(20) NOT NULL,
  PRIMARY KEY (`SNo`)
);

CREATE TABLE IF NOT EXISTS `CSE09_Passwords` (
  `SNo` int(5) NOT NULL AUTO_INCREMENT,
  `To` varchar(7) NOT NULL,
  `Code` varchar(6) NOT NULL,
  `CreatedBy` varchar(20) NOT NULL,
  `StartTime` varchar(20) NOT NULL,
  `EndTime` varchar(20) NOT NULL,
  `Status` varchar(5) NOT NULL,
  `IP` varchar(15) NOT NULL,
  PRIMARY KEY (`SNo`),
  KEY `To` (`To`),
  KEY `CreatedBy` (`CreatedBy`),
	foreign key (`To`) references `CSE09_Students`(`Id`),
	foreign key (`CreatedBy`) references `CSE09_Students`(`Id`)
);


CREATE TABLE IF NOT EXISTS `CSE1_Dates` (
  `SNo` int(5) NOT NULL AUTO_INCREMENT,
  `Date` varchar(10) DEFAULT NULL,
  `P1` varchar(10) DEFAULT NULL,
  `P2` varchar(10) DEFAULT NULL,
  `P3` varchar(10) DEFAULT NULL,
  `P4` varchar(10) DEFAULT NULL,
  `P1_Con` varchar(10) DEFAULT NULL,
  `P2_Con` varchar(10) DEFAULT NULL,
  `P3_Con` varchar(10) DEFAULT NULL,
  `P4_Con` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`SNo`),
  UNIQUE KEY `Date` (`Date`)
);

CREATE TABLE IF NOT EXISTS `CSE2_Dates` (
  `SNo` int(5) NOT NULL AUTO_INCREMENT,
  `Date` varchar(10) DEFAULT NULL,
  `P1` varchar(10) DEFAULT NULL,
  `P2` varchar(10) DEFAULT NULL,
  `P3` varchar(10) DEFAULT NULL,
  `P4` varchar(10) DEFAULT NULL,
  `P1_Con` varchar(10) DEFAULT NULL,
  `P2_Con` varchar(10) DEFAULT NULL,
  `P3_Con` varchar(10) DEFAULT NULL,
  `P4_Con` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`SNo`),
  UNIQUE KEY `Date` (`Date`)
);

CREATE TABLE IF NOT EXISTS `CSE3_Dates` (
  `SNo` int(5) NOT NULL AUTO_INCREMENT,
  `Date` varchar(10) DEFAULT NULL,
  `P1` varchar(10) DEFAULT NULL,
  `P2` varchar(10) DEFAULT NULL,
  `P3` varchar(10) DEFAULT NULL,
  `P4` varchar(10) DEFAULT NULL,
  `P1_Con` varchar(10) DEFAULT NULL,
  `P2_Con` varchar(10) DEFAULT NULL,
  `P3_Con` varchar(10) DEFAULT NULL,
  `P4_Con` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`SNo`),
  UNIQUE KEY `Date` (`Date`)
);

CREATE TABLE IF NOT EXISTS `CSE4_Dates` (
  `SNo` int(5) NOT NULL AUTO_INCREMENT,
  `Date` varchar(10) DEFAULT NULL,
  `P1` varchar(10) DEFAULT NULL,
  `P2` varchar(10) DEFAULT NULL,
  `P3` varchar(10) DEFAULT NULL,
  `P4` varchar(10) DEFAULT NULL,
  `P1_Con` varchar(10) DEFAULT NULL,
  `P2_Con` varchar(10) DEFAULT NULL,
  `P3_Con` varchar(10) DEFAULT NULL,
  `P4_Con` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`SNo`),
  UNIQUE KEY `Date` (`Date`)
);

CREATE TABLE IF NOT EXISTS `CSE5_Dates` (
  `SNo` int(5) NOT NULL AUTO_INCREMENT,
  `Date` varchar(10) DEFAULT NULL,
  `P1` varchar(10) DEFAULT NULL,
  `P2` varchar(10) DEFAULT NULL,
  `P3` varchar(10) DEFAULT NULL,
  `P4` varchar(10) DEFAULT NULL,
  `P1_Con` varchar(10) DEFAULT NULL,
  `P2_Con` varchar(10) DEFAULT NULL,
  `P3_Con` varchar(10) DEFAULT NULL,
  `P4_Con` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`SNo`),
  UNIQUE KEY `Date` (`Date`)
);

CREATE TABLE IF NOT EXISTS `CSE6_Dates` (
  `SNo` int(5) NOT NULL AUTO_INCREMENT,
  `Date` varchar(10) DEFAULT NULL,
  `P1` varchar(10) DEFAULT NULL,
  `P2` varchar(10) DEFAULT NULL,
  `P3` varchar(10) DEFAULT NULL,
  `P4` varchar(10) DEFAULT NULL,
  `P1_Con` varchar(10) DEFAULT NULL,
  `P2_Con` varchar(10) DEFAULT NULL,
  `P3_Con` varchar(10) DEFAULT NULL,
  `P4_Con` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`SNo`),
  UNIQUE KEY `Date` (`Date`)
);



CREATE TABLE IF NOT EXISTS `CSE1_TimeTable` (
  `DayPeriod` varchar(2) NOT NULL,
  `Mon` varchar(10) NOT NULL,
  `Tue` varchar(10) NOT NULL,
  `Wed` varchar(10) NOT NULL,
  `Thu` varchar(10) NOT NULL,
  `Fri` varchar(10) NOT NULL,
  `Sat` varchar(10) NOT NULL,
  PRIMARY KEY (`DayPeriod`)
);

INSERT INTO `CSE1_TimeTable` (`DayPeriod`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`) VALUES
('P1', 'COAL', 'COA', 'COA', 'SH', 'COA', 'SH'),
('P2', 'AOA', 'PPL', 'COAL', 'AOA', 'PPLL', 'SH'),
('P3', 'TOC', 'TOC', 'PPL', 'TOC', 'SH', 'EX'),
('P4', 'PPLL', 'AOA', 'B', 'PPL', 'B', 'EX');


CREATE TABLE IF NOT EXISTS `CSE2_TimeTable` (
  `DayPeriod` varchar(2) NOT NULL,
  `Mon` varchar(10) NOT NULL,
  `Tue` varchar(10) NOT NULL,
  `Wed` varchar(10) NOT NULL,
  `Thu` varchar(10) NOT NULL,
  `Fri` varchar(10) NOT NULL,
  `Sat` varchar(10) NOT NULL,
  PRIMARY KEY (`DayPeriod`)
);

INSERT INTO `CSE2_TimeTable` (`DayPeriod`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`) VALUES
('P1', 'TOC', 'PPLL', 'PPL', 'COAL', 'PPLL', 'SH'),
('P2', 'PPL', 'COAL', 'SH', 'PPL', 'SH', 'SH'),
('P3', 'AOA', 'AOA', 'TOC', 'AOA', 'COA', 'EX'),
('P4', 'COA', 'TOC', 'B', 'COA', 'B', 'EX');


CREATE TABLE IF NOT EXISTS `CSE3_TimeTable` (
  `DayPeriod` varchar(2) NOT NULL,
  `Mon` varchar(10) NOT NULL,
  `Tue` varchar(10) NOT NULL,
  `Wed` varchar(10) NOT NULL,
  `Thu` varchar(10) NOT NULL,
  `Fri` varchar(10) NOT NULL,
  `Sat` varchar(10) NOT NULL,
  PRIMARY KEY (`DayPeriod`)
);

INSERT INTO `CSE3_TimeTable` (`DayPeriod`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`) VALUES
('P1', 'PPLL', 'AOA', 'SH', 'PPLL', 'AOA', 'SH'),
('P2', 'TOC', 'SH', 'TOC', 'COA', 'COAL', 'SH'),
('P3', 'COA', 'COA', 'AOA', 'PPL', 'PPL', 'EX'),
('P4', 'COAL', 'PPL', 'B', 'TOC', 'B', 'EX');


CREATE TABLE IF NOT EXISTS `CSE4_TimeTable` (
  `DayPeriod` varchar(2) NOT NULL,
  `Mon` varchar(10) NOT NULL,
  `Tue` varchar(10) NOT NULL,
  `Wed` varchar(10) NOT NULL,
  `Thu` varchar(10) NOT NULL,
  `Fri` varchar(10) NOT NULL,
  `Sat` varchar(10) NOT NULL,
  PRIMARY KEY (`DayPeriod`)
);

INSERT INTO `CSE4_TimeTable` (`DayPeriod`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`) VALUES
('P1', 'AOA', 'COA', 'PPLL', 'AOA', 'SH', 'SH'),
('P2', 'COAL', 'PPL', 'AOA', 'PPL', 'PPL', 'SH'),
('P3', 'PPLL', 'TOC', 'COAL', 'TOC', 'COA', 'EX'),
('P4', 'TOC', 'COA', 'B', 'SH', 'B', 'EX');


CREATE TABLE IF NOT EXISTS `CSE5_TimeTable` (
  `DayPeriod` varchar(2) NOT NULL,
  `Mon` varchar(10) NOT NULL,
  `Tue` varchar(10) NOT NULL,
  `Wed` varchar(10) NOT NULL,
  `Thu` varchar(10) NOT NULL,
  `Fri` varchar(10) NOT NULL,
  `Sat` varchar(10) NOT NULL,
  PRIMARY KEY (`DayPeriod`)
);

INSERT INTO `CSE5_TimeTable` (`DayPeriod`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`) VALUES
('P1', 'PPL', 'TOC', 'COA', 'PPLL', 'COA', 'SH'),
('P2', 'TOC', 'COAL', 'PPL', 'TOC', 'SH', 'SH'),
('P3', 'COA', 'AOA', 'AOA', 'COAL', 'AOA', 'EX'),
('P4', 'SH', 'PPLL', 'B', 'TOC', 'B', 'EX');

CREATE TABLE IF NOT EXISTS `CSE6_TimeTable` (
  `DayPeriod` varchar(2) NOT NULL,
  `Mon` varchar(10) NOT NULL,
  `Tue` varchar(10) NOT NULL,
  `Wed` varchar(10) NOT NULL,
  `Thu` varchar(10) NOT NULL,
  `Fri` varchar(10) NOT NULL,
  `Sat` varchar(10) NOT NULL,
  PRIMARY KEY (`DayPeriod`)
);

INSERT INTO `CSE6_TimeTable` (`DayPeriod`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`) VALUES
('P1', 'AOA', 'PPLL', 'TOC', 'AOA', 'PPLL', 'SH'),
('P2', 'SH', 'SH', 'COA', 'COA', 'TOC', 'SH'),
('P3', 'TOC', 'COA', 'PPL', 'PPL', 'PPL', 'EX'),
('P4', 'COAL', 'AOA', 'B', 'COAL', 'B', 'EX');

CREATE TABLE IF NOT EXISTS `CSE1_Cache` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE1_Cache` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '1'; 

CREATE TABLE IF NOT EXISTS `CSE2_Cache` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE2_Cache` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '2'; 

CREATE TABLE IF NOT EXISTS `CSE3_Cache` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE3_Cache` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '3'; 

CREATE TABLE IF NOT EXISTS `CSE4_Cache` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE4_Cache` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '4'; 

CREATE TABLE IF NOT EXISTS `CSE5_Cache` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE5_Cache` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '5'; 

CREATE TABLE IF NOT EXISTS `CSE6_Cache` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE6_Cache` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '6'; 
 

CREATE TABLE IF NOT EXISTS `CSE1_Attendance` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE1_Attendance` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '1'; 

CREATE TABLE IF NOT EXISTS `CSE2_Attendance` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE2_Attendance` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '2'; 

CREATE TABLE IF NOT EXISTS `CSE3_Attendance` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE3_Attendance` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '3'; 

CREATE TABLE IF NOT EXISTS `CSE4_Attendance` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE4_Attendance` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '4'; 

CREATE TABLE IF NOT EXISTS `CSE5_Attendance` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE5_Attendance` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '5'; 

CREATE TABLE IF NOT EXISTS `CSE6_Attendance` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE6_Attendance` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '6'; 
 
CREATE TABLE IF NOT EXISTS `CSE1_Subjects` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  `AOA_A` int(11) NOT NULL,
  `AOA_P` int(11) NOT NULL,
  `PPL_P` int(11) NOT NULL,
  `PPL_A` int(11) NOT NULL,
  `TOC_P` int(11) NOT NULL,
  `TOC_A` int(11) NOT NULL,
  `PPLL_P` int(11) NOT NULL,
  `PPLL_A` int(11) NOT NULL,
  `COAL_P` int(11) NOT NULL,
  `COAL_A` int(11) NOT NULL,
  `COA_A` int(11) NOT NULL,
  `COA_P` int(11) NOT NULL,
  `B_P` int(11) NOT NULL,
  `B_A` int(11) NOT NULL,
  `EX_A` int(11) NOT NULL,
  `EX_P` int(11) NOT NULL,
  `SH_A` int(11) NOT NULL,
  `SH_P` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE1_Subjects` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '1';

CREATE TABLE IF NOT EXISTS `CSE2_Subjects` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  `AOA_A` int(11) NOT NULL,
  `AOA_P` int(11) NOT NULL,
  `PPL_P` int(11) NOT NULL,
  `PPL_A` int(11) NOT NULL,
  `TOC_P` int(11) NOT NULL,
  `TOC_A` int(11) NOT NULL,
  `PPLL_P` int(11) NOT NULL,
  `PPLL_A` int(11) NOT NULL,
  `COAL_P` int(11) NOT NULL,
  `COAL_A` int(11) NOT NULL,
  `COA_A` int(11) NOT NULL,
  `COA_P` int(11) NOT NULL,
  `B_P` int(11) NOT NULL,
  `B_A` int(11) NOT NULL,
  `EX_A` int(11) NOT NULL,
  `EX_P` int(11) NOT NULL,
  `SH_A` int(11) NOT NULL,
  `SH_P` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE2_Subjects` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '2';

CREATE TABLE IF NOT EXISTS `CSE3_Subjects` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  `AOA_A` int(11) NOT NULL,
  `AOA_P` int(11) NOT NULL,
  `PPL_P` int(11) NOT NULL,
  `PPL_A` int(11) NOT NULL,
  `TOC_P` int(11) NOT NULL,
  `TOC_A` int(11) NOT NULL,
  `PPLL_P` int(11) NOT NULL,
  `PPLL_A` int(11) NOT NULL,
  `COAL_P` int(11) NOT NULL,
  `COAL_A` int(11) NOT NULL,
  `COA_A` int(11) NOT NULL,
  `COA_P` int(11) NOT NULL,
  `B_P` int(11) NOT NULL,
  `B_A` int(11) NOT NULL,
  `EX_A` int(11) NOT NULL,
  `EX_P` int(11) NOT NULL,
  `SH_A` int(11) NOT NULL,
  `SH_P` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE3_Subjects` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '3';

CREATE TABLE IF NOT EXISTS `CSE4_Subjects` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  `AOA_A` int(11) NOT NULL,
  `AOA_P` int(11) NOT NULL,
  `PPL_P` int(11) NOT NULL,
  `PPL_A` int(11) NOT NULL,
  `TOC_P` int(11) NOT NULL,
  `TOC_A` int(11) NOT NULL,
  `PPLL_P` int(11) NOT NULL,
  `PPLL_A` int(11) NOT NULL,
  `COAL_P` int(11) NOT NULL,
  `COAL_A` int(11) NOT NULL,
  `COA_A` int(11) NOT NULL,
  `COA_P` int(11) NOT NULL,
  `B_P` int(11) NOT NULL,
  `B_A` int(11) NOT NULL,
  `EX_A` int(11) NOT NULL,
  `EX_P` int(11) NOT NULL,
  `SH_A` int(11) NOT NULL,
  `SH_P` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE4_Subjects` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '4';

CREATE TABLE IF NOT EXISTS `CSE5_Subjects` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  `AOA_A` int(11) NOT NULL,
  `AOA_P` int(11) NOT NULL,
  `PPL_P` int(11) NOT NULL,
  `PPL_A` int(11) NOT NULL,
  `TOC_P` int(11) NOT NULL,
  `TOC_A` int(11) NOT NULL,
  `PPLL_P` int(11) NOT NULL,
  `PPLL_A` int(11) NOT NULL,
  `COAL_P` int(11) NOT NULL,
  `COAL_A` int(11) NOT NULL,
  `COA_A` int(11) NOT NULL,
  `COA_P` int(11) NOT NULL,
  `B_P` int(11) NOT NULL,
  `B_A` int(11) NOT NULL,
  `EX_A` int(11) NOT NULL,
  `EX_P` int(11) NOT NULL,
  `SH_A` int(11) NOT NULL,
  `SH_P` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE5_Subjects` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '5';

CREATE TABLE IF NOT EXISTS `CSE6_Subjects` (
  `Id` varchar(7) NOT NULL,
  `RNo` int(2) NOT NULL,
  `AOA_A` int(11) NOT NULL,
  `AOA_P` int(11) NOT NULL,
  `PPL_P` int(11) NOT NULL,
  `PPL_A` int(11) NOT NULL,
  `TOC_P` int(11) NOT NULL,
  `TOC_A` int(11) NOT NULL,
  `PPLL_P` int(11) NOT NULL,
  `PPLL_A` int(11) NOT NULL,
  `COAL_P` int(11) NOT NULL,
  `COAL_A` int(11) NOT NULL,
  `COA_A` int(11) NOT NULL,
  `COA_P` int(11) NOT NULL,
  `B_P` int(11) NOT NULL,
  `B_A` int(11) NOT NULL,
  `EX_A` int(11) NOT NULL,
  `EX_P` int(11) NOT NULL,
  `SH_A` int(11) NOT NULL,
  `SH_P` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
	foreign key (`Id`) references `CSE09_Students`(`Id`)
);

insert into `CSE6_Subjects` (`Id`, `RNo`) select `Id`, `RNo` from `CSE09_Students` where `Class` = '6';


