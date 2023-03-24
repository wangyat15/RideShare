# CS804 Web Application Development Project
<img src="https://github.com/wangyat15/RideShare/blob/c9d9061dd8352d291e153a6a7dfcfa10eec69a78/SRide%20Logo.png" width="300"/>

[Constructor University](https://constructor.university/)

Professor : Dr. Mohammed Elhajj

Student   : Wang Yat SIN

Project preview URL (project status undergoing - completed Phase#2 Conceptual and UI design) : 

https://htmlpreview.github.io/?https://github.com/wangyat15/RideShare/blob/main/index.html

# Project Title : Ride Share Website
(Project status: completed Phase#2 - UI design and frontend development)

## 1.	Introduction

The objective of this application is to enable people to save money by sharing a taxi or car ride to a common destination. While there is significant competition in the online car booking service industry (such as Uber), services that allow people to share the same car to reach a common destination are relatively lesser known. Therefore, I believe this proposal has the potential to expand on this niche field and attract new users who are actively seeking this type of service. I will provide further details on how this application would work below.

## 2.	Problem statement

While taxi fees may be expensive for many people, it is often the most convenient and direct way to reach a desired destination. On the other hand, opting for public transport may be cheaper, but it often involves taking indirect routes that can be time-consuming. Additionally, public transport may experience unexpected delays, which can further prolong travel time. Driving a car is not always a feasible solution either, as fuel costs can be expensive and traffic congestion during peak hours is common in more crowded areas. Furthermore, finding parking can also be a challenge. Promoting the use of private cars may also contribute to air pollution, as an increase in cars on the road could lead to more emissions.  

## 3.	Problem solution

Solution for Ridesharing as reducing traffic congestion and parking problem, and more importantly the air pollution problem of the world.

### For car drivers
+ Provide rideshare offer with details on date and time of the route, start location, destination, path in map, no of seats available and fare
+ Search for passengers with locations, date and time, past rating and comments of the passenger.  If a passenger is found, send a rideshare request to that passenger

### For passengers 
+ make a rideshare request with details on date and time of the ride, pickup location, destination location and fare
+ search for the rideshare offer with locations, date and time, and past rating and comments of the driver.  If a rideshare is found, make a rideshare request to the driver
+ Alternatively, after booking a taxi ride, the passenger can make a rideshare offer with details on date and time of the route, start location, destination, path in map, no of seats available and price (taxi fee can be equally shared by the participants)

### When matching the rideshare offer and request
+ a rideshare offer can match with multiple passenger requests based on no. of available seats
+ Rideshare offer and request can be either accepted or rejected by either party 
+ if the rideshare is accepted by both parties, it will be confirmed the rideshare with pickup date, time, location and fare
 
### After a rideshare is completed
+ both driver and passenger will give rating and comment to the other party for future rideshare reference.

## 4.	Technical Details
### Software
+ Code editor and IDE: [Visual Studio Code](https://code.visualstudio.com/)
+ Client side: HTML, CSS, JavaScript, JQuery and Ajax with responsive mobile friendly design
+ Server side: [Ubuntu, Apache](https://ubuntu.com/) and [PHP](https://www.php.net/)
+ Database and Database GUI tool: [MySQL](https://www.mysql.com/) and [Workbench](https://dev.mysql.com/downloads/workbench/)

### Other tools
This website adopts a number of [Google Map APIs](https://developers.google.com/maps) for 
+	inputting location address with autocomplete using Google Map API with Place Library 
+	computing the driving distance and time between the start and destination locations 
+ showing  the driving path and distance between the start and destination locations on the map
+ locating and finding the nearby address coordinates within specified distance in km

### Server and hosting
+ Source repository : [GitHub](https://github.com/)
+ Website hosting service : cloud hosting services for servers and websites (To be determined) 
