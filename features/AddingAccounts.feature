Feature: Adding accounts

Scenario: User adds a new account

Given I am on the main page and trying to add a new account
When I try to add a new account with a proper name and type
Then I should see a success message, and then see the account in my list.