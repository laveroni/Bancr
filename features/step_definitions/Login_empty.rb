Given(/^I am on the login page4$/) do
    visit('https://localhost/Bancr/index.php')
end
When(/^I try to login with empty fields$/) do
    fill_in 'email', :with => ' '
    fill_in 'password', :with => ' '
    click_button 'signInButton'
end

Then(/^It should fail and I should be back on the login page$/) do
    page.should have_content('Enter your email and password')
end