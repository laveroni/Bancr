Given (/^I am on the main page and trying to find balances$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
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
  page.should have_content('769.34')
  click_button('removeAccount', match: :first)
  click_button('removeAccount', match: :first)
  click_button('removeAccount', match: :first)
end
