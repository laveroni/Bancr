#require 'capybara/rspec'
#require 'capybara/cucumber'

#include Capybara::DSL

#Capybara.app_host = ""
#Capybara.default_driver = :selenium

#session = Capybara::Session.new :selenium
#session.visit()

#-------------------------------------------------------------------------------------------------

Given /^I am on the main page and trying to add a new account2$/ do
    visit('http://localhost/Bancr/index.php')
    within('#logForm') do
         fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    end
    click_button 'signInButton'
end


When(/^I try to add a new account without selecting a type or entering a name$/) do
    find('#addAccount') do
        fill_in 'accountName', :with => ''
        fill_in 'accountType', :with => ''
        click_button 'addAccount'
    end
end

Then(/^I should see an error message telling me to do so$/) do
    expect(page).to have_content 'Please fill in the text fields'
end



When(/^I try to add a new account with only a type or only a name$/) do
    find('#addAccount') do
        fill_in 'accountName', :with => ''
        fill_in 'accountType', :with => 'Checking'
        click_button 'addAccount'
    end
end

Then(/^I should see another message with appropriate instructions$/) do
    expect(page).to have_content 'Please enter a name and select a type'

end



When(/^I try to add a new account with a proper name and type$/) do
    find('#addAccount') do
        fill_in 'accountName', :with => 'mynewaccount'
        fill_in 'accountType', :with => 'Checking'
        click_button 'addAccount'
    end
end

Then(/^I should see a success message, and then see the account in my list\.$/) do
    expect(page).to have_content 'Account value has updated'
end
