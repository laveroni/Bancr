Feature: Check if the accounts are in alphabetical order

Scenario: After uploading the Csv, the accounts should be in order

Given I am on the login page for Bancr application2
When I upload a CSV file to add accounts
Then I should see the accounts ordered:
  | A |
  | Assets     |
  | B |
  | C |
  | Liabilities |
  | Net |
Then Remove Accounts