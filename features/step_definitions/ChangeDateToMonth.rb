Given(/^I am on the main page of Bancr$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end
When(/^I change the dates for the graph$/) do
    
end

Then(/^I should see the new dates on the graph$/) do
    
end


