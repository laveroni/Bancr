Given(/^I am on the login page2$/) do
    visit('http://localhost/Bancr/index.php')
end
When(/^I try to login with invalid credentials$/) do
    #within('#logForm') do
        fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'a'
    #end
    click_button 'signInButton'
end

Then(/^I should see an error message$/) do
    page.should have_content('Enter your email and password')
end