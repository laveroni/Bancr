#-------------------------------------------------------------------------------------------------

Given (/^I am on the index page2$/) do
    visit('http://localhost/Bancr/index.php')
    #within('#logForm') do
        fill_in 'email', :with => 'bancr@usc.edu'
        fill_in 'password', :with => 'password'
    #end
    click_button 'signInButton'
end

Then(/^I should not see a remove account button$/) do
    expect(page).to have_no_content 'Remove'
end

