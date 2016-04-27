Feature: Graph the accounts

Scenario: I click on an account and it should show net account

Given I am on the login page for main Bancr application
When I upload a good csv file1
When I click on the button to graph net
Then I should see net graphed
