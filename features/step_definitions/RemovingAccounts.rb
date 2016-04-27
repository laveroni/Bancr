Given (/^I am on the index page$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I remove a new account$/) do
    fill_in 'accountName', :with => 'mynewaccount'
    click_button 'addAccount'
    click_button('removeAccount', match: :first)
end

Then(/^I should not see that account$/) do
    expect(page).to have_no_content 'mynewaccount'
end

