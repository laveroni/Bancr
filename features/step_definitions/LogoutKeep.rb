Given(/^I am on the login page for Bancr$/) do
    visit('http://localhost/Bancr/index.php')
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I add an account to keep$/) do
    fill_in 'accountName', :with => 'mynewsaccount'
    click_button 'addAccount'
end

When(/^I logout of the account$/) do
    click_button('logout')
end

When(/^I login again$/) do
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

Then(/^I should see the added account$/) do
    page.should have_content('mynewsaccount')
    first(:css,'tr', text: "mynewsaccount").click_button('removeAccount')
end
