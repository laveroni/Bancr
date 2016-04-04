Feature: Uploading CSV files
As a user, I want to upload files to update my accounts with data of past transactions

Scenario: Upload with missing information

Given I am on the main page trying to upload a cvs file
When I specify and submit a file with missing information
Then I see the error message “This file is missing parameters”

Scenario: Upload with incorrect information
Given
When I choose to submit a file with incorrect data or parameters
Then I see the error message “This file has invalid parameters”

Scenario: Upload with correct information
Given
When I choose a file with the proper format
Then I see the message “File Uploaded” and see my bank accounts update

	