Feature: Check if the accounts are in alphabetical order

Scenario: After removing an account, the accounts should still be in order

Given I am on the login page for Bancr application
When I remove an account from the list
Then I should see the accounts in order1:
  | Assets     |
  | Liabilities |
  | Net |
