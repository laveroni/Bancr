Feature: Check the default dates on the graph

Scenario: When I login to an user account, the time range should be 3 months

Given I am on the main login page
When successfully login to an user account
Then I should see the right dates on the graph