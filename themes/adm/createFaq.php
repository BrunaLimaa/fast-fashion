<?php  $this->layout("theme1",["categories" => $categories]); ?>

<div class="container">
    <form enctype="multipart/form-data" method="post" id="faq-register" class="">
        <h1>INSERIR FAQ</h1>
        <div class="mb-3">
        <label for="label" class="form-label">Pergunta: </label>
            <input type="text" name="question" class="form-control" placeholder="">
        </div>
        <div class="mb-3">
            <label for="label" class="form-label">Resposta: </label>
            <input type="text" name="answer" class="form-control" placeholder="">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="send">SALVAR</button>
        </div>
        <div class="alert alert-primary" role="alert" id="message" style="display: none;">
            Mensagem de Retorno! 
        </div>
    </form>
</div>

<script type="text/javascript" async>
    const form = document.querySelector("#faq-register");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataFAQ = new FormData(form);
        const data = await fetch("<?= url("adm/criarFaq") ?>",{
            method : "POST",
            body : dataFAQ
        });
        const faq = await data.json();
        console.log(faq);
        if(faq.type){
            message.setAttribute("style","display");
            message.textContent = faq.message;
        }
    })
</script>