Given(/^I am on the login page and login$/) do
    visit('http://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'a'
    click_button 'signInButton'
end

When(/I change the dates for the calendar$/) do
   
end

Then(/^I should see the dates change on the graph$/) do
    
end