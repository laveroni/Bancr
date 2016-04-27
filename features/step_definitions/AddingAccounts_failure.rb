Given (/^I am on the main page and trying to add a new account$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end


When(/^I try to add a new account without selecting a type or entering a name$/) do
    fill_in 'accountName', :with => ''
    click_button 'addAccount'
end

Then(/^I should see an error message telling me to do so$/) do
    expect(page).to have_content 'Error: Enter Account Name'
end
