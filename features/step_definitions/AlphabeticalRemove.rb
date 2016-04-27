Given(/^I am on the login page for Bancr application$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

When(/^I remove an account from the list$/) do
    fill_in 'accountName', :with => 'mynewaccount'
    click_button 'addAccount'
    click_button('removeAccount', match: :first)
end

Then /^I should see the accounts in order1:$/ do |table|
  expected_order = table.raw
  actual = []
  actual_order = page.all('#superRow').collect(&:text)
  for number in actual_order
     actual << [number]
  end
  expected_order.should == actual
end
