Given (/^I am on the login page for the Bancr application$/) do
    visit('https://localhost/Bancr/index.php')
end


When(/^I log in to bancr$/)do
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

Then /^I should see the accounts in order:$/ do |table|
  expected_order = table.raw
  actual = []
  actual_order = page.all('#superRow').collect(&:text)
  for number in actual_order
     actual << [number]
  end
  expected_order.should == actual
end

