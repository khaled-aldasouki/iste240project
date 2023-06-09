<?php

session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Homepage</title>
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link href="assets/css/style.css" rel="stylesheet">
        <script src="assets/js/script.js"></script>
        <meta charset="utf-8" />
        <link rel="icon" href="assets/media/icon.png" />
    </head>

    <body>
        
                <?php include 'nav.php'?>

       

        <main>
            <div class="heading">
                <h1>Survey Masters</h1>
            </div>
            <div class="main_grid">
                

                <div class="main_p">
                    <p class="p_div">
                        The #1 website for survey creation, Using our simple platform,
                        you can quickly create customized surveys. Get insightful comments from the targeted user base and 
                        gather data to advance your company with the help of our effective survey creation tool, 
                        you can attract participants and collect suggestions. 
                        Start now and learn fresh approaches to connecting with your clients
                    </p>
                </div>

                <div class="main_img">
                    <img class="survey_img" src="assets/media/index_img1.jpeg" alt="Survey image">
                </div>

            </div>

            <h1 class="heading">Reviews</h1>
            <div class="reviews">
                <div class="review_div1">
                    <img class="person_img" src="assets/media/person.png" alt="Person no.1 image">
                </div>

                <div class="review_div2">
                    <p class="person_review">This website is great, would recommend to all my friends!</p>
                </div>

                <div class="review_div3">
                    <img class="person_img" src="assets/media/person.png" alt="Person no.2 image">
                </div>

                <div class="review_div4">
                    <p class="person_review">Easiest way to create surveys for my research, got an A in my paper!</p>
                </div>

                <div class="review_div5">
                    <img class="person_img" src="assets/media/person.png" alt="Person no.3 image">
                </div>

                <div class="review_div6">
                    <p class="person_review">Helped me establish my targets with the survey I created, it only took minutes!</p>
                </div>

            </div>
        </main>

        <footer>
            <p> Copyright &copy; 2023 Survey Masters All rights reservered</p>
        </footer>

    </body>
</html>