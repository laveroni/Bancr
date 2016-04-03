#-------------------------------------------------------------------------------------------------


Given(/^I am on the main application page$/) do
    visit('http://localhost/Bancr/index.html')
end

When(/^I try to logout$/) do
    click_link("Log Out")
end

Then(/^I should be successful and now see the login page$/) do
    expect(page).to have_content 'Log In'
end
