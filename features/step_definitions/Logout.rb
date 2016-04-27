Given(/^I am on the main application page$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I try to logout$/) do
    click_button('logout')
end

Then(/^I should be successful and now see the login page$/) do
    page.should have_content('Enter your email and password')
end
