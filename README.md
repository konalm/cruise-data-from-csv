# cruise-data-from-csv

Test to display data from a cruise data from a CSV file in a web page. 

This is a test answer. 

## Caveats 

Purposely not included for this test are the following; u
  * Unit Tests Suite
  * E2E Test Suite
  * Automatically generated API documentation
  * Credentials are only included for the purposes of this test. 
 
## Install Dependencies 

Within the /api directory run 'composer install'.

## Deploy

Add your DB credentials to /api/phinxy.yml
Add your DB credentials to /api/src/settings.php 
Run 'composer db-migrate'
Run 'composer start'


## Import CSV file into DB 

Hit endpoint 'http://localhost:8001/api/public/db-to-csv' 


## Running

Go to http://localhost:8001 in browser to application running. 
