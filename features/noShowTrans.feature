Feature: Show the Transactions

Scenario: I click on an account and it should show the transactions for that account

Given I am located on the login page for Bancr
When I upload one csv file1
When I click on the button to show transactions for net
Then I should not see the transactions

