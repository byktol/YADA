Yet Another Diet Assistant (YADA)

The application is written in PHP, a minimum of PHP 5.2 is required. The session
requires the browser cookies to be enabled. There's also some functionality that
requires Javascript to be enabled.

By default, the application is stored "as is" in the web folder /var/www/ or
~/public_html, meaning that we have the following structure:

+-/public_html
 +-YADA/
  +-yada/
   +-css/
   +-data/
   +-images/
   +-js/
   +-php/
   +-views/
   +-boot.php
   +-Foodcontroller.php
   +-index.php
   +-UserController.php

The data directory must be writable by the application, otherwise the user data
won't be able to be saved.

We haven't implemented any kind of user input validation, so stuff can and will
break with bad input.

Due to implementation time constraints, the Back and Forward buttons in the
browser should not be used. Unexpected behavior can happen.


Features:
1. User
1.1. Register a user
1.2. Login
1.3. View/Change Profile
2. Food
2.1. Create Basic Foods
2.2. Edit Basic Food Properties
2.3. Delete Basic Food
2.4. Create Composite Foods
2.5. Edit Composite Foods Properties
2.6. Undo
2.7. Redo
3. Log
3.1. Log daily foods
3.2. View Log
3.3. Update Log Entry
3.4. Delete Log Entry


1.User
A user of the application can register an account and login to begin using it
since then on.

1.1. Register a user

1) From the login click on "Register a new account."
2) In the following name type a username and a password. -- The username must be
a valid string of characters for your operating system because the user data is
saved to a file based on the username. Usernames are unique.
3) Click on the "Register!" button.
4) If everything is successful, the user profile page will come up.
5) Type all the required data in the fields. -- The firstname and lastname
field are not required. All other fields are required, but we have no validation
in place and no test has been done with these fields blank.
6) Click on the "Save profile" button.

1.2. Login

1) In the login screen type your username and password.
2) Click on the "Login" button.
3) If your credentials are valid, the system will take you to your profile page.

1.3. View/Change Profile

1) Once you've login you can click on "My Profile" to view and/or change your
profile.
2) When changes are made, you must click on the "Save profile" button.

2. Food
Based on the food information a user can create basic or composite foods.

2.1. Create Basic Foods

1) Once you've logged in, click on "Food Entry."
2) The "Basic Food" tab is selected by default. Click on "+ Add New Basic Food"
3) Type in the information concerning the food.
4) click on the "Add Food" button.

2.2. Edit Basic Food Properties

1) In the Basic Food tab, click on the pencil icon
2) Edit the information as needed and click on the "Done" button.

2.3. Delete Basic Food

1) In the Basic Food tab, click on the trash bin icon.

2.4. Create Composite Foods

1) In the "Food Entry" page, click on the "Composite Food" tab.
2) Click on "+ Add New Composite Food."
3) Type in the name and keywords for the food.
4) In the combo box select one food to add and type the quantity of services.
5) You can add more food by repeating step 3.
6) Once you're done, click on the "Add Food" button at the bottom of the screen.

2.5. Edit Composite Foods Properties

1) In the Composite Food tab, click on the pencil icon.
2) Edit the food information as needed and click on the "done" button. -- We
only provide the editing of the name and the keywords.

2.6. Save the food database

1) At any given time, feel free to click on the "save" button located next to
the "Basic Foods" or "Composite Foods" titles.

2.7. Undo

1) When you've created some foods, you can undo that action as many times you
like by clicking on the "Undo" button located almost at the bottom of the screen
-- We have some problems when undoing actions and modifying the food properties.

2.8. Redo

1) When you've undone some actions, the "Redo" button will become available.
Clicking on it would redo the previously undone action.

3. Log
The user has a log of his/here consumption daily.


3.1. Log daily foods

1) Once you've logged in, click on "New Log Entry."
2) Clicking on the date field will allow you to change the date.
3) Click on one food of the combo box, type the number of servings and then
click on the Add button
4) You can add as many foods as you like by repeating Step 3.
5) Click on the "Add Food" button at the bottom of the screen.
6) The entry will be added to your daily log. -- The database is saved automati-
cally, so don't enter unsaved food, problems will aire.

3.2. View Log

1) Once you've logged in, click on "Daily Log," a list of log entries will
apppear.

3.3. Update Log Entry

1) In Daily Log page, click on the pencil icon next to a given entry.
2) Update the values accordingly or delete them.
3) Once you're done, click on the "Save log" button.

3.4. Delete Log Entry

1) In the Daily Log page, click on the trash bin icon.
