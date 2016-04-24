Feature: Uploading CSV files

Scenario: Upload with correct information, should populate transaction field

Given I am on the main page trying to upload a small csv file
When I specify and submit a file with correct info
And I click upload
Then I should see the new transactions
	