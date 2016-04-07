Given(/^I am on the main application page$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
        fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end

When(/^I try to logout$/) do
    click_button 'Logout'
end

Then(/^I should be successful to now see the login page$/) do
    expect(page).to have_content 'Enter your email and password'
end
