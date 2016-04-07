Feature: Logging in to the application

Scenario: Successful Login

Given I am on the login page3 
When I try to login with valid credentials
Then I should be successful and now see the main page
