# MUSE
Management of University Student Enrollment records project for SOFE 3700U, Data Management Systems

Group 9: Adris Azimi, Abida Choudhury, Daniel Gohara Kamel, Jessica Leishman


## Table of Contents
- ### [Code](https://github.com/DanielKamel2001/MUSE/tree/main/Code)
    - [components](https://github.com/DanielKamel2001/MUSE/tree/main/Code/components)
        - [dbConnection.php](https://github.com/DanielKamel2001/MUSE/blob/main/Code/components/dbConnection.php)
        - [fonts.php](https://github.com/DanielKamel2001/MUSE/blob/main/Code/components/fonts.php)
        - [imports.php](https://github.com/DanielKamel2001/MUSE/blob/main/Code/components/imports.php)
        - [script.js](https://github.com/DanielKamel2001/MUSE/blob/main/Code/components/script.js)
    - [style](https://github.com/DanielKamel2001/MUSE/tree/main/Code/style)
        - [enrollment.css](https://github.com/DanielKamel2001/MUSE/blob/main/Code/style/enrollment.css)
        - [global.css](https://github.com/DanielKamel2001/MUSE/blob/main/Code/style/global.css)
        - [headerStyle.css](https://github.com/DanielKamel2001/MUSE/blob/main/Code/style/headerStyle.css)
        - [loginStyle.css](https://github.com/DanielKamel2001/MUSE/blob/main/Code/style/loginStyle.css)
        - [map.css](https://github.com/DanielKamel2001/MUSE/blob/main/Code/style/map.css)
    - [deptStats.php](https://github.com/DanielKamel2001/MUSE/blob/main/Code/deptStats.php)
    - [home.php](https://github.com/DanielKamel2001/MUSE/blob/main/Code/home.php)
    - [index.php](https://github.com/DanielKamel2001/MUSE/blob/main/Code/index.php)
    - [map.html](https://github.com/DanielKamel2001/MUSE/blob/main/Code/map.html)
    - [map.js](https://github.com/DanielKamel2001/MUSE/blob/main/Code/map.js)
    - [map.php](https://github.com/DanielKamel2001/MUSE/blob/main/Code/map.php)
    - [php.ini](https://github.com/DanielKamel2001/MUSE/blob/main/Code/php.ini)
    - [records.php](https://github.com/DanielKamel2001/MUSE/blob/main/Code/records.php)

- ### [Database Copy and CSVs](https://github.com/DanielKamel2001/MUSE/tree/main/Database%20Copy%20and%20CSVs)
    - [Database creation SQL code](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/DatabaseExport.sql)
    - [belongs_to.csv](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/belongs_to.csv)
    - [course.csv](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/course.csv)
    - [enrolled.csv](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/enrolled.csv)
    - [linked_sections.csv](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/linked_sections.csv)
    - [prerequisite.csv](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/prerequisite.csv)
    - [program_courses.csv](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/program_courses.csv)
    - [sections.csv](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/sections.csv)
    - [staff.csv](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/staff.csv)
    - [student.csv](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/student.csv)
    
- ### [Project Overview](https://github.com/DanielKamel2001/MUSE#project-overview-1)

- ### [Installation instructions (Windows)](https://github.com/DanielKamel2001/MUSE#installation-instructions)
    - [Setting Up WAMP server](https://github.com/DanielKamel2001/MUSE#setting-up-wamp-server)
    - [Downloading the Frontend Application from Github](https://github.com/DanielKamel2001/MUSE#downloading-the-frontend-application-from-github)
    - [Setting up the sample database](https://github.com/DanielKamel2001/MUSE#setting-up-the-sample-database)
    - [Modifying the database configuration instructions (php.ini)](https://github.com/DanielKamel2001/MUSE#modifying-the-database-configuration-instructions)
    - [Running the Project](https://github.com/DanielKamel2001/MUSE#running-the-project)

- ### [System Design](https://github.com/DanielKamel2001/MUSE#system-design-1)
    - [Use Case Diagram](https://github.com/DanielKamel2001/MUSE/blob/main/Use%20Case%20Diagram.png)
    - [System Navigation Flowchart](https://github.com/DanielKamel2001/MUSE/blob/main/System%20Navigation%20Flowchart.png)
    - [System Layer Diagram](https://github.com/DanielKamel2001/MUSE/blob/main/System%20Layer%20Diagram.png)

- ### [Next Steps](https://github.com/DanielKamel2001/MUSE#next-steps-1)

<br>

## Project Overview
This project initially began with the goal of creating a MyCampus alternative with a focus on visual navigation with effective data entry and display. As the development of MUSE began however, it became clear that the application could better fulfil a more specific need of its primary users, professors and students, by focusing on providing useful information in a central place.

MUSE builds onto an existing application such as MyCampus, RAMSS (Ryerson), SOLUS (Queen’s), or Quest (Waterloo) to present key statistics of the university enrollment record database attached to the system.  The views it displays are valuable information for users such as academic performance grouped by highschool, students on academic probation, academic transcripts, teacher course sections for the year, identifying students to TA or receive academic awards, and even allows the creation of a professor and associated departments directory.

## Installation Instructions
Detailed instructions with images showing the step-by-step process can be found in Appendix B of the [Final Report pdf]().

### Setting Up WAMP server
Though any different web server hosting program can be used, this project used WAMP server hosting for local hosting with PHP and MySQL. If another program is used please be mindful of how you set up the application with this guide.

To use Wamp Server, download it and install it from the website: https://www.wampserver.com/en/,
or mirror sourceforge link: https://sourceforge.net/projects/wampserver/files/. 

### Downloading the Frontend Application from Github
The MUSE frontend web application can be downloaded from the github repository.
First, the code must be downloaded from the github repository.
Unzip the archive downloaded using a service such as 7zip or Windows 10 built in features, and copy-and-paste the contents of the MUSE-main folder into your WAMPserver www localhost folder.
The WAMPserver www folder can be accessed by running the Wampserver64 local server application, clicking on the tray icon, and then selecting the www directory folder.

### Setting up the sample database
Included in the git repository is a file titled [DatabaseExport.sql](https://github.com/DanielKamel2001/MUSE/blob/main/Database%20Copy%20and%20CSVs/DatabaseExport.sql), this file is a series of MySQL statements that was created by using WAMPSERVERs phpMyAdmin feature. The database can be created by using the import feature of phpMyAdmin or by running the file in MySQL Workbench.

### Modifying the database configuration instructions
Also included in the project zip obtained from the Github repository is a file called php.ini. This must be kept in the main project folder. Please modify this file to include the configuration details of the location of your local database, as shown below.
```
; Database config credentials
; Please change this file to match how you have your mysql database configured 

[db_config]
ip = "localhost"
user = "root"
password = ""
database = "ENROLLMENT_RECORDS"
 ```
### Running the Project
To run the application start the wamp server instance and navigate to the localhost in your browser with the path inside your www folder.

**Test login data:**

Student login:
 ID Number: 1, Password: 20020724
 
Staff login:
 ID Number: 15, Password: 19570810


## System Design
### Use Case Diagram
![MUSE Use Case Diagram](https://github.com/DanielKamel2001/MUSE/blob/main/Use%20Case%20Diagram.png)

**Use Case Descriptions:**
ID | Title | Description |
|---|---|---|
 UC1 | Login | A professor or student logs into their respective MUSE account, once logged in each user only has access to information related to their role. 
UC2 | Logout | The user logs out of their account and is presented with the initial login page
UC3 | Access Department Statistics |A professor or student attempts to view the department statistics page from either the home page or navigation bar. The associated views relating to the various departments in the database is displayed |
UC4 | Access Professor Sections / Records | A professor attempts to view their records page. The page is loaded with the professor’s class sections for the current year, student performance in each class by highschool, students on academic probation, students with a GPA of 3.7 or higher to be eligible for an academic award, students in residence grouped by highschool, and the grades of students in the professor’s past courses.|
UC5 | Access Personal Transcript / Records |A student attempts to view the records page and the page is loaded with views and information relevant to students and that student in particular |
UC6 | Student Address Heatmap |A user accesses the Student Address Heatmap page and is presented with a Google map view of the school with options to customize how the information appears. |

### System Navigation Flowchart
![MUSE System Navigation Flowchart](https://github.com/DanielKamel2001/MUSE/blob/main/System%20Navigation%20Flowchart.png)

### System Layer Diagram
![MUSE System Layer Diagram](https://github.com/DanielKamel2001/MUSE/blob/main/System%20Layer%20Diagram.png)

## Next Steps
Some of the next steps for development could include further research into Google APIs such as Google Sheets API, to be leveraged for different visual representations of data and searchable tables.  Additionally, views could be further customized to the viewing-professor’s department, such that a Mechatronics professor would be presented with Mechatronics exclusive department and class statistics.  This would further improve the versatility of MUSE and allow it to better serve its users.

Another improvement that could be made to the system would be introducing more classes of users, and formally separating administrator permissions from the professors.  Should MUSE be integrated with other academic services that are used to track student performance, only administrators would be able to perform the actual modification of the database to prevent user misuse.  

Finally, the last improvement the team would like to implement moving forward would be the use of a cloud database, to enable the deployment of the system across multiple computers and for multiple users to access the database from their own local application.




