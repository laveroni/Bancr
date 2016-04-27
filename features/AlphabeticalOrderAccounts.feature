Feature: Check if the accounts are in alphabetical order

Scenario: The accounts should be in order (assets, liabilities, net)

Given I am on the login page for the Bancr application
When I log in to bancr
Then I should see the accounts in order:
  | Assets     |
  | Liabilities |
  | Net |
