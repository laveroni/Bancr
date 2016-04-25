Given (/^I am on the main page and trying to find balances$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
         fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end

When(/^I upload Csv file for user2$/)do
    attach_file('csv-file', File.absolute_path('transactions.csv'))
  click_on('upload')
end

When(/^I click the upload button3$/) do
  page.driver.browser.switch_to.alert.accept
end

Then (/^I should see correct balance for assets account$/)do
	expect(page).should have_content('860.70')
  click_button('removeAccount', match: :first)
  click_button('removeAccount', match: :first)
  click_button('removeAccount', match: :first)
end
