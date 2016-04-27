Feature: Graph the accounts

Scenario: I click on an account and it should not graph cause no transactions

Given I am on the login page for Bancr1
When I click on the button to graph an account
Then I should see it not graphed

