Feature: Removing accounts

Scenario: User tries to remove an account 

Given I am on the index page
When I remove a new account
Then I should not see that account