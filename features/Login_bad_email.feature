Feature: Logging in to the application with bad email

Scenario: Login with a bad email

Given I am on the login page1 
When I try to login without a valid email
Then I should remain on the login page
