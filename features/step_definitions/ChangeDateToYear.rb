Given(/^I am on the login page and login$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I upload a beautiful csv file1$/) do
	attach_file('csv-file', File.absolute_path('transactions.csv'))
    click_on('upload')
    page.driver.browser.switch_to.alert.accept	
end

When(/I change the dates for the calendar$/) do
    fill_in 'from_date_text', :with => '4/27/2015'
    fill_in 'to_date_text', :with => '4/27/2016'
    click_on('range_button')
end

Then(/^I should see the dates change on the graph$/) do
	find_field('to_date_text').value.should eq '4/27/2016'
    click_button('removeAccount', match: :first)
    click_button('removeAccount', match: :first)
    click_button('removeAccount', match: :first)
end