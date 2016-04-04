Given(/^I am on the login page$/) do
    visit('http://localhost/Bancr/index.php')
end

When(/^I try to login without credentials$/) do
    within('#loginform') do
        fill_in 'email', :with => ''
        fill_in 'password', :with => ''
    end
    click_button 'signInButton'
end

Then(/^I should see a login error message$/) do
    expect(page).to have_content 'Please enter an email address and password'
end



When(/^I try to login with invalid credentials$/) do
    within('#loginform') do
        fill_in 'email', :with => 'test@test.com'
        fill_in 'password', :with => 'b'
    end
    click_button 'signInButton'
end

Then(/^I should see another error message$/) do
    expect(page).to have_content 'Invalid Username or Password'
end



When(/^I try to login with valid credentials$/) do
    within('#loginform') do
        fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    end
    click_button 'signInButton'
end

Then(/^I should be successful to now see the main page$/) do
    visit('http://localhost/Bancr/dashboard.php')
end