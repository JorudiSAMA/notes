<html>
    <head>
        <body>
            <h1>act11</h1>
            <?php
                function calculaDescuento($precio, $descuento=0){
                    $descuento_final = ($precio * ($descuento/100));
                    $resultado = $precio - $descuento_final;
                    return $resultado;
                }

                echo calculaDescuento(250,10);
                echo "             ";
                echo calculaDescuento(85);
            ?>
        </body>
    </head>
</html>