#-------------------------------------------------------------------------------------------------

Given(/^I am on the login page$/) do
    visit('http://localhost/Bancr/index.html')
end

When(/^I try to login without credentials$/) do
    within('#logForm') do
        fill_in 'email', :with => ''
        fill_in 'password', :with => ''
    end
    click_button 'Login'
end

Then(/^I should see an error message$/) do
    expect(page).to have_content 'Please enter Username and Password'
end



When(/^I try to login with invalid credentials$/) do
    within('#logForm') do
        fill_in 'email', :with => 'test@test.com'
        fill_in 'password', :with => 'b'
    end
    click_button 'Login'
end

Then(/^I should see another error message$/) do
    expect(page).to have_content 'Invalid Username or Password'
end



When(/^I try to login with valid credentials$/) do
    within('#logForm') do
        fill_in 'email', :with => 'a@a.com'
        fill_in 'password', :with => 'a'
    end
    click_button 'Login'
end

Then(/^I should be successful to now see the main page$/) do
    visit('http://localhost/Bancr/dashboard.html')
end


When /^I click on the Registration Page Link$/ do
    click_link("Register")
end

Then /^I should see the Registration Page$/ do
    expect(page).to have_content 'Register'
end