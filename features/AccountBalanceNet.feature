Feature: Checking balances

Scenario: User uploads CSV, balance should update correctly for Net account 

Given I am on the main page and trying to find balance1
When I upload Csv file for user1
And I click the upload button2
Then I should see correct balance for net account
