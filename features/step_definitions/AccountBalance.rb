Given(/^I am on the login page of Bancrs$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I upload csv$/) do
  
end


Then(/^all the accounts balance should be updated$/) do
    first(:css, 'tr', text: "Assets").should have_content('0.00')
end
