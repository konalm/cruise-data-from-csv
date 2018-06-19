# cruise-data-from-csv

Test to display data from a cruise data from a CSV file in a web page. 

This is a test answer. 

## Caveats 

Purposely not included for this test are the following; <br />
  * Unit Tests Suite <br />
  * E2E Test Suite <br />
  * Automatically generated API documentation <br />
  * Credentials are only included in version control for the purposes of this test. <br />
 
## Install Dependencies 

Within the /api directory run 'composer install'.

## Deploy

Add your DB credentials to /api/phinxy.yml <br />
Add your DB credentials to /api/src/settings.php  <br />
Run 'composer db-migrate' in /api/ directory<br />
Run 'php -S localhost:8001' in root directory <br />
(if you choose to run on seperate port you will need to alter apiUrl variable in index.js)

## Import CSV file into DB 

Hit endpoint 'http://localhost:8001/api/public/csv-to-db' 


## Running

Go to http://localhost:8001 in browser to application running. 
