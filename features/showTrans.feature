Feature: Show the Transactions

Scenario: I click on an account and it should show the transactions for that account

Given I am located on the Bancr login page
When I upload one csv file
When I click on the button to show transactions
Then I should see the transactions appear for A
