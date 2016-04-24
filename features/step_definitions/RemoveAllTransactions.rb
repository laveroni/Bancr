
Given (/^I am on the main page and login1$/) do
    visit('http://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end


When(/^I upload Transactions$/)do
	attach_file('csv-file', File.absolute_path('transactions.csv'))
    click_on('upload')
end

When(/^I remove them$/) do
  page.driver.browser.switch_to.alert.accept
	first(:css,'tr', text: "A").click_button('removeAccount')
	first(:css,'tr', text: "B").click_button('removeAccount')
	first(:css,'tr', text: "C").click_button('removeAccount')
end

Then(/^I should see no transactions$/)do
	expect(page).to have_no_content 'A'
    first(:css, 'tr', text: "Net").should have_content('0.00')
end
