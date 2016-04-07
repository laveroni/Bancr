Given(/^I am on the login page3$/) do
    visit('http://localhost/Bancr/index.php')
end
When(/^I try to login with valid credentials$/) do
    #within('#logForm') do
        fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end

Then(/^I should be successful and now see the main page$/) do
    page.should have_content('Accounts')
end


