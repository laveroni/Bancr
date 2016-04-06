#-------------------------------------------------------------------------------------------------

Given (/^I am on the main page trying to upload a csv file$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
        fill_in 'email', :with => 'halfond@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end


When(/^I specify and submit a file with correct information$/)do
	attach_file('csv-file', File.absolute_path('transactions.csv'))
end

Then(/^I see the correct message$/) do
    begin
    popup = windows.last
    page.within_window popup do
      popup.should have_content('Upload successful')
      click_on('ok')
    end
  rescue
  end
end

Then(/^I should see the transactions$/)do
	page.should have_content 'BofA'
end

