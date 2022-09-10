CREATE TABLE IF NOT EXISTS region(
rID INT auto_increment PRIMARY KEY, rName CHAR(30));

CREATE TABLE IF NOT EXISTS country (
cID INT auto_increment PRIMARY KEY, rID INT,
cName CHAR(30),
FOREIGN KEY (rID) REFERENCES region(rID));

CREATE TABLE IF NOT EXISTS proStaTer(
pstID INT auto_increment PRIMARY KEY, cID INT,
pstName CHAR(30),
pop bigINT,
FOREIGN KEY (cID) REFERENCES country(cID));

CREATE TABLE IF NOT EXISTS pstRecord(
recID INT auto_increment PRIMARY KEY,
pstID INT,
infected bigINT,
dead bigINT,
dateOf date,
FOREIGN KEY (pstID) REFERENCES proStaTer(pstID));

CREATE TABLE IF NOT EXISTS vaccine(vID INT auto_increment PRIMARY KEY,
vName CHAR(30));
CREATE TABLE IF NOT EXISTS vacRecord(
vrID INT auto_increment PRIMARY KEY,
pstID INT,
vID INT,
vaccinated bigINT,
infected bigINT,
dead bigINT,
dateOf date,
FOREIGN KEY (pstID) REFERENCES proStaTer(pstID), FOREIGN KEY (vID) REFERENCES vaccine(vID));

CREATE TABLE IF NOT EXISTS privilege(
privID INT auto_increment PRIMARY KEY,
privName CHAR(30),
constraINT CK_privName check( privName in('Researcher', 'Administrator', 'Delegate',
'Regular')) );
CREATE TABLE IF NOT EXISTS orgType(
otID INT auto_increment PRIMARY KEY,
typeName CHAR(30),
constraINT CK_typeName check(typeName in ('OrgGovAgencies', 'OrgCompany', 'OrgResearchCenter')));

CREATE TABLE IF NOT EXISTS organization(
oID INT auto_increment PRIMARY KEY,
otID INT,
oName CHAR(30),
FOREIGN KEY (otID) REFERENCES orgType(otID));

CREATE TABLE IF NOT EXISTS users(
uID INT auto_increment PRIMARY KEY, cID INT,
privID INT,
fName CHAR (30) NOT null,
lName CHAR (30) NOT null, email varCHAR(50),phone varCHAR(50),
dob date,
status enum('Active', 'Suspended') default 'Active',
FOREIGN KEY (cID) REFERENCES country(cID),
FOREIGN KEY (privID) REFERENCES privilege(privID) );

CREATE TABLE IF NOT EXISTS employeeOfOrg( oID INT,
uID INT,
FOREIGN KEY (oID) REFERENCES organization(oID),
FOREIGN KEY (uID) REFERENCES users(uID),
constraINT PK_employeeOfOrg_oIDuID PRIMARY KEY (oID, uID));

CREATE TABLE IF NOT EXISTS govOfCountry( cID INT,
oID INT,
FOREIGN KEY (cID) REFERENCES country(cID),
FOREIGN KEY (oID) REFERENCES organization(oID),
constraINT PK_govOfCountry_cIDoID PRIMARY KEY (cID, oID));

CREATE TABLE IF NOT EXISTS specialUser( uID INT,
username CHAR(30) PRIMARY KEY,
pwd CHAR(30),
FOREIGN KEY (uID) REFERENCES users(uID));

CREATE TABLE IF NOT EXISTS followers(author varCHAR(96),
username CHAR(30),
constraINT PK_followers_authorusername PRIMARY KEY (author, username));
CREATE TABLE IF NOT EXISTS article(
aID INT auto_increment PRIMARY KEY, author varCHAR(96),
majorT text,
minorT mediumtext,
summary CHAR(100), articleContent longtext NOT null, dop date,
11
status varCHAR(16) default 'posted',
constraINT CK_article_status check(status in ('posted', 'removed')));

CREATE TABLE IF NOT EXISTS emailRecord(
eID INT auto_increment PRIMARY KEY, dateOf date,
email CHAR(50),
subject CHAR(100),
body longtext NOT null);

CREATE TABLE IF NOT EXISTS suspensionRecord(uID INT,
dateTimeOf dateTime,
FOREIGN KEY (uID) REFERENCES users(uID));

CREATE TABLE IF NOT EXISTS removalRecord(aID INT,
dateTimeOf dateTime,
FOREIGN KEY (aID) REFERENCES article(aID));