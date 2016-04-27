Given(/^I am on the login page2$/) do
    visit('https://localhost/Bancr/index.php')
end
When(/^I try to login with invalid password$/) do
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'a'
    click_button 'signInButton'
end

Then(/^I should be sent back to the login page$/) do
    page.should have_content('Enter your email and password')
end