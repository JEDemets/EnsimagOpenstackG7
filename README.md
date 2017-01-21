# EnsimagOpenstackG7

## Our Team:

* CAZZOLLA Danilo - email
* PLOUVIER DEMETS Jules-Eugène - email
* LA QUATRA Moreno - moreno.la-quatra@grenoble-inp.org
* NICHIFOR Cosmin - email


## Application
The application start in the main -> index.php page, it's contacted by outside and it take in charge all the application steps.  

Starting from that page, an user can insert his user_id and it will be used to make different request to the microservices of the application. The page dinamically adapt to the different cases, retrieving info from the various microservices contacted through GET requests.


## Used Library and Languages
For the application, we used as primary programming language PHP and php-curl library to make GET requests.
The interface with the Object Storage has been done using the library php-opencloud (https://github.com/rackspace/php-opencloud) that make us able to create different request to swift and to achieve the authentication with the Database.
