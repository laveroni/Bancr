#-------------------------------------------------------------------------------------------------

Given (/^I am on the index page$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
        fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end

When(/^I remove a new account$/) do
    click_button 'removeAccount'
    fill_in 'accountName', :with => 'mynewaccount'
    click_button 'addAccount'
    click_button 'removeAccount'
end

Then(/^I should not see that account$/) do
    expect(page).to have_no_content 'mynewaccount'
end

