Feature: Removing accounts

Scenario: User tries to remove an account  that doesn't exist

Given I am on the index page2
Then I should not see a remove account button
