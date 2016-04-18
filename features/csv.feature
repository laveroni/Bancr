Feature: Uploading CSV files
As a user, I want to upload files to update my accounts with data of past transactions

Scenario: Upload with missing information

Given I am on the main page trying to upload a cvs file
When I choose an invalid file
Then I should see an error popup


Scenario: Upload with correct information
When I specify and submit a file with correct information
Then I see the error message

	