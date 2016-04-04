Feature: Logging in to the application

Scenario: Login with empty fields

Given I am on the login page 
When I try to login without credentials
Then I should see a login error message

Scenario: Login with invalid info


When I try to login with invalid credentials
Then I should see another error message

Scenario: Successful Login


When I try to login with valid credentials
Then I should be successful and now see the main page

When I click on the Registration Page Link
Then I should see the Registration Page
