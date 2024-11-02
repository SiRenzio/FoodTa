<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="css/home_page.css">
    <title>Koppiii</title>
</head>
<body>
    <div id="container">
        <section class="home" id="home">
            <image class="ktHomeLogo" src="images/deliveryLogo.png"></image>
            <div class="brandname">
                <h1 class="mainTitle">FOOD TA!</h1>
                <h3 class="subTitle">Delivery</h3>
                </div>
            
        <?php
            // CLA
            // if logged in = show log-in section.
            // if not = don't show. 
            $loggedIn = true;
            if ($loggedIn == false){
                echo "<section id = LogIn>";
                    echo "Hello";
                echo "</section>";
            }
        ?>
    </div>
    </section>
        
    <section class="sec_about" id="sec_about">
        <image class="ftSecLogo" src="images/foodTaSectionLogo(Green).png"></image>
        <div class="about_content">
            <div class="leftSide">
                <h1 class="about_title">Know About FOOD TA!</h1>
                <p class="about_description">Welcome to Food Ta! Delivery – where flavor meets convenience, one delicious moment at a time. We bring the
                     warmth and satisfaction of your favorite meals straight to your door, combining a passion for quality food with the ease of reliable
                      delivery. From the rich aroma of our expertly brewed coffee to hand-tossed pizzas, buttery pastries, and savory pastas, each dish
                       is crafted to make every bite memorable and accessible wherever you are.<br><br>
                    
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;At Food Ta!, we believe in delivering more than just a meal; we deliver experiences that bring comfort,
                     joy, and a taste of home. Food Ta! Delivery is your cozy, convenient escape from the bustle, offering you the perfect way to unwind
                      and savor life’s simple pleasures without leaving your space. Whether you’re ordering a coffee to kickstart your day, sharing a pizza
                       with friends, or indulging in a pastry for a sweet moment, we’re here to make each meal special and meaningful. Every dish and drink
                        reflects our commitment to quality and care, bringing flavors that feel familiar yet excitingly new.<br><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;So, sit back, relax, and let us bring the flavors that satisfy right to your door. 
                    With Food Ta! Delivery, every order is a delicious moment delivered, making every meal feel like catching up with
                     an old friend. You’re not just a customer – you’re part of our Food Ta! family, and we look forward to delivering many
                      flavorful memories, one meal at a time.
                </p>
            </div> 
            <div class="rightSide">
                <image class="leftImg" src="images/pngegg.png"></image>
            </div>
        </div>
    </section>

    <section class="services" id="service">
        <image class="serviceSecLogo" src="images/foodTaSectionLogo(White).png"></image>
        <h1 class="serTitle">TOP QUALITY SERVICE.</h1>

        <div class="componentContent">
            <div class="delivery component">
                <h3>Fast Delivery</h3>
                <image class="icons" src="images/delivery.png"></image>
                <p>Bringing the Food Ta! experience to your doorstep! Whether you’re at home or the office,
                     our delivery service ensures that each order arrives hot, fresh, and ready to enjoy,
                      making quality dining effortless.</p>
            </div>

            <div class="order component">
                <h3>Easy Food Ordering</h3>
                <image class="icons" src="images/order.png"></image>
                <p>We make it easy to satisfy your cravings with our quick and simple ordering options,
                     whether online or in-store. Enjoy a smooth ordering process and get exactly what you want,
                      just the way you like it.</p>
            </div>

            <div class="freshness component">
                <h3>Guarantee Freshness</h3>
                <image class="icons" src="images/freshness.png"></image>
                <p>We take pride in crafting every dish with the finest, freshest ingredients available.
                     Each meal is prepared to order with care and attention to quality, ensuring that freshness
                     and flavor are guaranteed with every bite.</p>
            </div>

        </div>
    </section>

</body>
</html>
