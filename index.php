<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reajuste</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="programa">
    <?php 
        $preco = $_GET["preco"] ?? 0;
        $porcent = $_GET["porcent"] ?? 0;
    ?>
    <main>
        <h1>Reajustador de Preços</h1>
        <form action="<?= $_SERVER["PHP_SELF"]?>" method="get">
            <label for="preco">Preço do Produto (R$)</label>
            <input type="number" name="preco" id="idpreco" min="0.10" step="0.01" value="<?= $preco?>">
            
            
                
            <label for="porcent">Percentual do reajuste (<strong><span id="p">?</span>%</strong>)</label>

            <div class="box">
                <div class="slider">
                    
            <input type="range" min="1" max="100" step="1" name="porcent" id="idporcent" oninput="mudaValor()" value="<?=$porcent?>">
                </div>
            </div>
            
            <input type="submit" value="Reajustar">
        </form>
    </main>

    <?php
    function calcularReajuste($preco, $porcent) {
        $aumento = ($porcent / 100) * $preco;
        return [
            'precoAtual' => $preco,
            'aumento' => $aumento,
            'precoReajustado' => $preco + $aumento
        ];
    }

    $resultadoReajuste = null;

    if (isset($_GET["preco"]) && isset($_GET["porcent"])) {
        $resultadoReajuste = calcularReajuste($preco, $porcent);
    }
    ?>

    <section id="resultado">
    <?php if ($resultadoReajuste): ?>
            
            <h2>Resultado do Reajuste</h2>

            <ul>
                <li><?= "<strong>Preço Atual:</strong> <em>R\$ " . number_format($resultadoReajuste['precoAtual'], 2, ",", ".") . "</em>" ?></li>

                <li><?= "<strong>Aumento de {$porcent}%:</strong> <em>R\$ " . number_format($resultadoReajuste['aumento'], 2, ",", ".") . "</em>" ?></li>

                <li><?= "<strong>Preço Reajustado:</strong> <em>R\$ " . number_format($resultadoReajuste['precoReajustado'], 2, ",", ".") . "</em>" ?></li>
            </ul>


        <?php endif; ?>
    </section>
    <script>
        mudaValor()

        function mudaValor(){
            p.innerText = idporcent.value
        }
    </script>
</body>
</html>