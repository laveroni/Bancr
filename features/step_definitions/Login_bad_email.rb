Given(/^I am on the login page1$/) do
    visit('http://localhost/Bancr/index.php')
end
When(/^I try to login without a valid email$/) do
    #within('#logForm') do
        fill_in 'email', :with => 'ban@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end

Then(/^I should remain on the login page$/) do
    page.should have_content('Enter your email and password')
end