Given(/^I am on the login page for Bancr1$/) do
    visit('http://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I click on the button to graph an account$/) do
    first(:css, 'tr', text: "Assets").check('0')
end

Then(/^I should see it graphed$/) do
    
end
