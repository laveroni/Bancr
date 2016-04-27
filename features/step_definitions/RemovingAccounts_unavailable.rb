Given (/^I am on the index page2$/) do
    visit('https://localhost/Bancr/index.php')
    fill_in 'email', :with => 'halfond@usc.edu'
    fill_in 'password', :with => 'password'
    click_button 'signInButton'
end

Then(/^I should not see a remove account button$/) do
    expect(page).to have_no_content 'Remove'
end

