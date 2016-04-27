Given(/^I am on the main login page$/) do
    visit('https://localhost/Bancr/index.php')
end

When(/^successfully login to an user account$/) do
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

Then(/^I should see the right dates on the graph$/) do
    
end