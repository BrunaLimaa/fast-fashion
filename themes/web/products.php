<?php
$this->layout("_theme2",["categories" => $categories]);
?>

<div class="small-container">

    <div class="row2">
        <h2 class="title">Produtos</h2>
        <select>
            <option>Menor preço</option>
            <option>Maior preço</option>
            <option>Populares</option>
            <option>Avaliação</option>
        </select>
    </div>

    <div class="row">
    <?php
    
    foreach($products as $product){
        
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
        </div>
    
        <?php
    }
    ?>

    </div>

</div>


