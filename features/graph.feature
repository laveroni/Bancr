Feature: Stock Graph
As a user, I want to see stock information on a graph, so that I may have idea of how well the company has done in the past.

	
Scenario: User changes time period

Given I am on the main page
When I change time period
Then I see the graph update accordingly to the selected option	

Scenario: user browses
	
Given 
When I look through the account transaction history
Then I see the graph ‘move’ through further times

Scenario: User adds accounts

Given 	
When I add an account on the graph
Then I see the stock’s line on the graph
And I see the legend update and symbolize the stock’s line

Scenario: User removes accounts from graph

Given 
When I remove an account from the graph
Then I see the accounts’s line disappear from the graph
And I see the account disappear from the legend