#require 'capybara/rspec'
#require 'capybara/cucumber'

#include Capybara::DSL

#Capybara.app_host = ""
#Capybara.default_driver = :selenium

#session = Capybara::Session.new :selenium
#session.visit()

#-------------------------------------------------------------------------------------------------

Given /^I am on the main page and trying to add a new account$/ do
   
end


When(/^I try to add a new account without selecting a type or entering a name$/) do
    
end

Then(/^I should see an error message telling me to do so$/) do
end



When(/^I try to add a new account with only a type or only a name$/) do
    
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
