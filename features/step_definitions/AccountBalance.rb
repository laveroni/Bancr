Given(/^I am on the login page of Bancr1$/) do
    visit('http://localhost/Bancr/index.php')
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I upload csv$/) do
    
end


Then(/^all the accounts balance should be updated$/) do
    
end