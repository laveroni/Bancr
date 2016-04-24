Feature: Removing accounts

Scenario: Check to make sure that there is no remove button for assets

Given I am on the login page of Bancr1
When I login to an account1
Then I should not see a remove button for assets
