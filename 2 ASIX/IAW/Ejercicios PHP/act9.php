<html>
    <head>
        <body>
            <h1>act9</h1>
            <?php
                function cuenta($a, $b){
                    while ($a <= $b) {
                        echo "$a ";
                        $a = $a + 1;
                    }
                }
                echo cuenta(1,100);
            ?>
        </body>
    </head>
</html>