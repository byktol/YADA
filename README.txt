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
