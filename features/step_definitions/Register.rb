#-------------------------------------------------------------------------------------------------

Given(/^I am on the registration page$/) do
visit('http://localhost/Bancr/dashboard.php')
end

When(/^I leave the fields blank$/) do
    within('#regForm') do
        fill_in 'email', :with => ''
        fill_in 'password', :with => ''
        fill_in 'password2', :with => ''
    end
    click_button 'register'
end

Then(/^I should see an error message$/) do
    expect(page).to have_content 'Please fill in both fields'
end


When(/^I enter taken credentials$/) do
        within('#regForm') do
            fill_in 'email', :with => 'a@a.com'
            fill_in 'password', :with => 'b'
            fill_in 'password2', :with => 'b'
        end
        click_button 'register'
end

Then(/^I see the error message ‘unavailable username”$/) do
    expect(page).to have_content 'Email is already registered'
end


When(/^I enter invalid email-password$/) do
        within('#regForm') do
            fill_in 'email', :with => 'a'
            fill_in 'password', :with => 'b'
            fill_in 'password2', :with => 'c'
        end
        click_button 'register'
end

Then(/^I see the error message “Please enter a valid email address”$/) do
    expect(page).to have_content 'Email is invalid or password incorrect'
end



When /^I correctly register$/ do
    within('#regForm') do
        fill_in 'email', :with => 'c@c.com'
        fill_in 'password', :with => 'c'
        fill_in 'password2', :with => 'c'
    end
    click_button 'register'
end


Then(/^I the registration complete$/) do
    expect(page).to have_content 'Registration successful'
end


When /^I click on the Login Page Link$/ do
    click_link("Log In")
end

Then /^I should see the Login Page$/ do
    expect(page).to have_content 'Log In'
end

