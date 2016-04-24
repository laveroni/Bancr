#-------------------------------------------------------------------------------------------------

Given (/^Given I am on the login page for the Bancr application$/) do
    visit('http://localhost/Bancr/index.php')
end


When(/^I log in to bancr$/)do
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

Then(/^I should see the accounts in order$/)do
	page.body.should =~ /*"Assets"."Liabilities"*/
end

