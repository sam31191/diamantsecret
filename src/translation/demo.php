<?php

error_reporting(0);

require_once("lib/streams.php");
require_once("lib/gettext.php");

$locle_lang = $_GET['lang'];

$locale_file = new FileReader("locale/$locle_lang/LC_MESSAGES/diamantsecret_fr.mo");

$locale_fetch = new gettext_reader($locale_file);

function textTranslate($text){

	global $locale_fetch;

	return $locale_fetch->translate($text);

}

/* -- 404.php STARTS HERE -- */
echo textTranslate("Page not found");//Page title
echo textTranslate("Unfortunately the page you are looking for has been moved or deleted.");
echo textTranslate("Go to homepage");
/* -- 404.php ENDS HERE -- */


/* -- url/header.php STARTS HERE -- */
echo textTranslate("Phone");
echo textTranslate("Hi");
echo textTranslate("Settings");
echo textTranslate("Orders");
echo textTranslate("Logout");
echo textTranslate("Login");
echo textTranslate("Username");
echo textTranslate("Password");
echo textTranslate("Create an account");
echo textTranslate("Toggle main navigation");
echo textTranslate("Account");
echo textTranslate("Register");
echo textTranslate("Collections");
echo textTranslate("Contact");
echo textTranslate("Diamond Search");
echo textTranslate("Search Product");
echo textTranslate("Search");
echo textTranslate("Item Unavailable");
echo textTranslate("Item Deleted or Invalid");
echo textTranslate("Your Cart Is Empty");
echo textTranslate("Subtotal");
echo textTranslate("View Cart");
/* -- url/header.php ENDS HERE -- */


/* -- url/register.php STARTS HERE -- */
echo textTranslate("WEBSITE");
echo textTranslate("USERNAME INVALID");
echo textTranslate("Username not found");
echo textTranslate("Unknown Error");
echo textTranslate("Please contact the system administrator");
echo textTranslate("Password Mismatch");
echo textTranslate("Repeat Password");
echo textTranslate("Next");
echo textTranslate("Back to Homepage");
/* -- url/register.php ENDS HERE -- */


/* -- index.php STARTS HERE -- */
echo textTranslate("Home");//PAGE TITLE
/* -- SLIDER PART TRANSLATION STARTS HERE -- */
echo textTranslate("Live the moment");
echo textTranslate("See Collection");
echo textTranslate("Love’s embrace");
echo textTranslate("Have a Diamond in mind");
echo textTranslate("Search for the perfect diamond for you");
echo textTranslate("Search Now");
/* -- SLIDER PART TRANSLATION ENDS HERE -- */
echo textTranslate("Popular Collections");
echo textTranslate("Rings");
echo textTranslate("See the Collection");
echo textTranslate("Earrings");
echo textTranslate("Pendants");
echo textTranslate("Necklaces");
echo textTranslate("Bracelets");
echo textTranslate("New Products");
echo textTranslate("Select Options");
echo textTranslate("For me, Jewelry is a way to keep the memories alive.");
echo textTranslate("Diamonds are a girl's best friend.");
echo textTranslate("Shop Now");
echo textTranslate("Find your perfect Diamond here");
echo textTranslate("Featured Products");
echo textTranslate("Type");
echo textTranslate("Quantity");
echo textTranslate("Material");
echo textTranslate("Yellow Gold");
echo textTranslate("White Gold");
echo textTranslate("Pink Gold");
echo textTranslate("Silver");
echo textTranslate("Platinum");
echo textTranslate("Size");
/* -- index.php ENDS HERE -- */


/* -- account.php STARTS HERE -- */
echo textTranslate("Account Page");//PAGE TITLE
echo textTranslate("My Account");
echo textTranslate("Account Details");
echo textTranslate("Favorites");
echo textTranslate("Item");
echo textTranslate("Value");
echo textTranslate("Item Not Found");
/* -- account.php ENDS HERE -- */


/* -- cart.php STARTS HERE -- */
echo textTranslate("Name");
echo textTranslate("Email");
echo textTranslate("Unknown");
echo textTranslate("N/A");
echo textTranslate("Enquiry Placed by");
echo textTranslate("An Error Occured; Please Try Again Later");
echo textTranslate("Enquiry Placed");
echo textTranslate("Cart");
echo textTranslate("Address");
echo textTranslate("Payment");
echo textTranslate("Items");
echo textTranslate("Price");
echo textTranslate("Discount");
echo textTranslate("Qty");
echo textTranslate("Total");
echo textTranslate("You save");
echo textTranslate("VAT");
echo textTranslate("Unfortunately, Item Quantity selected is more than our current Stock, adjusted to meet the highest available.");
echo textTranslate("OFF");
echo textTranslate("Remove");
echo textTranslate("Out of Stock");
echo textTranslate("Proceed to Checkout");
echo textTranslate("Currently logged in as");
echo textTranslate("Checkout");
echo textTranslate("Not Logged In");
echo textTranslate("New User");
echo textTranslate("Sign Up");
echo textTranslate("Billing Address");
echo textTranslate("Address Line");
echo textTranslate("City");
echo textTranslate("State");
echo textTranslate("Zip Code");
echo textTranslate("Country");
echo textTranslate("Shipping Address");
echo textTranslate("Back");
echo textTranslate("You would now be redirected to the payment portal");
/* -- cart.php ENDS HERE -- */


/* -- collection.php STARTS HERE -- */ 
echo textTranslate("Collection");
echo textTranslate("Back to the frontpage");
echo textTranslate("View All");
echo textTranslate("View as");
echo textTranslate("Featured");
echo textTranslate("High to Low");
echo textTranslate("Low to High");
echo textTranslate("A");
echo textTranslate("Z");
echo textTranslate("Sale");
echo textTranslate("Remove from Wishlist");
echo textTranslate("Add to Wishlist");
echo textTranslate("No reviews");
echo textTranslate("View Product");
echo textTranslate("Quick View");
echo textTranslate("first");
echo textTranslate("last");
echo textTranslate("Add to Cart");
echo textTranslate("Browse our Rings");
echo textTranslate("Browse our Earrings");
echo textTranslate("Browse our Pendants");
echo textTranslate("Browse our Necklaces");
echo textTranslate("Browse our Bracelets");
echo textTranslate("Increase");
echo textTranslate("Decrease");
/* -- collection.php ENDS HERE -- */


/* -- collection_bracelets.php STARTS HERE -- */
echo textTranslate("Filter");
echo textTranslate("clear selection");
echo textTranslate("Apply");
echo textTranslate("Diamond Clarity");
echo textTranslate("Clarity");
echo textTranslate("Metal");
echo textTranslate("Carat");
echo textTranslate("Subcategory");
echo textTranslate("Select");
echo textTranslate("Price Range");
echo textTranslate("Product Categories");
echo textTranslate("Specials");
echo textTranslate("View");
/* -- collection_bracelets.php ENDS HERE -- */


/* -- collection_earrings.php STARTS HERE -- */
echo textTranslate("grid");
echo textTranslate("List");
/* -- collection_earrings.php ENDS HERE -- */ 

/* -- collection_necklaces.php STARTS HERE -- */
echo textTranslate("Necklace");
/* -- collection_necklaces.php ENDS HERE -- */


/* -- contact.php STARTS HERE -- */
echo textTranslate("Contact Page");// Page title
echo textTranslate("Contact Information");
echo textTranslate("Office Address");
/* -- contact.php ENDS HERE -- */


/* -- dssearch.php STARTS HERE -- */
echo textTranslate("Error while displaying search");
/* -- dssearch.php ENDS HERE -- */


/* -- login.php STARTS HERE -- */
echo textTranslate("Authentication Failed"); 
echo textTranslate("Check your credentials");
echo textTranslate("Account is not activated. Please check your Email to activation instructions.");
echo textTranslate("No User Found");
echo textTranslate("Login Page"); //Page title
echo textTranslate("You have unsubscribed from our newsletter");
echo textTranslate("Forgot your password");
echo textTranslate("or");
echo textTranslate("Return to store");
echo textTranslate("Password Recovery");
echo textTranslate("Invalid Email Address");
echo textTranslate("An email with the instruction to reset your password has been sent to your Inbox");
echo textTranslate("An email with your new password has been sent to your Inbox");
echo textTranslate("Invalid Token");
echo textTranslate("Customer Login");
echo textTranslate("Recover Account");
echo textTranslate("Recover");
echo textTranslate("Close");
/* -- login.php ENDS HERE -- */


/* -- orders.php STARTS HERE -- */
echo textTranslate("My Orders");
echo textTranslate("Amount");
echo textTranslate("Status");
echo textTranslate("Time");
echo textTranslate("Invoice");
echo textTranslate("Approved");
echo textTranslate("Opening");
echo textTranslate("Fetching Info");
/* -- orders.php ENDS HERE -- */


/* -- product.php STARTS HERE -- */
echo textTranslate("Product");
echo textTranslate("Invalid Item");
echo textTranslate("Description");
echo textTranslate("Note");
echo textTranslate("All Pendants will be shipped with a Silver Chain");
echo textTranslate("Tags");
echo textTranslate("Stone");
echo textTranslate("Diamond Color");
echo textTranslate("Length");
echo textTranslate("Measurement");
echo textTranslate("Gold Quality");
echo textTranslate("Gold Weight");
echo textTranslate("Diamonds");
echo textTranslate("No. of Diamonds");
echo textTranslate("Diamond Weight");
echo textTranslate("Diamond Shape");
echo textTranslate("Color Stones");
echo textTranslate("No. of Color Stones");
echo textTranslate("Color Stone Weight");
echo textTranslate("Color Stone Type");
echo textTranslate("Color Stone Shape");
echo textTranslate("You may also like the related products");
echo textTranslate("Select Option");
echo textTranslate("Added");
echo textTranslate("Entries");
echo textTranslate("Add");
/* -- product.php ENDS HERE -- */


/* -- register.php STARTS HERE -- */
echo textTranslate("Account has been verified");
echo textTranslate("Invalid Login Credentials [v1] Click here to [v2] Login [v3]");
echo textTranslate("Verification Link has expired");
echo textTranslate("Register Page");// Page title
echo textTranslate("Account Verified. Please [v4] Login [v5]");
echo textTranslate("Create Account");
echo textTranslate("Confirm Password");
echo textTranslate("First Name");
echo textTranslate("Last Name");
echo textTranslate("Phone Number");
echo textTranslate("Registering");
echo textTranslate("Registered");
echo textTranslate("Please check your passwords");
echo textTranslate("Invalid Email");
echo textTranslate("Username not available");
echo textTranslate("Minimum 6 Characters");
/* -- register.php ENDS HERE -- */


/* -- url/footer.php STARTS HERE -- */
echo textTranslate("Newsletter");
echo textTranslate("We promise only send the good things");
echo textTranslate("Your Email Address");
echo textTranslate("About Us");
echo textTranslate("Contact Us");
echo textTranslate("Preferences");
echo textTranslate("My Cart");
echo textTranslate("Diamant Secret");
echo textTranslate("All Rights Reserved");
/* -- url/footer.php ENDS HERE -- */

?>