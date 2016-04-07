Given(/^I am on the main application page$/) do
    visit('http://localhost/Bancr/dashboard.php')
end

When(/^I try to logout$/) do
    click_button('#logout')
end

Then(/^I should be successful to now see the login page$/) do
    expect(page).to have_content 'Enter your email and password'
end
