#require 'capybara/rspec'
#require 'capybara/cucumber'

#include Capybara::DSL

#Capybara.app_host = ""
#Capybara.default_driver = :selenium

#session = Capybara::Session.new :selenium
#session.visit()

#-------------------------------------------------------------------------------------------------

Given (/^I am on the main page and trying to find balance$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
         fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end

When(/^I upload Csv file for user$/)do
    attach_file('csv-file', File.absolute_path('transactions.csv'))
  click_on('upload')
end

When(/^I click the upload button1$/) do
  page.driver.browser.switch_to.alert.accept
end

Then (/^I should see correct balance for liabilities account$/)do
	page.should have_content('-112.64')
  click_button('removeAccount', match: :first)
  click_button('removeAccount', match: :first)
  click_button('removeAccount', match: :first)
end
