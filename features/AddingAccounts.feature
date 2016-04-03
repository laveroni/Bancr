Feature: Adding accounts

Scenario: User tries to add an account 

Given I am on the main page and trying to add a new account
When I try to add a new account without selecting a type or entering a name
Then I should see an error message telling me to do so

Scenario: 

Given 
When I try to add a new account with only a type or only a name
Then I should see another message with appropriate instructions

Scenario: User enters proper name and selects proper type

Given 
When I try to add a new account with a proper name and type
Then I should see a success message, and then see the account in my list.