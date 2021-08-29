<?php
    /*
        Author  : Yunus Can
        Website : www.yunuscan.xyz
        Mail    : info@yunuscan.xyz
        Date    : 29/08/2021
    */

    include "tokens.php";
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<title>Pancakeswap Token Api</title>
	<meta charset="UTF-8">
	<meta name="description" CONTENT="Pancakeswap token api">
	<meta name="keywords" CONTENT="pancakeswap,token,api">
	<meta name="robots" CONTENT="index,follow">

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/tipy.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/index.css" />

    <!-- JS -->
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.responsivegrid.js"></script>
	<script type="text/javascript" src="js/tipy.js"></script>
	<script type="text/javascript" src="js/index.js"></script>

</head>
<body>
    &nbsp;

    <section>
        <h1>
            PANCAKESWAP TOKEN API
            <span class="loading">
                <i class="fa fa-spinner" aria-hidden="true"></i>
            </span>
        </h1>

        <div class="grid">
            <?php $i=0; foreach ($tokens as $token): ?>
                <?php
                    $colspan = 1;
                    $rowspan = 1;
                    $background = "bg-green";

                    if($i == 0){ $colspan = 3; $rowspan = 3; }else if($i == 1 || $i == 2){ $colspan = 2; $rowspan = 1;}

                    if((double)$token["buy_price"] > $token["price"])
                        $background = "bg-red";

                    if($token["buy_price"] == 0)
                        $background = "bg-gray";
                ?>
                <div class="grid-item <?php echo $background; ?>" data-colspan="<?php echo $colspan; ?>" data-rowspan="<?php echo $rowspan; ?>" data-id="<?php echo $token["token"] ?>">
                    <div class="center-text">
                        <div>
                            <span class="coin-name"> <?php echo $token["symbol"] ?> </span>
                            <span class="coin-price">$<?php echo $token["price"] ?></span>
                            <span class="coin-count">Count : <?php echo $token["count"] ?></span>
                            <span class="coin-total-price">Total : $<?php echo  $token["total_price"] ?></span>
                        </div>
                    </div>

                    <div class="info-button" data-tipy="
                        <div class='tooltip-name'>Lead Token on BSC</div>
                        <div class='tooltip-item'><b>Buy Price</b> : $<?php echo $token["buy_price"] ?></div>
                        <div class='tooltip-item'><b>Last Update</b> : <?php echo $token["updated_at"] ?></div>
                        <div class='tooltip-item'><b>Token</b> : <?php echo $token["token"] ?></div> " data-tipy-pos="b">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </div>
                </div>
            <?php $i++; endforeach; ?>
        </div>
    </section>

</body>
</html>