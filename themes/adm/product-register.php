<?php $this->layout("theme1",["categories" => $categories]); ?>
<div class="container">
    <form enctype="multipart/form-data" method="post" id="formProduct" class="">
        <h1>REGISTRAR PRODUTO</h1>
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
            <label for="photo" class="form-label">Foto: </label>
            <input class="form-control" type="file" name="photo" id="photoShow">
        </div>
        <div class="mb-3">
          
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="send">Alterar</button>
        </div>
        <div class="alert alert-primary" style="display: none" role="alert" id="message">
           <!-- Mensagem de Retorno! --> 
        </div>
    </form>
</div>
<script type="text/javascript" async>
    const form = document.querySelector("#formProduct");
    const message = document.querySelector("#message");
    const photoShow = document.querySelector("#photoShow");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataProduct = new FormData(form);
        const data = await fetch("<?= url("adm/addProduto"); ?>",{
            method: "POST",
            body: dataProduct,
        });
        const product = await data.json();
        console.log(product);
        if(product) {
            if(product.type === "alert-success") {
                photoShow.setAttribute("src",product.image);
            }
            message.setAttribute("style","display");
            message.textContent = product.message;
            message.classList.remove("alert-primary", "alert-danger");
            message.classList.add(`${product.type}`);
            setTimeout(() => {
                message.setAttribute("style","display: none")
            },3000);
        }
    });
</script>
