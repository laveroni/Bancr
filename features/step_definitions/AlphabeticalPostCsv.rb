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
	fill_in 'accountName', :with => 'mynewaccount'
  click_button 'addAccount'
end

Then /^I should see the accounts ordered:$/ do |table|
  expected_order = table.raw
  actual = []
  actual_order = page.all('#superRow').collect(&:text)
  for number in actual_order
     actual << [number]
  end
  expected_order.should == actual
  first(:css,'tr', text: "A").click_button('removeAccount')
  first(:css,'tr', text: "B").click_button('removeAccount')
  first(:css,'tr', text: "C").click_button('removeAccount')
end

