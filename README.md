# EnsimagOpenstackG7

## Our Team:

* CAZZOLLA Danilo - email
* LA QUATRA Moreno - moreno.la-quatra@grenoble-inp.org
* NICHIFOR Cosmin - email
* PLOUVIER DEMETS Jules-Eugène - email


## Application
The application start in the main -> index.php page, it's contacted by outside and it take in charge all the application steps.  

Starting from that page, an user can insert his userID and it will be used to make different request to the microservices of the application. The page dinamically adapt to the different cases, retrieving info from the various microservices contacted through GET requests.

* **Service Worker**

This service has been given by HP team, python script that answer to GET requests giving an image

* **Service Picture**

It's the interface beetween the _Main Server_ and the Object Storage(Swift). It answer to GET request using the setted field userid. It answer with a Json array in which we can find an image or an error code if something goes wrong. In this server we used the php library php-opencloud that allow us to interact with Swift in a confortable way.

* **Service Button**

It's the interface between the _Main Server_ and the Worker, he does all the necessaries transactions to play the game following this steps:
 - Retrieve UserID from the GET request.
 - Do th GET request to the Worker.
 - Update database for the status of the user.
 - Upload retrieved image in Swift
 - Answer the request with OK or error message.
 
Also in that case we used the php-opencloud library to interact with Swift.

* **Service Status**

It's used to retrieve information for the user status by _Service Button_ and _Service Main_. It answer to GET request searching for the status of the setted userID

* **Sevice Identification**

It's the interface between the _Main Server_ and the Database (integrated into it). He retrieve for the userID information about it as Name and Surname. 

------> ATTENTION ADD DATABASE PART

## Used Library and Languages
For the application, we used as primary programming language **PHP** and _php-curl_ library to make GET requests.
The interface with the Object Storage (Swift) has been done using the library _php-opencloud_ (https://github.com/rackspace/php-opencloud) that make us able to create different request to swift and to achieve the authentication with the Database.
