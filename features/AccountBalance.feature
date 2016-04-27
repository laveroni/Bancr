Feature: Accounts balance should update when transactions are addes

Scenario: Upload CSV and check balances

Given I am on the login page of Bancrs
When I upload csv
Then all the accounts balance should be updated
