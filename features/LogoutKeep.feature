Feature: After logging out, all info should be saves

Scenario: login, add an account, logout, login, check for account

Given I am on the login page for Bancr
When I add an account to keep
And I logout of the account
And I login again
Then I should see the added account
