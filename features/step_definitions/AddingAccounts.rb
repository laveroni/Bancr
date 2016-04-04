#To get to the main page you HAVE to Login

Given (/^I am on the main page trying to add a new account$/) do
    visit('http://localhost/Bancr/index.php')
    within('#loginform') do
        fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    end
    click_button 'Login'
end
#should be on dashboard.php after above step
#
#currently a user could make an account with a blank name, so this test is commented for now
#
#When(/^I try to add a new account with blank fields$/) do
#    find('#addAccount') do
#        fill_in 'accountName', :with => ''
#        click_button 'addAccount'
#    end
#end

#Then(/^I should see an error message telling me to do so$/) do
#    expect(page).to have_content 'Please enter a name for the account'
#end
#
#
#
When(/^I try to add a new account with a proper name$/) do
    find('#addAccount') do
        fill_in 'accountName', :with => 'mynewaccount'
        click_button 'addAccount'
    end
end

Then(/^I should see the account within a list$/) do
    expect(page).to have_content 'mynewaccount'
end