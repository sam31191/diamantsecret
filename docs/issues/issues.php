<?php

New user registration msg nok
New user registration fields width
new user registration 
email subscription - empty email - show message already subscribed..



email subscription:
- don't show exactly what we are looking for.. instead enter valid email id.. 

we are redirected to home page if session is expired.. best is to redirect to login page & it remembers where you was..




------------------------------------

Add 404 page


Subscribed successfully - on same page, little bigger

------------------------------------------------------------------------------
later:
http://localhost/git/diamantsecret/src/account.php
\( ! ) Warning: Cannot modify header information - headers already sent by (output started at C:\wamp\www\git\diamantsecret\src\url\header.php:106) in C:\wamp\www\git\diamantsecret\src\account.php on line 178


Below when we clicked on logout button on admin:
( ! ) Warning: Cannot modify header information - headers already sent by (output started at C:\wamp\www\git\diamantsecret\src\url\header.php:19) in C:\wamp\www\git\diamantsecret\src\url\header.php on line 32


When user is logged our from another tab & admin login page is open & user enters admin password there:
( ! ) Notice: Undefined index: username in C:\wamp\www\git\diamantsecret\src\admin\login.php on line 42
Call Stack
#	Time	Memory	Function	Location
1	0.0010	259144	{main}( )	..\login.php:0
'
------------------------------------------------------------------------------

samplle products upload format file: 
- give link in left bar to download sample file (optional)
- C:\wamp\www\git\diamantsecret\src\admin\assets\format.xlsx - it should not be here & to be generated on fly
- above file should possibly be created in RAM or like we did for export (remove file after download, cronjob will take care of any leftover work)

Add to wish list not working for admin (added from product detailed view)
Link on Item name in cart nok. It is pointing to Products page & not specific item page

No need to bold VAT in cart

Remember me flag (optional)

Admin login page:
redirect it to login page if session not valid


Recover password: No error on incorrect email id..
//Recover password: We reset password there & then, someone else can keep on resetting password.


On top right menu - what's the difference between Favourites & Settings link ?

Pendants add new 
- spellings of decimal
- select in "diamond shape", "clarity", "color", "material", country, company, ring subcategory


kick out old user if new user is logged in..


Product details:
Quick view - remove lipsum hyperlink on name
Quick view - bottom scroller images of fixed size
Quick view - images size should be fixed (both in case of small or large image)
Detailed page: 
- max image size to be fixed
- when we move to smaller image after large image, bottom buttons are not clickable as it has impression of previous bigger image

http://localhost/git/diamantsecret/src/collection.php
-product display size should be fixed


later on deployment:
http://localhost/git/diamantsecret/src/contact.php
check google maps


new registration page:
- phone number field: scroller not required
- no loading box when we press registration button
- Use Ajax to verify if user already exists / Form is reset if user already exists
- Use Ajax to verify if email in use
- confirm password (optional) or show eye to view password


later:
check smtp performance



Testsite:
- email links to point to testsite instead of main site


difference b/w Products upload.xlsx file in /docs & /etc ?

?>
