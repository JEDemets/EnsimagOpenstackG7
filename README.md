# EnsimagOpenstackG7

## Our Team:

* CAZZOLLA Danilo - danilo.cazzolla@grenoble-inp.org
* LA QUATRA Moreno - moreno.la-quatra@grenoble-inp.org
* NICHIFOR Cosmin - email
* PLOUVIER DEMETS Jules-Eugène - jules-eugene.demets@grenoble-inp.org


## Application

The user interface with application start in the Main server, the only one accessible from internet. The application is a modular one and will interact with different services.

Starting from that server page (index.php on Main Server), an user can insert his userID and it will be used to make different request to the microservices of the application. The page dinamically adapt to the different cases, retrieving info from the various microservices contacted through GET requests.

* **Service Worker**

This service has been given by HP team, python script that answer to GET requests giving an image

* **Service Picture**

It's the interface beetween the _Main Server_ and the Object Storage(Swift). It answer to GET request using the setted field userid. It answer with a Json array in which we can find an image or an error code if something goes wrong. In this server we used the php library _php-opencloud_ that allow us to interact with Swift in a confortable way.

* **Service Button**

It's the interface between the _Main Server_ and the Worker, he does all the necessaries transactions to play the game following this steps:
 - Retrieve UserID from the GET request.
 - Do th GET request to the Worker.
 - Update database for the status of the user.
 - Upload retrieved image in Swift
 - Answer the request with OK or error message. If OK an automatic email is sent to advice the administrator (using cURL and Mailgun Service).
 
Also in that case we used the php-opencloud library to interact with Swift.

* **Service Status**

It's used to retrieve information for the user status by _Service Button_ and _Service Main_. It answer to GET request searching for the status of the setted userID

* **Service Identification**

It's the interface between the _Main Server_ and the Database (integrated into it). It stores and retrieves general information about users and keeps track of their activities on the site. Its activity data are particularly focused on checking that each user should be able to play and "get his gift" only once. Further tentatives to play again will be stopped with a message showing the gift already obtained, as the database keeps this information as well. The MySQL system relays on Debian OS 

* **Service Main**

It's the main interface for the user, it's accessible from outside and it will retrieve all the information needed asking to the other servers of the applications. All the comunications between servers are stateless and use GET request. This page will act differently basing on the field userid of the get request setted or not. 

NB. This page use also Javascript and could have some problem if it's disactivated.

## Used Library and Languages
For the application, we used as primary programming language **PHP** and _php-curl_ library to make GET requests.

The interface with the Object Storage (Swift) has been done using the library _php-opencloud_ (https://github.com/rackspace/php-opencloud) that make us able to create different request to swift and to achieve the authentication with the Database.

The interface with MySQL server is done using the library _php-mysql_ that allow us to make all the transaction we need with the Database.

##Architecture
![image of architecture]
(https://github.com/JEDemets/EnsimagOpenstackG7/blob/application_structure/schema.png)

