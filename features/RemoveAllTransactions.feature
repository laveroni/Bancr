Feature: Logging in to the application with a bad password

Scenario: Login with bad password

Given I am on the main page and login1
When I upload Transactions
And I remove them
Then I should see no transactions
