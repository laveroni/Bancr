Feature: Logging in to the application with empty fields

Scenario: Login with empty fields

Given I am on the login page4 
When I try to login with empty fields
Then It should fail and I should be back on the login page
