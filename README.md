phpZipLocator
=============

A PHP simple class to find distances between two zip codes and also find zipcodes/dealers within a radius given a zipcode


## Get going


phpZipLocator needs a database with a table called zipData containing data for
ZipCodes to work properly

You can grab a zip file with the necesary data and table structure from here
http://www.sanisoft.com/ziploc/phpZipLocatorData.zip (389Kb) This is a bit old

Place the contents of the phpZipLocator somewhere in your web document tree

Edit the file db_mysql.inc to have the proper details of the database where you
have the zipData table (you should ensure that this file is not seen from the browser)

*Try accessing the ziptest.php file - you will get the following output if everything is right*

The distance between 12345 and 23456 is 433.1607605336 Miles.
There are 107 Zip codes within 20 Miles of 12345.


See comments in phpZipLocator.php for the methods.
See ziptest.php for sample usage.

See http://distance-calculation.com/Distance-Calculation.asp for a nice article on
distance calculation and try and figure out (im)precise phpZipLocator is ;-)

Lastly remember that this class is more of an example rather than a complete solution. Feel free to adapt it to your use case. Also your results will be as good as your data