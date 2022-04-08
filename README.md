# Backend Challenge

## Learning Competencies
- Challenge understanding.
- Implement Object Oriented Desing, DDD, patterns and best practices.
- Implement tests.
- Manipulate Input/Output correctly.

## The challenge
We've received a user story from product team.
A group of electric vehicles (EV) with autopilot are being landed by Wallbox on a city.
The area of that city, which is curiously rectangular, must be navigated by these EVs so that their on-board webcams and detectors can get a complete view of the surrounding terrain.
A EV's position and location is represented by a combination of x and y coordinates, and a letter representing one of the four cardinal compass points.
**The area is divided up into a grid to simplify the navigation.** An example position might be 0, 0, N, which means the EV is in the bottom left corner and facing North.
All the EVs are positionated in the city area, and to represent that we'll get an input like `0, 0, N`, being the first digit the x axis and the second one y axis and the last letter is the direction where the EV is heading.
Taking into account that the only possible letters are: N, E, S and W.
The EVs can only receive the following instructions: R, L and M (move forward).
'R' and 'L' make the rover spin 90 degrees left or right respectively, without moving from its current spot. 'M' means move forward one grid point, and maintain the same heading.

---

## INPUT:
The first line of input is the upper-right coordinates of the area (akka area limit), the lower-left coordinates are assumed to be 0,0.
The rest of the input is information pertaining to the EVs that have been deployed. Each EV should has two lines of input.
The first line gives the EV's position, and the second line is a series of instructions telling the EV how to explore the area.
The position is made up of two integers, and a letter separated by spaces, corresponding to the x and y co-ordinates and the EV's orientation.
Each EV will be finished sequentially, which means that the second EV won't start to move until the first one has finished moving.
Take into account that only one EV can be in the same position.

## OUTPUT
The output for each EV should be its final co-ordinates and heading.

---

## Input Cheat Sheet
The output for each EV should be its final co-ordinates and heading.

# Test Input:
```
5 5
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM
```

# Expected Output:
```
1 3 N
5 1 E
```


How to validate the Test?
--

By PHP
---

```
#install composer
composer install

#run the test
php vendor/bin/phpunit --testdox

#play with the robot
php bin/console kata:electronic-vehicle:move 
```

By Makefile and Docker (the easiest step)
---

```
#to run all step into one step 
make run-app

#to run only the tests
make tests-unit

#to run only command kata
make move-ev
```

With Docker Compose (the hardest step)
---

```
#to create the container of php
docker-compose up -d php

#install composer
docker-compose exec php composer install

#run the test
docker-compose exec php vendor/bin/phpunit --testdox

#play with the robot
docker-compose exec php bin/console kata:electronic-vehicle:move 

#access to the container
docker-compose exec php bash 


```

```
RESULTS

php bin/console kata:electronic-vehicle:move  

ELECTRONIC VEHICLE
==================

                                                                                                                        
 [INFO] Reading the instructions...                                                                                     
                                                                                                                        

                                                                                                                        
 [INFO] Creating the grid area and Send the instructions to all rovers...                                               
                                                                                                                        

OUTPUT
======

 1 3 N
 5 1 E

```

Assumptions
--
* Assuming docker compose is used
* Valid values for movements are: L,R,M. 
* Valid values for cardinal points are: N,S,E,W.
* Assumed the bottom-left coordinates for grid are 0,0. So, coordinates cannot be a negative value.
* Exception will be thrown if a mower tries to move out of the grid size.
* Exception will be thrown if the file is not following the correct structure.