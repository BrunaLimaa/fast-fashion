<?php  $this->layout("_theme1",["categories" => $categories]); ?>

<div class="small-container">

    <div class="row">
    <?php
    if(!empty($carts)){
        $total = 0;
    foreach($carts as $product){
        $total = $product->price + $total;
        
    ?>
        <div class="col-4">
            <img src="<?= $product->photo; ?>">
            <h4><?= $product->name; ?></h4>
            <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            </div>
            <p>R$ <?= $product->price; ?></p>
            <button ><a href="<?= url("app/delete/{$product->idCart}"); ?>">X</a></button>
        </div>
    
        <?php }} else {?>
    <div>
        <img src="<?= url("assets/app/images/emptycart.png"); ?>">
        <h1>O seu carrinho está vazio!</h1>
        <button ><a  href="<?= url("app/produtos"); ?>" >Ir às compras</a></button>

    </div>
</div>

<?php }  ?>
</div>


    <?php if(!empty($carts)){?>
        <div class="total-box">
            <div class="total">
                <h1>TOTAL: </h1>
                <h2> R$ <?= $total ?></h2>
            </div>
        <div class="nota-fiscal">
            <button>
                <a href="<?= url("app/notafiscal"); ?>">Gerar nota fiscal</a>
            </button>
        </div>
        </div>


<?php } ?>
