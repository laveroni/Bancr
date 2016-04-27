#-------------------------------------------------------------------------------------------------

Given (/^I am on the main page trying to upload a csv file1$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end


When(/^I choose an invalid file$/)do
  attach_file('csv-file', File.absolute_path('money.jpg'))
  click_on('upload')
end

Then(/^I should see an error popup$/)do
   page.driver.browser.switch_to.alert.accept 
end

