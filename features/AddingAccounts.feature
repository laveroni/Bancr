Feature: Adding accounts

Scenario: User adds a new account

Given I am on the main page and trying to add a new account2
When I try to add a new account with a proper name and type
Then I should see the account in my list

When I try to add the same account
Then I should get an error