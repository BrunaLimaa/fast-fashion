<?php  $this->layout("_theme1",["categories" => $categories]); ?>

<div style="height:600px;">
    <?php
    if(!empty($contacts)){
    foreach($contacts as $contact){
    ?>
        <div class="small-container">
            <div class="col-4">
            <p src="<?= $contact->name; ?>">
            <h4><?= $contact->email; ?></h4>
            <p> <?= $contact->message; ?></p>
            </div>
        </div>
    
        <?php
    }
} else {
    ?> 
    <div><h1>USUÁRIO NÃO POSSUI MENSAGENS</h1></div>
    <?php
}
?>

    </div>