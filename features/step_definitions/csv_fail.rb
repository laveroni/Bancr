#-------------------------------------------------------------------------------------------------

Given (/^I am on the main page trying to upload a csv file1$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
        fill_in 'email', :with => 'halfond@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end


When(/^I choose an invalid file$/)do
  attach_file('csv-file', File.absolute_path('money.jpg'))
  click_on('upload')
end

Then(/^I should see an error popup$/)do
  begin
    main, popup = page.driver.browser.window_handles
    page.within_window popup do
      popup.should have_content('Something went wrong')
      click_on('ok')
    end
  rescue
  end
end

