# I have been assign to do back end and the back end nearly complete on a  Hotel Guest House Booking system and the other guys will do the front end creating beautifull interface and host site and come live as soon as possible
Technologies that have been used
-Programming language: PHP Framework laravel
-Security: Laravel built In Auth
-Database: Mysql tables(rooms,bookings,users)
-Vanilla JavaScript for creating the stripe element
-Bootstrap has been for success and error message
#How does the application structured
#My Application has 3 Controllers
#AuthController
AuthController is responsible registering and authenticate the users.
#Booking Controller
The BookingController ensuring that user is making bookings and cancel bookings
The BookingController also working BookingValidator to ensure that users cannot book twice and allocating rooms to clients
#CheckOut Controller
The checkout controller for allowing pay using credit/debit carts and delete the booking under booking table and stores bookings under checkout for allowing successful bookings
#How does the application works
1. user first register 
2. user logs in with valid credentials and will be redirected to create bookings
3. user make a booking If rooms are full within the specified  dates a message will appear, else if she/he books more he/she will not be thats part of the business rules ,if everything is successful he/she will proceed to make payments if payments is successfully an email message be sent to the clients.
4. when successfully will come with the email as proof that she/he pays.
