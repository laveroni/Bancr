Feature: Locked out of login screen after four failures

Scenario: Login with invalid credentials several times

When I try to login with imvalid credentials
And I try it a second time
And I try it a third time
And I try it a fourth time
Then I should see a lockout error message
