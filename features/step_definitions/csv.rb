#-------------------------------------------------------------------------------------------------

Given (/^I am on the main page trying to upload a cvs file$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
        fill_in 'email', :with => 'halfond@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end

When(/^I choose an invalid file$/)do
	attach_file('csv-file', File.absolute_path('./var/www/html/Bancr/money.jpg'))
end

Then(/^I should see an error popup$/)do
  begin
    main, popup = page.driver.browser.window_handles
    within_window(popup) do
      popup.should have_content('Something went wrong')
      click_on('ok')
    end
  rescue
  end
  click_on('submit')
end

When(/^I specify and submit a file with correct information$/)do
	attach_file('csv-file', File.absolute_path('./var/www/html/Bancr/transactions.csv'))
end

Then(/^I see the error message$/) do
    begin
    main, popup = page.driver.browser.window_handles
    within_window(popup) do
      popup.should have_content('Upload successful')
      click_on('ok')
    end
  rescue
  end
  click_on('submit')
end

