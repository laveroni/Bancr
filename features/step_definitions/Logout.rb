Given(/^I am on the main application page$/) do
    visit('http://localhost/Bancr/dashboard.php')
end

When(/^I try to logout$/) do
    find('Log Out').click
end

Then(/^I should be successful to now see the login page$/) do
    #visit('
    #http://localhost/Bancr/index.php
    #')
    expect(page).to have_content 'Sign In'
end
