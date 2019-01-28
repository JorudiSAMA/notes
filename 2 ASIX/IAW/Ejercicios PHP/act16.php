<html>
    <head>
        <body>
            <h1>act16 - Jordi Cases</h1>
            
            <?php
                for ($i=0; $i <=3; $i++) {
                    ?>
                    <span style="font-size: 20px; border: 1px solid black; background-color: yellow;">
                    <?php echo "Tabla del $i"; ?>
                    </span>
            <br>
                <?php 
                    for ($y=0; $y <=3 ; $y++) {
                        $res = $i * $y;
                        $tabla[$i][$y] = $res;
                        echo "$i * $y = $res";
                ?>
                <br>

            <!-- Fin de resultado -->
            <?php
                }
            ?>
            <br>

            <!-- Fin de tabla -->
            <?php   
                }
            ?>
            <br>
        </body>
    </head>
</html>