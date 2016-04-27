Feature: Change the dates on a graph

Scenario: I click on two dates that are a year apart

Given I am on the login page and login
When I upload a beautiful csv file1
When I change the dates for the calendar
Then I should see the dates change on the graph
