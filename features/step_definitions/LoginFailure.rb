Given(/^I am on the login page5$/) do
    visit('https://localhost/Bancr/index.php')
end

When(/^I try to login with invalid credentials3$/) do
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'a'
    click_button 'signInButton'
end

When(/^I try it a second time$/) do
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'a'
    click_button 'signInButton'
end

When(/^I try it a third time$/) do
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'a'
    click_button 'signInButton'
end

When(/^I try it a fourth time$/) do
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'a'
    click_button 'signInButton'
end

Then(/^I should see a lockout error message$/) do
    page.should have_content('Account Locked For 1 Minute')
end

Then(/^Error message should still exist after refreshing page$/)do
    visit('https://localhost/Bancr/index.php')
    page.should have_content('Account Locked For 1 Minute')
end

Then(/^I should see it disappear after a minute$/) do
    page.should have_no_content 'Account Locked For 1 Minute', :wait=>65
end