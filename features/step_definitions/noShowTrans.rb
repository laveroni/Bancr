Given(/^I am located on the login page for Bancr$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I upload one csv file1$/) do
  attach_file('csv-file', File.absolute_path('transactions.csv'))
  click_on('upload')
  page.driver.browser.switch_to.alert.accept
end

When(/^I click on the button to show transactions for net$/) do
    check('2', match: :first)
end

Then(/^I should not see the transactions$/) do
    page.should have_no_content('BofA')
    click_button('removeAccount', match: :first)
    click_button('removeAccount', match: :first)
    click_button('removeAccount', match: :first)
end
