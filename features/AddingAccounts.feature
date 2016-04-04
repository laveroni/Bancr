Feature: Adding accounts

Scenario: User adds a proper account name

Given I am on the main page trying to add a new account
When I try to add a new account with a proper name
Then I should see the account within a list