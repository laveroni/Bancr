Feature: Graph the accounts

Scenario: I click on an account and it should show new account

Given I am on the login page for main Bancr application1
When I upload a good csv file2
When I click on the button to graph A account
Then I should see new account graphed
