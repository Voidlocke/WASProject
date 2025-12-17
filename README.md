# Group Member
- Member 1: Nasrun Asri Bin Muhammad (2210479)
- Member 2: Sofwan Bin Aliza (2224483)
- Member 3: Muhd Iskandar Bin Yong Fui Min (2214527)
- Member 4: Muhammad Zarul Hafizzuddin Bin Mohd Zaidi (2215331)
- Member 5: Esma Dennis Bin Mohd Adam (2316821)

#  Moonlit Lagoon Hotel - Hotel Management System

# Introduction of the Web Application
  A **Hotel Management System** is a web application platform designed to simplify hotel operations and provide an enhanced experience for guests. It enables administrators and customers to efficiently manage various aspects of hotel services, such as user accounts, room allocations, bookings, payments and ratings and reviews. By incorporating CRUD (Create, Read, Update, Delete) functionalities, the system ensures effective data handling, making it a reliable and user-friendly solution for the hospitality industry.

  The system’s features cover five main areas: **User Profiles, Bookings, Payments, Reviews & Ratings and Admin Control Panel**. Customers can create and manage user profiles, search for and book their prefered rooms as well as leave reviews for their stays, while administrators can oversee room allocations, track bookings and manage guest details in bookings. These features work together to ensure both convenience for customers and operational efficiency for our hotel staff. For instance, users can view booking histories and receipts, update personal details, or cancel reservations, while admins can adjust room allocation and monitor customer bookings.
   
  Overall, the **Hotel Management System** provides a robust and integrated approach to handling hotel operations. It simplifies complex tasks like managing payments or processing customer bookings and provide more efficient and satisfying guest experience. With its intuitive design and emphasis on data accuracy, the system enhances productivity for hotel staff while offering convenience to customers. This makes it an essential tool for modernizing hotel management processes.
    
# Objectives of the Enhancements
The objectives of enhancments are: 

1. To protect the application from malicious or invalid user input by enforcing strict validation rules, ensuring data integrity, and preventing common security attacks such as injection and XSS.

2. sorg satu

3. sorg satu

4. sorg satu

5. To strengthen the security of the Hotel Management System by protecting the database against SQL injection attacks, unauthorized access, and data exposure, while ensuring secure, reliable, and maintainable database interactions.

# Web Application Security Enhancements

   ## Input Validation
   ### 1. Register
   ### a) Server-side Validation
   ![Alt text](gambar/codebeforeregisterserver.png)
   #### i) Name (Whitelist + Normalization)
   - For the name input, a whitelist validation approach is applied where only alphabetic characters, spaces, apostrophes ('), hyphens (-), and dots (.) are allowed. Any other symbols or numbers are rejected. In addition, the name is normalized before being stored in the database by trimming extra spaces and converting it to Title Case, where the first letter of each word is uppercase and the remaining letters are lowercase. This ensures consistent and clean user data.
   
   #### ii) Password (Whitelist)
   - The password field uses whitelist validation rules that require a minimum length of 8 characters and enforce the presence of at least one alphabetic character and one numeric digit. This ensures stronger password complexity and reduces the risk of weak or easily guessable passwords.

   ### b) Client-side Validation
   gambar code
   #### i) Name (Whitelist + Input Filtering)
   - For the name input, client-side input filtering is applied using JavaScript (oninput) to restrict the characters that can be typed. Only alphabetic characters, spaces, apostrophes ('), hyphens (-), and dots (.) are allowed, while other characters such as numbers and special symbols are automatically removed. The input is also formatted in real time by collapsing multiple spaces and converting the text to Title Case to improve consistency and user experience before submission.

   ### 2. Payment
   ### a) Server-side Validation
   gambar code
   #### i) Cardholder Name (Whitelist + Normalization)
   - A whitelist validation approach is applied to the cardholder name field where only alphabetic characters, spaces, apostrophes ('), and hyphens (-) are allowed. The input is also normalized on the server by converting it to uppercase before processing. This prevents invalid characters and ensures consistent formatting of cardholder names.

   #### ii) Card Number (Whitelist)
   - The card number is validated using whitelist rules that require exactly 16 digits. To support formatted input (e.g., 0000 0000 0000 0000), the server normalizes the card number by removing spaces and non-digit characters before validation. This ensures the system only processes numeric digits and prevents invalid or manipulated values.

   #### iii) Expiry Date (Whitelist)
   - The expiry date uses whitelist validation with a strict format rule (MM/YY). The month is restricted to valid values (01–12) and the input is rejected if it does not follow the expected pattern. This ensures the expiry value is valid and consistent.

   #### iv) CVV (Whitelist)
   - The CVV field is validated using whitelist rules that require exactly 3 digits. This prevents users from entering longer values or non-numeric input.

   ### b) Client-side Validation
   gambar code
   #### i) Cardholder Name (Whitelist + Input Filtering)
   - Client-side filtering is applied using oninput to restrict characters typed by the user. Only allowed characters remain, and the input is automatically converted to uppercase. This improves usability and prevents accidental invalid input before submission.

   #### ii) Card Number (Whitelist + Formatting + Length Restriction)
   - Client-side input formatting is applied so the card number automatically groups digits into blocks of 4 (e.g., 0000 0000 0000 0000). The form limits the card number to a maximum of 16 digits and removes any non-numeric characters during typing/paste. This improves user experience and reduces input mistakes.

   #### iii) Expiry Date (Whitelist + Formatting + Length Restriction)
   - Client-side formatting ensures the expiry date accepts only numeric input and automatically inserts a / after the first two digits, producing the MM/YY format. This helps users input the correct format more easily.

   #### iv) CVV (Whitelist + Length Restriction)
   - Client-side restrictions such as maxlength=3, numeric-only input filtering, and pattern validation ensure the user can only enter 3 digits. Any extra digits are not accepted, reducing errors.

   ### 3. Review
   ### a) Server-side Validation
   gambar code
   #### i) Review Text (Whitelist)
   - The review text uses whitelist validation to allow only letters, numbers, spaces, and basic punctuation (e.g., . , ! ? ' - ( )). Any other special symbols are rejected.

   ### b) Client-side Validation
   gambar code
   #### i) Review Text (Whitelist + Input Filtering)
   - Client-side filtering is applied on the review textarea using oninput to remove invalid characters immediately as the user types or pastes text.

gambar ui
    
   

3. Bookings system is used to handle customer reservations. Customers can create bookings by selecting their preferred dates, room type and the number of guests. Once a booking is made, customers can read and review the booking details, including booking status and dates. Admins have the ability to see and manage all bookings. Customers can update their reservations by changing the dates or the number of guests before payment. The delete feature allows customers to cancel their bookings.

4. Payments system manages all aspects of booking payments. Upon booking confirmation, customers will enter their bank details, including the name on the bank card, the card number, expiration date and CVV, to process the payment. Once payment is made, customers will receive receipts for their transactions, and admins can track payments and their statuses to ensure all financial records are up to date. Customers can view their payment receipts to mark payments as successful. In case of cancellations before payment confirmation, customers can cancel their payments, and admins can delete any invalid transactions that may arise.

5. Reviews & Ratings are for gathering customer feedback on services. After their stay, customers can create reviews and ratings for the rooms, sharing their experiences with future guests. These reviews are displayed for all to see on the booking pages, helping others make informed decisions. Customers also have the option to update their reviews within a specified timeframe, providing them with the flexibility to revise their feedback if needed. Admins monitor and delete inappropriate or spammy reviews to ensure that only valid, helpful feedback is visible.

6. ## Database Security Principles

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

      .env.example

      Before modified,

      <img width="543" height="99" alt="image" src="https://github.com/user-attachments/assets/6f24b104-6056-4628-9836-5516cfd86a27" />

      After modified,

      <img width="636" height="121" alt="image" src="https://github.com/user-attachments/assets/bdc254cc-9f47-4aeb-a1f3-2515acd36c42" />

      config/database.php

      Before modified,

      <img width="894" height="481" alt="image" src="https://github.com/user-attachments/assets/05a04dcf-998d-426b-a916-d94b45dde01a" />

      After modifed,

      <img width="1009" height="502" alt="image" src="https://github.com/user-attachments/assets/2e846717-c1a7-432a-8fc8-5618d727ce4c" />

      Note of usage: Encrypted database connections are configured at the application level and enabled in production environments where the database is accessed over a network. For local development using XAMPP, SSL is not enforced as the database runs on the same host. TLS certificates (ca.pem) are provided by hosting provider (production) and cloud DB services.

   - ***Restrict User-Controlled SQL Components***
  
      **What does this principle to the web app:**

     This principle prevents SQL Injection and logic abuse by ensuring that users cannot control SQL structure such as column names, sort directions, table names. Only predefined, whitelisted values are allowed.

     **Files Modified/Created:**

     app/Http/Controllers/RoomController.php

     Before modified,

     <img width="685" height="181" alt="image" src="https://github.com/user-attachments/assets/c5582563-7af9-4cd2-bdde-9181e696d22e" />
  
     After modified,

     <img width="1070" height="489" alt="image" src="https://github.com/user-attachments/assets/39c44379-59da-4a9d-a945-58f98a458c9f" />

## References
1. Bukit Bintang Accommodation | JW Marriott Hotel Kuala Lumpur. (n.d.). Marriott Bonvoy. https://www.marriott.com/en-us/hotels/kuldt-jw-marriott-hotel-kuala-lumpur/rooms/
2. The Regency Hotel – Kuala Lumpur. (n.d.). https://theregencyhotel.my/kualalumpur/
3. Wondershare Edraw. (2021, December 9). UML Sequence Diagram Tutorial | Easy to Understand with Examples [Video]. YouTube. https://www.youtube.com/watch?v=gzKe7yt8qEo
