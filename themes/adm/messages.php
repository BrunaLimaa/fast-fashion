<?php 
$this->layout("theme1",["categories" => $categories]); 
?>

<div class="small-container">

    <?php
    
    foreach($contacts as $contact){
        
    ?>
        <div class="col-4">
            <img src="<?= $contact->email; ?>">
            <h4><?= $contact->name; ?></h4>
            <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            </div>
            <p>R$ <?= $contact->message; ?></p>
            <button class="add-cart" onclick=""><img src="https://cdn-icons-png.flaticon.com/512/2169/2169842.png" width="30px" height="30px"></button>
        </div>
    
        <?php
    }
    ?>

    </div>

</div>