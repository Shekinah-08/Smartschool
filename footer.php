<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .footer {
            background-color: #f5f6f7;
            padding: 20px 0;
        }
        .footer-links a, .footer-extra a, .footer-follow a {
            color: #385898;
            margin-right: 15px;
            font-size: 14px;
            text-decoration: none;
        }
        .footer-links a:hover, .footer-extra a:hover, .footer-follow a:hover {
            text-decoration: underline;
        }
        .footer-contact-info {
            color: #616770;
            font-size: 14px;
            line-height: 1.6;
        }
        .footer-copy {
            color: #616770;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <!-- Footer -->
    <footer class="footer mt-auto py-3">
        <div class="container">
            <div class="row">
                <!-- Quick Links -->
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <div class="footer-links">
                        <?php
                        $quick_links = [
                            'Acceuil' => 'index.php',
                            'Inscription' => 'register.php',
                            'About' => 'about.php',
                            'Contact' => 'contact.php'
                        ];
                        
                        foreach ($quick_links as $name => $url) {
                            echo "<a href='$url'>$name</a><br>";
                        }
                        ?>
                    </div>
                </div>
                <!-- Extra Links -->
                <div class="col-md-3">
                    <h5>Extra Links</h5>
                    <div class="footer-extra">
                        <?php
                        $extra_links = [
                            'Connexion' => 'login.php',
                            'Inscription' => 'register.php'
                        ];
                        
                        foreach ($extra_links as $name => $url) {
                            echo "<a href='$url'>$name</a><br>";
                        }
                        ?>
                    </div>
                </div>
                <!-- Contact Info -->
                <div class="col-md-3">
                    <h5>Contact Info</h5>
                    <div class="footer-contact-info">
                        <p>+243 992342666</p>
                        <p>
                      <a href="messages_list.php">Messages</a>
                       </p>
                        <p><a href="mailto:shekinah@gmail.com">shekinah@gmail.com</a></p>
                        <p>Kinshasa Lemba / UNIKIN</p>
                    </div>
                </div>
                <!-- Follow Us -->
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <div class="footer-follow">
                        <?php
                        $social_links = [
                            'Facebook' => 'https://facebook.com',
                            'Twitter' => 'https://twitter.com',
                            'Instagram' => 'https://instagram.com',
                            'LinkedIn' => 'https://linkedin.com'
                        ];
                        
                        foreach ($social_links as $name => $url) {
                            echo "<a href='$url' target='_blank'>$name</a><br>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Copyright -->
            <div class="row">
                <div class="col-12 text-center footer-copy">
                    <p>© Copyright 2024 by Mr. Shekinah Mukela Web Designer | Tous droits réservés!</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
