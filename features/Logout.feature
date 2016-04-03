Feature: Logging out of the application

Scenario: Successful logout

Given I am on the main application page
When I try to logout
Then I should be successful and now see the login page