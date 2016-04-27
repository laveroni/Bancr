Given(/^I am on the login page3$/) do
    visit('https://localhost/Bancr/index.php')
end
When(/^I try to login with valid credentials$/) do
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

Then(/^I should be successful and now see the main page$/) do
    page.should have_content('Accounts')
end


