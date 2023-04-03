<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<style>
        body {
            background-color: #7fb685;
            font-family:'Courier New', Courier, monospace;
            color: #426a5a;
            font-weight: 600;
            margin-left: 5px;
            text-align:left;
           
        }
        
        input[type=text] {
            background-color: #7fb685;
            color:#ef6f6c;
            border: 3px solid #426a5a;
        }
        input[type=button], input[type=submit], input[type=reset] {
            background-color: #ef6f6c;
            border: 3px solid #426a5a;
            color: #426a5a;
            padding: 16px 32px;
            cursor: pointer;
}
        </style>
        
<head>
    <title>Guessing Game</title>
</head>
<body>
    <h1>Guessing Game</h1>
    <?php
        
        if (isset($_POST['nValue'])) {
            $n = $_POST['nValue'];
            $isDigitsOnly = ctype_digit($n);
            if ($isDigitsOnly) {
                $n = intval($n);
            } else {
                $n = 5;
                echo '<script>alert("Given value is not an integer, the default value n=5 was taken")</script>';
            }
            if ($n < 0) {
                echo '<script>alert("Given value is out of range, the default value n=5 was taken")</script>';
                $n = 5;
            }
            $_SESSION['nValue'] = $n;
            setcookie('nValue', $n, time()+5*60, "/"); 
            $_SESSION['number'] = mt_rand(0, $_SESSION['nValue'] - 1);
            setcookie('randomNumber', $_SESSION['number'], time()+5*60, "/");
            $_SESSION['counter'] = 0;
            $_SESSION['history'] = array();
        }

        echo "<h1>Welcome to the guessing game! The objective of the game is to guess the number. You have to choose the range and try to guess the selected number. Each time you guess the number, the counter will be reset and a new number will be drawn!</h1>";

        // set n value form
        echo "<form method='post' action=''>
          <h3>Set the range for the guessing game: <input type='text' name='nValue' /></h3>
          <input type='submit' value='Set' />
        </form>";

        // guess the number form
        if (isset($_SESSION['nValue'])) {
            echo "<h4>Type the value in the range [0,  " . $_SESSION['nValue'] . ")</h4>";
            echo "<form method='post' action=''>
                <h3>Guess the number: <input type='text' name='guess' /></h3>
                <input type='submit' value='Guess' />
            </form>";
        }
        

        // check if guess is correct
        $numbers = array();
        if (isset($_POST['guess'])) {
            $_SESSION['counter']++;
            array_push($_SESSION['history'], $_POST['guess']);
            if ($_SESSION['number'] == $_POST['guess']) {
                echo "<h4>You guessed correctly! The number was " . $_SESSION['number'] . ".</h4>";
                echo "<h4>It took you " . $_SESSION['counter'] . " attempts to guess the correct number.</h4>";
                echo "<h4>The numbers you were guessing " ;
                print_r($_SESSION['history']);
                echo "</h4>";
                setcookie('counterVal', $_SESSION['counter'], time()+5*60, "/");
                $_SESSION['counter'] = 0;
                $_SESSION['number'] = mt_rand(0, $_SESSION['nValue'] - 1);
                $_SESSION['history'] = array();
            } else if ($_POST['guess'] > $_SESSION['number']) {
                echo "<h4>Your guess was too large. Please try again.</h4>";
            } else if ($_POST['guess'] < $_SESSION['number']) {
                echo "<h4>Your guess was too small. Please try again.</h4>";
            }
        }
    ?>
    <?php
	
	$validityPeriod = 5*60; 
    
    
	$backgroundColor = "#7fb685";
    $fontColor = "#426a5a" ;
	$fontSize = 15;
	$player;

    if (isset($_COOKIE["background_color"])) {
        $backgroundColor = $_COOKIE["background_color"];
        $fontColor = $_COOKIE["font_color"];
        $fontSize = $_COOKIE["font_size"];
        print($backgroundColor);
    
    }
	
	// If form is submitted, set new cookie values
	if (isset($_POST['submit'])){
		$backgroundColor = $_POST['background_color']; 
		setcookie('background_color', $backgroundColor, time()+$validityPeriod, "/"); 

        $fontColor = $_POST['font_color']; 
		setcookie('font_color', $fontColor, time()+$validityPeriod, "/"); 
		
		$fontSize = $_POST['font_size']; 
		setcookie('font_size', $fontSize, time()+$validityPeriod, "/"); 

        $player = $_POST['player'];
        setcookie('name_of_player', $player, time()+$validityPeriod, "/");
	} 

    echo "<body style='background-color:".$backgroundColor ."; color:". $fontColor ."; font-size:". $fontSize ."px;'>";
    
?>
<form action="" method="post">
	<label for="background_color"> Background Color: </label>
	<input type="color" name="background_color"><br>

    <label for="font_color"> Font Color: </label>
	<input type="color" name="font_color"><br>
	
	<label for="font_size"> Font Size: </label>
	<input type="range" min="5" max="30" name="font_size" value="<?php echo $fontSize; ?>"><br>
	
	<label for="player"> Player: </label>
	<input type="text" name="player"><br><br>
	
	<input type="submit" name="submit" value="Save">
</form>
</body>
</html>
