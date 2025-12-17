## Group Member
- Member 1: Nasrun Asri Bin Muhammad (2210479)
- Member 2: Sofwan Bin Aliza (2224483)
- Member 3: Muhd Iskandar Bin Yong Fui Min (2214527)
- Member 4: Muhammad Zarul Hafizzuddin Bin Mohd Zaidi (2215331) #
- Member 5: Esma Dennis Bin Mohd Adam (2316821)

#  Moonlit Lagoon Hotel - Hotel Management System

## Introduction of the Web Application
  A **Hotel Management System** is a web application platform designed to simplify hotel operations and provide an enhanced experience for guests. It enables administrators and customers to efficiently manage various aspects of hotel services, such as user accounts, room allocations, bookings, payments and ratings and reviews. By incorporating CRUD (Create, Read, Update, Delete) functionalities, the system ensures effective data handling, making it a reliable and user-friendly solution for the hospitality industry.

  The system’s features cover five main areas: **User Profiles, Bookings, Payments, Reviews & Ratings and Admin Control Panel**. Customers can create and manage user profiles, search for and book their prefered rooms as well as leave reviews for their stays, while administrators can oversee room allocations, track bookings and manage guest details in bookings. These features work together to ensure both convenience for customers and operational efficiency for our hotel staff. For instance, users can view booking histories and receipts, update personal details, or cancel reservations, while admins can adjust room allocation and monitor customer bookings.
   
  Overall, the **Hotel Management System** provides a robust and integrated approach to handling hotel operations. It simplifies complex tasks like managing payments or processing customer bookings and provide more efficient and satisfying guest experience. With its intuitive design and emphasis on data accuracy, the system enhances productivity for hotel staff while offering convenience to customers. This makes it an essential tool for modernizing hotel management processes.
    
## Objectives of the Enhancements
The objectives of this Hotel Management System are: 

1. To enable users to manage their profiles and booking details, and provide reviews through the implementation of CRUD functionalities, ensuring all user data is properly stored in the database.

2. To provide hotel administrators with tools for managing room details, monitoring reservations and handling payment records to ensure efficient data processing.

3. To implement review and rating features that allow customers to provide feedback on their stay and access reliable information for future booking decisions.

## Web Application Security Enhancements

1. User Profiles are designed to manage user accounts effectively. The creation process involves registering users with essential details such as name, email, password and contact information. Users can then read and access their profiles, including viewing their booking history and payment methods. The update feature allows users to edit their profile information, such as personal details and contact information ensuring their profiles are always up to date. In case of account deactivation, users can delete or deactivate their accounts, with admins overseeing the process.

2. Bookings system is used to handle customer reservations. Customers can create bookings by selecting their preferred dates, room type and the number of guests. Once a booking is made, customers can read and review the booking details, including booking status and dates. Admins have the ability to see and manage all bookings. Customers can update their reservations by changing the dates or the number of guests before payment. The delete feature allows customers to cancel their bookings.

3. Payments system manages all aspects of booking payments. Upon booking confirmation, customers will enter their bank details, including the name on the bank card, the card number, expiration date and CVV, to process the payment. Once payment is made, customers will receive receipts for their transactions, and admins can track payments and their statuses to ensure all financial records are up to date. Customers can view their payment receipts to mark payments as successful. In case of cancellations before payment confirmation, customers can cancel their payments, and admins can delete any invalid transactions that may arise.

4. Reviews & Ratings are for gathering customer feedback on services. After their stay, customers can create reviews and ratings for the rooms, sharing their experiences with future guests. These reviews are displayed for all to see on the booking pages, helping others make informed decisions. Customers also have the option to update their reviews within a specified timeframe, providing them with the flexibility to revise their feedback if needed. Admins monitor and delete inappropriate or spammy reviews to ensure that only valid, helpful feedback is visible.

5. ### Database Security Principles

    - ***Secure Error Handling***
  
      **What does this principle to the web app:**

      Prevents SQL errors (table names, query fragments, column names) from leaking to the user, which attackers can use to craft more precise attacks

      **Files Modified/Created:**

      bootstrap/app.php was modified

      Before modified,

      <img width="860" height="96" alt="image" src="https://github.com/user-attachments/assets/6c2c48ea-0c4f-43e6-a749-a4486a8b72fb" />,

      After modified,

      <img width="496" height="43" alt="image" src="https://github.com/user-attachments/assets/b0670aa8-d6ff-44c4-82fe-76f66fa25f86" />

      <img width="871" height="259" alt="image" src="https://github.com/user-attachments/assets/9ef63977-b173-4fc8-b60a-de46b47dc367" />

      New file resources/views/errors/500.blade.php also was created to support the modified file

      <img width="1444" height="373" alt="image" src="https://github.com/user-attachments/assets/39843b46-093a-4d3b-9540-e572a562d2a1" />

   - ***Input Validation (Whitelisting)***

      **What does this principle to the web app:**

     Previous web application state accepts many user-controlled inputs that affect database records, such as room_id, checkin_date, checkout_date, guest_count, card_number. If these are not strictly validated, attackers can send malformed or malicious payload. This principle only allow expected formats/values and not try to filter bad things.

     **Files Modified/Created:**

     app/Http/Controllers/BookingController.php

     Before modified,

     <img width="766" height="249" alt="image" src="https://github.com/user-attachments/assets/8cd5f9b9-391c-44e5-afd1-3202cbadd9f9" />

     After nodified,

     <img width="662" height="48" alt="image" src="https://github.com/user-attachments/assets/5ad798a0-f1fb-4325-afb5-405f4f06a746" />

     <img width="959" height="465" alt="image" src="https://github.com/user-attachments/assets/bd672906-21fe-43b9-bcaa-b5ae996d54ee" />

     New file app/Http/Requests/StoreBookingRequest.php also was created to support the modified file

     <img width="931" height="494" alt="image" src="https://github.com/user-attachments/assets/54515825-71fe-4994-a096-e36c11e70337" />

     app/Http/Controllers/RoomController.php

     Before modified,

     <img width="699" height="128" alt="image" src="https://github.com/user-attachments/assets/ee7c0149-db90-4b57-98a2-4c63b205b05c" />

     After modified,

     <img width="1011" height="118" alt="image" src="https://github.com/user-attachments/assets/57bf718d-42a5-4fcd-a2c5-3de01eca2f26" />

     app/Http/Controllers/PaymentController.php

     Before modified,

     <img width="680" height="193" alt="image" src="https://github.com/user-attachments/assets/8c69c8c9-bdc4-48cd-b46c-4bd80294846b" />

     After modified,

     <img width="569" height="53" alt="image" src="https://github.com/user-attachments/assets/4c61d2a1-80b5-476b-81bb-fe8800269182" />

     <img width="801" height="222" alt="image" src="https://github.com/user-attachments/assets/d71161a4-629c-4307-b50f-251d75300297" />

     New file app/Http/Requests/StorePaymentRequest.php also was created to support the modified file

     <img width="833" height="551" alt="image" src="https://github.com/user-attachments/assets/4e826d2d-54e3-4785-8231-28a539ad953a" />

   - ***Stored Procedures***

      **What does this principle to the web app:**

     This principle is used to prevent race conditions in this web application (e.g. two users booking the last room) and inconsitent data

     **Files Modified/Created:**

     app/Http/Controllers/BookingController.php

     Before modified,

     <img width="756" height="314" alt="image" src="https://github.com/user-attachments/assets/6f44cdb5-8cb6-4794-8260-61f969db70bf" />

     After modified,

     <img width="1125" height="520" alt="image" src="https://github.com/user-attachments/assets/623bf9cc-fbd6-4906-93bd-3f6851ca1b4c" />

     New file database\migrations\2025_12_16_093152_create_stored_procedures.php also was created to support the modified file

     <img width="946" height="838" alt="image" src="https://github.com/user-attachments/assets/c0720781-dfa8-4420-91cc-d05795b55f2f" />

     <img width="769" height="683" alt="image" src="https://github.com/user-attachments/assets/a2a0b0c8-b3e3-4af5-9229-c4c83ee43c42" />

    - ***Encrypted Database Connections (TLS/SSL)***

      **What does this principle to the web app:**

      This principle ensures that data transmitted between the web application server and the databse server is encrypted. Sensetive information (credentials, user data, bookings, payments) cannot be intecepted (man-in-the-middle attack) and read in plain text on the network. This is achieved by enabling TLS/SSL encryption for database connections.

      **Files Modified/Created:**

      .env

      Before modified,

      <img width="543" height="99" alt="image" src="https://github.com/user-attachments/assets/6f24b104-6056-4628-9836-5516cfd86a27" />

      After modified,

      <img width="636" height="121" alt="image" src="https://github.com/user-attachments/assets/bdc254cc-9f47-4aeb-a1f3-2515acd36c42" />

      config/database.php

      Before modified,

      <img width="894" height="481" alt="image" src="https://github.com/user-attachments/assets/05a04dcf-998d-426b-a916-d94b45dde01a" />

      After modifed,

      <img width="1009" height="502" alt="image" src="https://github.com/user-attachments/assets/2e846717-c1a7-432a-8fc8-5618d727ce4c" />




   



     
   
## References
1. Bukit Bintang Accommodation | JW Marriott Hotel Kuala Lumpur. (n.d.). Marriott Bonvoy. https://www.marriott.com/en-us/hotels/kuldt-jw-marriott-hotel-kuala-lumpur/rooms/
2. The Regency Hotel – Kuala Lumpur. (n.d.). https://theregencyhotel.my/kualalumpur/
3. Wondershare Edraw. (2021, December 9). UML Sequence Diagram Tutorial | Easy to Understand with Examples [Video]. YouTube. https://www.youtube.com/watch?v=gzKe7yt8qEo
