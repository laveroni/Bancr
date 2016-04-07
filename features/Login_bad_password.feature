Feature: Logging in to the application with a bad password

Scenario: Login with bad password

Given I am on the login page2 
When I try to login with invalid credentials 
Then I should see an error message 
