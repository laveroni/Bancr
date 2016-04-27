Feature: Changing the dates on the graph

Scenario: Change the dates so they are a month apart

Given I am on the main page of Bancr
When I upload a beautiful csv file
And I change the dates for the graph
Then I should see the new dates on the graph
