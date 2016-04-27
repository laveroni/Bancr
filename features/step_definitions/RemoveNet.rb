Given(/^I am on the login page of Bancr2$/) do
    visit('https://localhost/Bancr/index.php')
end

When(/^I login to an account2$/) do
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

Then(/^I should not see a remove button for net$/) do
    page.should have_no_content('Remove')
end