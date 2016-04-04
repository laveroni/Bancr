#-------------------------------------------------------------------------------------------------

Given /^I am buying a stock with a valid ticker symbol and valid quantity$/ do
    visit('http://localhost/Bancr/index.html')
    within('#logForm') do
        fill_in 'email', :with => 'a@a.com'
        fill_in 'password', :with => 'a'
    end
    click_button 'Login'
end

When(/^I try to remove a new account without selecting a type or entering a name$/) do
    find('#sellAccount') do
        fill_in 'accountName', :with => ''
        fill_in 'accountType', :with => ''
        click_button 'sellAccount'
    end
end

Then(/^I should see an error message telling me to specify$/) do
    expect(page).to have_content 'Please enter the name and type of the account'
end



When(/^I try to remove a new account with only a type or only a name$/) do
    find('#sellAccount') do
        fill_in 'accountName', :with => 'fakeaccount'
        fill_in 'accountType', :with => ''
        click_button 'sellAccount'
        endend

Then(/^I should see another messahe with appropriate intructions$/) do
    expect(page).to have_content 'Please enter BOTH details'
end


When(/^I try to remove a new account with a proper name and type$/) do
    find('#sellAccount') do
        fill_in 'accountName', :with => 'mynewaccount'
        fill_in 'accountType', :with => 'Checking'
        click_button 'sellAccount'
        endend

Then(/^I should see a success message, and then no longer see the account in the list$/) do
    expect(page).to have_content 'Account has been updated'
end
