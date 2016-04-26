Given(/^I am on the login page for Bancr2$/) do
    visit('http://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I upload a good csv file$/) do
  attach_file('csv-file', File.absolute_path('transactions.csv'))
  click_on('upload')
  page.driver.browser.switch_to.alert.accept
end

When(/^I click on the button to graph an account1$/) do

    check('0', match: :first)
end

Then(/^I should see it graphed on the page$/) do
    page.should have_css('#graph')
    click_button('removeAccount', match: :first)
    click_button('removeAccount', match: :first)
    click_button('removeAccount', match: :first)
end