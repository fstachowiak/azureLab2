<!DOCTYPE html>
<!--First html page-->
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="multiplication table, number, range">
    <meta name="description" content ="The file conains multiplication table based on the user input">
<style>
        body {
            background-color: #7fb685;
        }
        h1 {
            font-family:'Courier New', Courier, monospace;
            color: #ef6f6c;
            font-size:3em;
            font-weight: 600;
            margin-left: 5px;
            text-align:left;
        }
        h3 {
            font-family:'Courier New', Courier, monospace;
            color: #426a5a;
            font-size:2em;
            font-weight: 600;
            margin-left: 5px;
            text-align:left;
        }
        h4 {
            font-family:'Courier New', Courier, monospace;
            color: #ef6f6c;
            font-size:1em;
            font-weight: 600;
            margin-left: 5px;
            text-align:left;
        }
        p {
            font-family:'Courier New', Courier, monospace;
            color: #426a5a;
            font-size:1.5em;
            font-weight: 600;
            margin-left: 5px;
            text-align:left;

        }
        footer {
            font-family:'Courier New', Courier, monospace;
            color: #426a5a;
            font-size: 100%;
            font-weight:500;
            text-align: left;
         }
         table,
        th,
        td {
          padding: 10px;
          border: 5px dotted #ef6f6c;
          border-collapse: collapse;
          font-family:'Courier New', Courier, monospace;
          font-size: 100%;
          color:#426a5a;
        }
        .firstcolumn {
            font-weight: bold;
        }
        .even {
            background-color: #dd9787;
            color:#426a5a;
        }
        .odd {
            background-color: #ddae7e;
            color:#426a5a;
        }
      </style>
<body>
<h1> Multiplication table</h1>
<h3>Task 1</h3>
<p>Create a website where, using PHP, a multiplication table will be created for n random 
elements in the range of 1-99. The number n ( number of rows and columns) with the results 
of multiplication should be given by the user in a URL query string, e.a.
/mult_table.php?n=13. The value of n is to be of the range (5 < = n <=20). If the user provides 
anything else, some default value from this range is to be assumed, but the page is to indicate
that the given data was incorrect, so n=X was assumed. The values drawn are to be included 
in the column and row headings. Even results (multiplications) in array cells should be with the 
class "even" and odd ones with the class "odd". In the CSS file, style the array looks 
aesthetically pleasing and visually distinguishes the parity of the results.</p>

<?php
$n = $_GET["n"]; 
$isDigitsOnly = ctype_digit($n);
if ($isDigitsOnly) {
    $n = intval($n);
} else {
    $n = 8;
    echo '<script>alert("Given value is not an integer, the default value n=8 was taken")</script>';
}
if ($n < 5 || $n > 20) {
    echo '<script>alert("Given value is out of range, the default value n=8 was taken")</script>';
    $n = 8;
}
$numbers = array();
$toAdd = 0;
for ($i = 0; $i < $n; $i++) { //generate random numbers
    $toAdd = rand(1, 99);
    array_push($numbers, $toAdd);
}

echo "<table>";
    echo "<thead>";
        echo "<tr>";

        for ($i=0; $i <= $n ; $i++) { 
            if ($i !=0) {
                echo "<th>{$numbers[$i-1]}</th>";
            } else {
                echo "<th></th>";
            }  
        }
        
        echo "</tr>";
    echo "</thead>";

    for ($i=1; $i <= $n ; $i++) { 
        echo "<tr>";
        echo "<td class=\"firstcolumn";
        echo "\">".$numbers[$i-1]."</td>";
        
        for ($j=1; $j <= $n; $j++) {
            $result = $numbers[$i-1] * $numbers[$j-1];
            if ($result % 2 == 0) {
                echo "<td class=\"even";
                echo "\">".$result."</td>";
            } else {
                echo "<td class=\"odd";
                echo "\">".$result."</td>";
            }
        }
    }
    echo "<tr>";
?>

</body>
</html
