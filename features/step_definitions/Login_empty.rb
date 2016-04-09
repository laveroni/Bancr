Given(/^I am on the login page4$/) do
    visit('http://localhost/Bancr/index.php')
end
When(/^I try to login with empty fields$/) do
    #within('#logForm') do
        fill_in 'email', :with => ' '
        fill_in 'password', :with => ' '
    #end
    click_button 'signInButton'
end

Then(/^I should be back on the login page$/) do
    page.should have_content('Enter your email and password')
end