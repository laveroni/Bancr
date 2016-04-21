Feature: Uploading CSV files
As a user, I want to upload files to update my accounts with data of past transactions

Scenario: Upload with missing/incorrect information

Given I am on the main page trying to upload a csv file1
When I choose an invalid file
Then I should see an error popup

	