#-------------------------------------------------------------------------------------------------

Given (/^I am on the login page for Bancr application2$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
        fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end


When(/^I upload a CSV file to add accounts$/)do
	attach_file('csv-file', File.absolute_path('transactions.csv'))
  click_on('upload')
  page.driver.browser.switch_to.alert.accept
end

Then /^I should see the accounts ordered:$/ do |table|
  expected_order = table.raw
  actual = []
  actual_order = page.all('#superRow').collect(&:text)
  for number in actual_order
     actual << [number]
  end
  expected_order.should == actual
end

Then (/^Remove Accounts$/) do
  first('removeAccount').click_button
  first('removeAccount').click_button
  first('removeAccount').click_button
end

