#require 'capybara/rspec'
#require 'capybara/cucumber'

#include Capybara::DSL

#Capybara.app_host = ""
#Capybara.default_driver = :selenium

#session = Capybara::Session.new :selenium
#session.visit()

#-------------------------------------------------------------------------------------------------

Given (/^I am on the main page and trying to add a new account2$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
         fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end

When(/^I try to add a new account with a proper name and type$/) do
    click_button 'removeAccount'
    fill_in 'accountName', :with => 'mynewaccount'
    click_button 'addAccount'
end

Then(/^I should see a success message, and then see the account in my list\.$/) do
    expect(page).to have_content 'mynewaccount'
end

When(/^I try to add the same account$/)do
	fill_in 'accountName', :with => 'mynewaccount'
	click_button 'addAccount'
end

Then (/^I should get an error$/)do
	expect(page).to have_content 'Error: Account Name Already Exists'
end
