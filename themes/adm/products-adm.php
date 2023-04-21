<?php $this->layout("theme1",["categories" => $categories]); ?>

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
        <?php
            if($product->name !== "moletom" && $product->name !=="tenis"):
                ?>
                <img class="picture" src="<?= $product->photo ?>" class="img-thumbnail" id="photoShow" alt="...">
                <?php
            else:
            ?>
                <img src="<?= url($product->photo); ?>" class="img-thumbnail" id="photoShow" alt="...">
            <?php
            endif;
            ?>
            <h4><?= $product->name; ?></h4>
            <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            </div>
            <p>R$ <?= $product->price; ?></p>
            <button class="add-cart" onclick=""><img src="https://cdn-icons-png.flaticon.com/512/2169/2169842.png" width="30px" height="30px"></button>
        </div>
    
        <?php
    }
    ?>

    </div>

</div>


