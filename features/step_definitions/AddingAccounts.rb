Given (/^I am on the main page and trying to add a new account2$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I try to add a new account with a proper name and type$/) do
    fill_in 'accountName', :with => 'mynewaccount'
    click_button 'addAccount'
end

Then(/^I should see the account in my list$/) do
    expect(page).to have_content 'mynewaccount'
end

When(/^I try to add the same account$/)do
	fill_in 'accountName', :with => 'mynewaccount'
	click_button 'addAccount'
end

Then (/^I should get an error$/)do
	expect(page).to have_content 'Error: Account Name Already Exists'
    click_button('removeAccount', match: :first)
end
