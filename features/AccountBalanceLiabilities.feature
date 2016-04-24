Feature: Checking balances

Scenario: User uploads CSV, balance should update correctly for Liabilities account 

Given I am on the main page and trying to find balance
When I upload Csv file for user
And I click the upload button1
Then I should see correct balance for liabilities account
