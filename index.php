<?php
    session_start();

    require_once __DIR__ . '/classes/SessionManager.class.php';
    use Classes\SessionManager;

    $csrf_token = new SessionManager();
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- TITLE -->
        <title>Cleaning Service</title>
        
        <!--SHORTCUT ICON
        <link rel="shortcut icon" href="images/#">-->
        
        <!-- META TAGS -->
        <meta charset="UTF-8">
        <meta name="language" content="ES">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        
        <!--FONT AWESOME-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!--GOOGLE FONTS-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Mukta:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"> 
        
        <!-- STYLE SHEET -->
        <link rel="stylesheet" href="assets/css/normalize.css">
        <link rel="stylesheet" href="assets/css/main.css">
        
    </head>
    <body>
    
        <!--MAIN-->
        <?php include 'includes/countrycodes.inc.php'; ?>
        <main>
            <div class="flex container">
                <section class="flex-content padding_2x">
                    <article>
                        <a href="#"><img class="logo" src="assets/images/Done and Dusted Logo.png" alt="Site logo"></a>
                        <h1 class="title big">Best <em>Commercial & Residential</em> Cleaning Service.</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        <a href="#" class="btn1">Book a service <i class="fa fa-arrow-right"></i></a>
                    </article>
                </section>
                <section class="flex-content padding_2x">
                </section>
            </div>
        </main>
        
        <!--SECTION1-->
        <div class="section1 container">
            <section class="flex-content padding_2x">
                <em class="tag">ABOUT US</em>
                <h1 class="title medium">We help you to keep your place clean</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <em style="color:var(--secondary)">It is a long established fact</em>
            </section>
            <section class="flex-content padding_2x">
                <form id="form" class="padding_2x" method="POST" action="bootstrap.php">
                    <input type="hidden" name="csrf_token_services" id="csrf_token_services" value="<?php echo $csrf_token->generateCsrfToken(); ?>">
                    <h2 class="small">Book a service</h2>
                    <div class="success hide"><span></span></div>
                    <fieldset>
                        <label for="fname">Your name</label>
                        <input type="text" name="fname" id="fname" maxlength="60" placeholder="full name"/>
                        <div class="error hide"><span></span></div>
                    </fieldset>
                    <fieldset>
                        <label for="cno" id="cno">Contact number</label>
                        <input type="tel" name="cno" maxlength="15" placeholder="contact number"/>
                        <div class="error hide"><span></span></div>
                    </fieldset>
                    <fieldset>
                        <label for="zip" id="zip">Zip code</label>
                        <input type="tel" name="zip" maxlength="8" placeholder="zip code"/>
                        <div class="error hide"><span></span></div>
                    </fieldset>
                    <fieldset>
                        <label for="service">Choose a service</label>
                        <select name="service" id="service">
                            <option value="Residential Cleaning">Residential Cleaning</option>
                            <option value="Commercial Cleaning">Commercial Cleaning</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="error hide"><span></span></div>
                    </fieldset>
                    <fieldset>
                        <button id="form_btn" class="btn2">SUBMIT DETAILS</button>
                    </fieldset>
                </form>
            </section>
        </div>
        
        <!--SECTION2-->
        <div class="sections section2 padding_2x">
            <article class="cards padding_2x container">
                <section class="flex-content padding_2x">
                    <figure>
                        <img src="assets/images/01.png" alt="" loading="lazy">
                    </figure>
                    <h2 class="title small">Pick a <em>service</em></h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </section>
                <section class="flex-content padding_2x">
                    <figure>
                        <img src="assets/images/02.png" alt="" loading="lazy">
                        <h2 class="title small"><em>Schedule</em> with us</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </figure>
                </section>
                <section class="flex-content padding_2x">
                    <figure>
                        <img src="assets/images/03.png" alt="" loading="lazy">
                        <h2 class="title small">Get things <em>done</em></h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </figure>
                </section>
            </article>
        </div>
        
        <!--SECTION4-->
        <div class="section4 flex container">
            <section class="flex-content padding_2x">
                <figure>
                    <img src="assets/images/05.jpg" alt="">
                    <span class="padding_1x">
                        <p class="title medium">5+</p>
                        <em>Years of experience</em>
                   </span>
                </figure>
            </section>
            <section class="flex-content padding_2x">
                <em class="tag">WHY CHOOSE US?</em>
                <h1 class="title medium">We provide the best services for your help!</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <ul>
                    <li>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</li>
                    <li>When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</li>
                    <li>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</li>
                </ul>
            </section>
        </div>
        
        <!--SECTION3-->
        <div class="section3 padding_2x">
            <div class="container">
                <div class="title_header">
                    <em>OUR RECENT WORKS</em>
                    <h1 class="title medium">Quality Service</h1>
                </div>
                <div class="flex">
                    <section class="flex-content padding_1x">
                        <figure>
                            <img src="assets/images/01.jpg" alt="">
                            <article>
                                <span class="padding_1x">
                                    <h2 class="cursive">Commercial</h2>
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                </span>
                            </article>
                        </figure>
                    </section>
                    <section class="flex-content padding_1x">
                        <figure>
                            <img src="assets/images/02.jpg" alt="">
                            <article>
                                <span class="padding_1x">
                                    <h2 class="cursive">Hotels</h2>
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                </span>
                            </article>
                        </figure>
                    </section>
                    <section class="flex-content padding_1x">
                        <figure>
                            <img src="assets/images/03.jpg" alt="">
                            <article>
                                <span class="padding_1x">
                                    <h2 class="cursive">Hotels</h2>
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                </span>
                            </article>
                        </figure>
                    </section>
                    <section class="flex-content padding_1x">
                        <figure>
                            <img src="assets/images/04.jpg" alt="">
                            <article>
                                <span class="padding_1x">
                                    <h2 class="cursive">Hotels</h2>
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                </span>
                            </article>
                        </figure>
                    </section>
                </div>
            </div>
        </div>
        
        <!--SECTION5-->
        <div class="section5 flex">
            <section class="flex-content padding_2x">
                <div class="container">
                    <h1 class="title small">Stay connected with us</h1>
                    <p>Have any questions? please feel free to contact us. We are always happy to hear from you.</p>
                    <div class="success hide"><span></span></div>
                    <form id="contact-form" class="padding_1x" method="POST" action="bootstrap.php">
                        <input type="hidden" name="csrf_token_contact" id="csrf_token_contact" value="<?php echo $csrf_token->generateCsrfToken(); ?>">
                        <div class="flex">
                            <div class="flex-grow">
                                <fieldset>
                                    <label for="fullname" class="hide">full name</label>
                                    <input type="text" name="fullname" id="fullname" maxlength="60" placeholder="Your full name"/>
                                    <div class="error hide"><span></span></div>
                                </fieldset>
                                <fieldset>
                                    <label for="contactno" id="contactno" class="hide">Contact number</label>
                                    <input type="tel" name="contactno" maxlength="15" placeholder="Contact number"/>
                                    <div class="error hide"><span></span></div>
                                </fieldset>
                            </div>
                            <div class="flex-grow">
                                <fieldset>
                                    <label for="email" id="email" class="hide">Email</label>
                                    <input type="email" name="email" maxlength="255" placeholder="Email"/>
                                    <div class="error hide"><span></span></div>
                                </fieldset>
                                <fieldset>
                                    <label for="country" class="hide">Country</label>
                                    <select name="country" id="country">
                                        <option value="">Country</option>
                                        <option value="Australia">Australia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <div class="error hide"><span></span></div>
                                </fieldset>
                            </div>
                            <div class="flex-grow">
                                <fieldset>
                                    <label for="message" class="hide">Message</label>
                                    <textarea name="message" id="message" placeholder="message"></textarea>
                                    <div class="error hide"><span></span></div>
                                </fieldset>
                            </div>
                        </div>
                        <fieldset>
                            <button id="form_btn" class="btn1">Contact us</button>
                        </fieldset>
                    </form>
                </div>
            </section>
        </div>
        
        <!--FOOTER-->
        <footer>
            <div class="container">
                <section class="flex-content padding_2x">
                    <a href="#"><img class="logo" src="assets/images/Done and Dusted Logo.png" alt="Site logo"></a>
                </section>
                <section class="flex-content padding_2x">
                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <span class="social_icons">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                    </span>
                </section>
                <section class="flex-content padding_2x">
                    <h3 class="title small">Opening hours</h3>
                    <p>Monday ~ Saturday, 8am-6pm || Sunday, 10am-1pm</p>
                </section>
                <section class="flex-content padding_2x">
                    <h3 class="title small">Other Links</h3>
                    <a href="#">Terms & conditions</a>
                    <a href="#">Privacy policy</a>
                    <a href="#">Cookie policy</a>
                    <a href="#">Raise a ticket</a>
                </section>
                <section class="flex-content padding_2x">
                    <h3 class="title small">Newsletter</h3>
                    <p>Subscribe our newsletter to get our latest update & news</p>
                    <fieldset class="flex">
                        <input type="email" name="email" placeholder="Email address" class="flex-content" required="" />
                        <button class="btn1 flex-content"><i class="fa fa-paper-plane"></i></button>
                    </fieldset>
                </section>
            </div>
        </footer>
        <div class="sub_footer">
            <div class="container">
                <p> 2024 © All rights reserved by Done and Dusted</p>
            </div>
        </div>
        
        <!-- JAVASCRIPT -->
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>  