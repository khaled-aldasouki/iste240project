<?php

session_start();
?><!DOCTYPE html>

<html>
    <head>
        <title>Create a Survey</title>
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
                <h1>Create a survey</h1>
            </div>
            <div id="formdiv">
            <form id="newform" onsubmit="return validateNewForm();">
                <label class='question' for="survey-name">Survey Name:</label>
                <br>
                <input type="text" id="survey-name" maxlength="30" name="survey-name" placeholder='Enter the survey name...' required></input>
                <label class='question' for="q1">Question 1:</label>
                <br>
                <textarea id="q1" name="q1" placeholder='Enter the question here...' required></textarea>
                <br>
                <label for="q1type">Question 1 type:</label>
                <br>
                <select required name="q1type" id="q1type" onchange="changetype(1);" >
                    <option value="none" selected disabled hidden>Select an Option</option>
                    <option value="textarea">Text Box</option>
                    <option value="truefalse">True/False</option>
                    <option value="mc">Multiple Choice</option>
                </select>
                <br>
                <div id="options1">
                </div>
            </form>
            <div id="button-div">
                <button class="button" onclick="addquestion();">Add question</button>
                <button class="button" type="submit" form="newform">Submit</button>
            </div>
        </div>
 
        </main>

        <footer>
            <p> Copyright &copy; 2023 Survey Masters All rights reservered</p>
        </footer>

    </body>
</html>