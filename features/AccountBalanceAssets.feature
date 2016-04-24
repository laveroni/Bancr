Feature: Checking balances

Scenario: User uploads CSV, balance should update correctly for Assets account 

Given I am on the main page and trying to find balances
When I upload Csv file for user2
And I click the upload button3
Then I should see correct balance for assets account
