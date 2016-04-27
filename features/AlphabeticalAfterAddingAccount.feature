Feature: Check if the accounts are in alphabetical order

Scenario: After adding an account, the accounts should still be in order

Given I am on the login page for Bancr application1
When I add an account to the list
Then I should see the accounts in order still:
  | Assets     |
  | Liabilities |
  | Net |
  | mynewaccount |

