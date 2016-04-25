#-------------------------------------------------------------------------------------------------

Given (/^I am on the login page for Bancr application1$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
        fill_in 'email', :with => 'halfond@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end


When(/^I add an account to the list$/)do
	fill_in 'accountName', :with => 'mynewaccount'
  click_button 'addAccount'
end

Then/^I should see the accounts in order still:$/do |table|
  expected_order = table.raw
  actual_order = page.all('tr').collect(&:text)
  expected_order.should = actual_order
  first(:css,'tr', text: "mynewaccount").click_button('removeAccount')
end

