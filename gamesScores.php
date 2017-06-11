<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="tableScores.css" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
    <script type="text/javascript" src="js/search.js">
    </script>
    <meta charset="UTF-8">
    <title>
        Score table
    </title>
</head>

<body>
    <div id="top-logo">
    </div>
    <div id="background">
    </div>

    <div id="bar">
        <div id="name"> Guess the VIP </div>
        <div id="menu">
            <a class="menu-button" href="loginHome.php">Home</a>
            <a class="menu-button" href="playGame.php">Play</a>
            <a class="menu-button page-active" href="gamesScores.php">Games Scores</a>

        </div>
    </div>
    <div id="main">

        <div class="content">
            <p id="introducere">Here you can view all the scores of the players of the game "Guess the VIP" and the number of games that they played until today.</p>
        </div>

        <div class="content content-box">
            <p id="title-classification"><b> Score table:</b></p>

            <input id="search-box" type="text" name="search-smth" value="">


            <table id="score-table">
                <tr>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Games played</th>
                </tr>
                <tr>
                    <td>Peter Griffin</td>
                    <td>100</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>Lois Griffin</td>
                    <td>150</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>Joe Swanson</td>
                    <td>300</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>Cleveland Brown</td>
                    <td>250</td>
                    <td>4</td>
                </tr>
            </table>

        </div>
    </div>


    <div id="footer">
        <br>
        <div id="right"> Copyright&copy; 2017. <b> Guess the VIP. </b> All rights reserved. </div>
    </div>


</body>

</html>