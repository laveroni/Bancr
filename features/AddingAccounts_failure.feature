Feature: Adding accounts

Scenario: User fails to add an account 

Given I am on the main page and trying to add a new account
When I try to add a new account without selecting a type or entering a name
Then I should see an error message telling me to do so
