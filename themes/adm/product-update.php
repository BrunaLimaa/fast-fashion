<?php $this->layout("theme1",["categories" => $categories]); ?>


<div class="small-container">

<div class="container">
    <form enctype="multipart/form-data" method="post" id="formProduct" class="">
        <h1>ALTERAR PRODUTO</h1>
        <div class="mb-3">
            <label for="id" class="form-label">ID: </label>
            <input type="text" name="id" class="form-control" id="id" value="ID do produto" placeholder="Nome do produto...">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nome: </label>
            <input type="text" name="name" class="form-control" id="name" value="" placeholder="Nome do produto...">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Preço: </label>
            <input type="price" name="price" class="form-control" id="price" value="" placeholder="R$ 0,00">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Categoria: </label>
            <select type="category" name="idCategory" class="form-control" id="idCategory" placeholder="Ex: Feminino">
                <option value="1">Masculino</option>
                <option value="2">Feminino</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Foto do produto: </label>
            <input class="form-control" type="file" name="photo" id="photo">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="send">Alterar</button>
        </div>
        <div class="alert alert-primary" role="alert" id="message" style="display: none;">
            Mensagem de Retorno! 
        </div>
      
    </form>
</div>

    <div class="row">
    <?php
    
    foreach($products as $product){
        
    ?>
        <div class="col-4">
        <?php
            if($product->type === "Normal" && $product->type != "NULL"):
                ?>
                <img class="picture" src="<?= $product->photo; ?>" class="img-thumbnail" id="photoShow" alt="...">
                <?php
            else:
            ?>
                <img src="<?= url($product->photo); ?>" class="img-thumbnail" id="photoShow" alt="...">
            <?php
            endif;
            ?>
            <h3>ID: <?= $product->id; ?></h3>
            <h4><?= $product->name; ?></h4>
            <p>R$ <?= $product->price; ?></p>

            
        </div>
    
        <?php
    }
    ?>

    </div>

</div>
<script type="text/javascript" async>
    const form = document.querySelector("#formProduct");
    const message = document.querySelector("#message");
    const photoShow = document.querySelector("#photoShow");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataProduct = new FormData(form);
        const data = await fetch("<?= url("adm/updateProduto"); ?>",{
            method: "POST",
            body: dataProduct,
        });
        const product = await data.text();
        console.log(product);
        if(product) {
            if(product.type === "alert-success") {
                photoShow.setAttribute("src",product.image);
            }
            message.textContent = product.message;
            message.classList.remove("alert-primary", "alert-danger");
            message.classList.add(`${product.type}`);
        }
    });
</script>