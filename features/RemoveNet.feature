Feature: Removing accounts

Scenario: Check to make sure that there is no remove button for net

Given I am on the login page of Bancr2
When I login to an account2
Then I should not see a remove button for net