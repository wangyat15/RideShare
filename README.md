# CS804 Web Application Development Project
# Ride Share Website  SRide
<img src="https://github.com/wangyat15/RideShare/blob/c9d9061dd8352d291e153a6a7dfcfa10eec69a78/SRide%20Logo.png" width="300"/>

Constructor University

Professor : Dr. Mohammed Elhajj

Student   : Wang Yat SIN


Project Title : Ride Share Website

1.	Introduction

The objective of this application is to let people to save money by sharing a taxi ride or a car ride. There is a lot of competition for online car booking service (like Uber). But a service where people can share the same car to go to the same destination are rather less well-known. Therefore, I think this proposal would be a good idea to expand on that niche field which could easily attract more new-users who are exactly looking for this type of service. I will go over the detail on how this application would work below.

2.	Problem statement

Taxi fee is expensive for most of the people but it’s the most convenient and it takes the direct and fastest route to the desired destination. On the other hand, when people choose public transport, while it will be cheaper. However, there are usually no direct route to the desired destination. On top of that, public transport might have unexpected delay, hence taking longer than expected to arrive to destination. Driving car is not exactly a feasible solution as well, not only car fuel is expensive. Especially during work hours, there are constant traffic jams in more crowded areas. At the end, they will need to find a place to park their vehicle. Encouraging the usage of private car will also create more air pollution, because they could have used public transport.

3.	Problem solution

Solution for Ridesharing as reducing traffic congestion and parking problem, and more importantly the air pollution problem of the world.

For car drivers

-Provide rideshare offer with details: date and time of the route, start location, destination, path in map, no of seats available and price (about 1/4 of taxi ride)

-Search for the rideshare request with locations, date and time, past rating and comments.  If a rideshare request is found, send a rideshare offer to passengers

For passengers 

-make a rideshare request with details: date and time of the ride, pickup location, destination location, offer price (about 1/4 of taxi ride)

-search for the rideshare offer with locations, date and time, and past rating and comments.  If a rideshare offer is found, make a rideshare request to the driver

-Alternatively, after booking a taxi ride, the passenger can make a rideshare offer with details: date and time of the route, start location, destination, path in map, no of seats available and price (taxi fee equally shared by the participants)

When matching the rideshare offer and request

-a rideshare offer can match with multiple rideshare requests based on no. of available seats

-Rideshare offer and request can be either accepted or rejected by either party 

-if the rideshare is accepted by both parties, it will be confirmed with pickup date, time, location and price

When rideshare is completed

-After the rideshare is completed, both driver and passenger will give rating and comment to the other party for future rideshare reference.

