Given(/^I am on the login page for Bancr$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I add an account to keep$/) do
    fill_in 'accountName', :with => 'mynewaccount'
    click_button 'addAccount'
end

When(/^I logout of the account$/) do
    click_button 'logout'
end

When(/^I login again$/) do
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

Then(/^I should see the added account$/) do
    page.should have_content('mynewaccount')
    first(:css,'tr', text: "mynewaccount").click_button('removeAccount')
end