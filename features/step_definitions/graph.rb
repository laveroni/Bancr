Given(/^I am on the login page for Bancr1$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I click on the button to graph an account$/) do
    check('0', match: :first)
end

Then(/^I should see it not graphed$/) do
    page.should have_no_css('a#graph')
end
