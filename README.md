# Distributedsystems course
Helsinki University course Distributed Systems 2017 Spring

# Requirements
Internet connection for jQuery library
Web server with PHP support and exec allowed
Proper user rights for writing plot and png files

# Documentation

## 1.php basic server side calculator.
Write a web-based calculator which uses a simple input form and performs all the calculation on the server side.

Backend is done with php and values are stored to session variable. This way I can keep track of previous calculations.

## 2.php step 1.
Migrate some of the functionality of the calculator to the client side using Javascript.

I have implemented simple recursive function that calls itself until all calculations are completed. All values and operators from input field are parsed to arrays and then sent to server. With server result the calculation is continued till the end. No special cases are taken care of.

## 3.php step 2.
Add functionality to plot sine functions.

I made PHP script that sends the multiplier to GNUPLOT which then sends the png file back. I have tried this with Linux and OSx hosts.

## 4.php step 2 variant 2.
In the second variant, plot the figure locally on the client.

The input form again takes only the multiplier for plotting graph. Then I draw the sine wave using this multiplier with canvas

## 5.php step 2 variant 3.
Server does the calculations and the client does the plotting.

I am using the same recursive function from step 1 to send values to server and for final value I draw the line using variant 2 from step 2.

## 6.php step 3.
Implement caching of results on the client side. 
