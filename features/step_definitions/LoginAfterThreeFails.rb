Given(/^I am on the login page for our application$/) do
    visit('https://localhost/Bancr/index.php')
end

When(/^I provide invalid credentials on the login page$/) do
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'pass'
    click_button 'signInButton'   
end

When(/^I provide invalid credentials on the login page twice$/) do
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'pass'
    click_button 'signInButton'   
end

When(/^I provide invalid credentials on the login page thrice$/) do
    fill_in 'email', :with => 'bancr@usc.edu'
    fill_in 'password', :with => 'pass'
    click_button 'signInButton'   
end

Then(/^I should be able to login after all this$/) do
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
    page.should have_content("Transactions")
end
