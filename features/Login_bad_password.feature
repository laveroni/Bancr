Feature: Logging in to the application with a bad password

Scenario: Login with bad password

Given I am on the login page2 
When I try to login with invalid password
Then I should be sent back to the login page
