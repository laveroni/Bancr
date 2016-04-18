Feature: Uploading CSV files
As a user, I want to upload files to update my accounts with data of past transactions

Scenario: Upload with correct information

Given I am on the main page trying to upload a csv file
When I specify and submit a file with correct information
And I click the upload button
Then I see the correct message
	