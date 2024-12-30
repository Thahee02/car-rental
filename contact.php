<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | RentaCar</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php include('./assets/components/menu.php'); ?>

    <section class="contact-banner">
        <h1>Contact Us</h1>
        <div class="breadcrumb">Home / <span>Contact</span></div>
    </section>

    <!-- First Section: Map and Content -->
    <section class="map-and-content">
        <!-- Google Map -->
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8962.530708269649!2d81.35763760885938!3d7.966127398767416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afb23c45931e951%3A0x9312803259f541dd!2sICST%20University%20Park!5e0!3m2!1sen!2slk!4v1735575490012!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Contact Us for Your Travel Needs</h2>
            <p>Whether you’re planning your next road trip, require assistance with car rentals, or have any questions about our wide range of services, we are always here to provide support. Our dedicated team is committed to addressing your inquiries and ensuring that your travel plans are seamless and stress-free. From helping you choose the perfect vehicle to providing expert guidance, we aim to deliver an exceptional experience every step of the way. Don’t hesitate to reach out to us, and let us ensure your journey is memorable and enjoyable.</p>
            <p>At our company, we believe that excellent service goes hand in hand with unforgettable travel experiences. Whether you’re looking for a compact car for a city getaway or a spacious SUV for a family road trip, our extensive fleet has the perfect vehicle to suit your needs. We are dedicated to making your car rental experience as smooth and convenient as possible. Our team is always ready to assist with booking, answering any questions, and providing helpful travel tips. Reach out to us today, and let us take care of the details while you focus on enjoying your journey.</p>
        </div>
    </section>

    <!-- Second Section: Contact Details and Form -->
    <section class="contact-details-and-form">
        <!-- Contact Details -->
        <div class="contact-details">
            <h3>Contact Details</h3>
            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M19.95 21q-3.125 0-6.175-1.362t-5.55-3.863t-3.862-5.55T3 4.05q0-.45.3-.75t.75-.3H8.1q.35 0 .625.238t.325.562l.65 3.5q.05.4-.025.675T9.4 8.45L6.975 10.9q.5.925 1.187 1.787t1.513 1.663q.775.775 1.625 1.438T13.1 17l2.35-2.35q.225-.225.588-.337t.712-.063l3.45.7q.35.1.575.363T21 15.9v4.05q0 .45-.3.75t-.75.3"/></svg>Phone: +1 234 567 890</p>
            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 12q.825 0 1.413-.587T14 10t-.587-1.412T12 8t-1.412.588T10 10t.588 1.413T12 12m0 10q-4.025-3.425-6.012-6.362T4 10.2q0-3.75 2.413-5.975T12 2t5.588 2.225T20 10.2q0 2.5-1.987 5.438T12 22"/></svg> Address: 123 Main Street, Melbourne, VIC 3000</p>
        </div>

        <!-- Contact Form -->
        <div class="contact-form">
            <h3>Send Us a Message</h3>
            <form action="process_contact.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name..." required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email..." required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" placeholder="Enter your message..." required></textarea>

                <button type="submit">Send</button>
            </form>
        </div>
    </section>

    <?php include('./assets/components/footer.php'); ?>

    <script src="./assets/js/script.js"></script>
</body>
</html>