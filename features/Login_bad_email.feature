Feature: Logging in to the application with bad email

Scenario: Login with a bad email

Given I am on the login page2 
When I try to login without credentials
Then I should see another error message
