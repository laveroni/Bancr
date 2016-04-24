Feature: Logging in without lockout

Scenario: Login after 3 failed attempts to make sure lockout is only after 4 attempts

Given I am on the login page for our application
When I provide invalid credentials on the login page
When I provide invalid credentials on the login page twice
When I provide invalid credentials on the login page thrice
Then I should be able to login after all this
