# I have been assign to do back end and the back end 100% complete on a  Hotel Guest House Booking system and the other guys will do the front end creating beautifull interface and host site and the site come live as soon as possible
Technologies that have been used
-Programming language: PHP Framework laravel
-Security: Laravel built In Auth
-Database: Mysql tables(rooms,bookings,users)
-Vanilla JavaScript for creating the stripe element
-Bootstrap has been for success and error message
#How does the application structured
#My Application has 3 Controllers
#AuthController
AuthController is responsible registering and authenticate the users and enable the user change his or her password when he/she forgets the change password is sent via email
#Booking Controller
The BookingController ensuring that user is making bookings,update and cancel bookings
The BookingController also working with the BookingValidator to ensure that users cannot book twice and allocating rooms to clients
Note If a user makes a booking and not pay for that booking that booking is automatically deleted
#CheckOut Controller
The checkout controller for allowing to pay using credit/debit carts and delete the booking under booking table and stores bookings under checkout for allowing successful bookings
The payment gateway we use is stripe
#How does the application works
1. user first register 
2. user logs in with valid credentials and will be redirected to create bookings
3. user make a booking If rooms are full within the specified  dates a message will appear, else if she/he books more he/she will not be allowed to do so thats part of the business rules ,if everything is successful he/she will proceed to make payments if payments is successfully an email message be sent to the clients.
4. When user booking was successfully he/she will come with the email as proof that she/he pays the will contain his or her name,booking number,room number,check in date and check out date.
