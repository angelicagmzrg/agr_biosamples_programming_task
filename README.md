# Project Title

Biosamples programming

## Getting Started

These instructions will get you a copy of the project up and running on your local machine.

### Prerequisites

Apache, Php
You should register in:https://aai.ebi.ac.uk/registerUser  to get your credentilas (username and password) that will be required in the forms

### Installing

You should download the php files in the \xampp\htdocs 

## Running the client

* Start Service Apache from xampp
* Go to localhost:80 or port where apache has been started and add: /agr_embl_numbersamples.php for getting number of samples (search   for "totalElements" in the string result when you submit the form).  You'll need the username and password you got from registering in
https://aai.ebi.ac.uk/registerUser
* /agr_embl_accname.php for getting accession name from an accession given by the user.  
* /agr_embl_accsamples.php for retrieving accessions of samples from an attribute and a value given by the user

## Built With

* XAMPP (https://www.apachefriends.org/index.html) - The Apache distribution
* PHP tool for Visual Studio 

## Authors

* **Angélica Gómez Roig** - *Initial work* - (https://github.com/angelicagmzrg)


## Acknowledgments

* https://www.ebi.ac.uk/biosamples/docs/references/api
* https://www.ebi.ac.uk/biosamples/docs/references/filters


