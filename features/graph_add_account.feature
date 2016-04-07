Feature: Account Graph
As a user, I want to see account information on a graph, so that I may have idea of my finances

Scenario: User changes time period

Given I am on the main application page1
When I try to add an account to the graph
Then I should see the account in the legend