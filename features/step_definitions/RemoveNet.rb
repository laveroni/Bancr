Given(/^I am on the login page of Bancr2$/) do
    visit('http://localhost/Bancr/index.php')
end

When(/^I login to an account2$/) do
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'a'
    click_button 'signInButton'
end

Then(/^I should not see a remove button for net$/) do
    first(:css, 'tr', text: "Net").should have_no_content('Remove')
end