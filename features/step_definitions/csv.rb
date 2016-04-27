#-------------------------------------------------------------------------------------------------

Given (/^I am on the main page trying to upload a csv file$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end


When(/^I specify and submit a file with correct information$/)do
	attach_file('csv-file', File.absolute_path('transactions.csv'))
  click_on('upload')
end

When(/^I click the upload button$/) do
  page.driver.browser.switch_to.alert.accept
end

Then(/^I should see the transactions$/)do
	page.should have_content 'A'
  click_button('removeAccount', match: :first)
  click_button('removeAccount', match: :first)
  click_button('removeAccount', match: :first)
end

