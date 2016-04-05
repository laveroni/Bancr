Feature: Removing accounts

Scenario: User tries to remove an account 

Given I am on the main page and trying to remove a new account
When I try to remove a new account without selecting a type or entering a name
Then I should see an error message telling me to specify

Scenario: 

Given 
When I try to remove a new account with only a type or only a name
Then I should see another message with appropriate instructions

Scenario: User enters proper name and selects proper type

Given 
When I try to remove a new account with a proper name and type
Then I should see a success message, and then no longer see the account in the list