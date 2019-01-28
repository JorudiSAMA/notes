<html>
    <head>
        <body>
            <h1>act10</h1>
            <?php
                function intercambia(&$a, &$b){
                    $temp = $a;
                    $a = $b;
                    $b = $temp;
                }
            
            $num1 = 3;
            echo "Num 1: $num1 ";        
            $num2 = 4;
            echo "Num 2: $num2 ";   
            intercambia($num1,$num2);
            echo "Intercambio...     ";
            echo "Num 1: $num1 ";
            echo "Num 2: $num2 ";
            ?>
        </body>
    </head>
</html>