Feature: Testing for Registration
As a user, I want to register with the website, so that I may log in and use the app.
		
Scenario: User doesn’t fill in fields
	
Given I am on the registration page
When I leave the fields blank
Then I should see an error message 
And stay on the registration page
		

Scenario: User fills in taken credentials

Given 
When I enter taken credentials
Then I see the error message ‘unavailable username”
And still see on the registration page
			 	
Scenario: User types incorrect email

Given When I mistype my email
And submit the credentials
Then I see the error message “Please enter a valid email address”
And I am on the registration page

Scenario: User fills in available credentials

Given 
When I fill in proper credentials
And submit the credentials
Then I see the registration complete					
And I am on the login page	