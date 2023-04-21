<?php $this->layout("_theme"); ?>

<div>
    <h2>Fale Conosco</h2>
    <p>Lorem ipson</p>
    <form action="<?= url("contato"); ?>" method="post" class="contato" id="contact">
        <div>
          Nome <input type="text" name="name" placeholder="Seu nome..."/>
        </div>
        <div>
          Email <input type="text" name="email" placeholder="Seu email..."/>
        </div>
        <div>
          <textarea name="message" rows="3" placeholder="Sua mensagem..."></textarea>
        </div>
        <button id="Send">Enviar</button>

        <div id="message">

        </div>
    </form>
</div>


<script type="text/javascript" async>
                            const form = document.querySelector("#contact");
                            const message = document.querySelector("#message");
                            form.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataContact = new FormData(form);
                                const data = await fetch("<?= url("contato"); ?>",{
                                    method: "POST",
                                    body: dataContact,
                                });
                                const contact = await data.json();
                                console.log(contact);
                                if(contact) {
                                    //message.innerHTML = contact.message;
                                    //message.classList.add("message");
                                    //message.classList.remove("success", "warning", "error");
                                    //message.classList.add(`${user.type}`);
                                }
                            });

    const buttonReset = document.createElement("button");
    buttonReset.type = "reset";
    buttonReset.innerHTML = "Limpar";

    const buttonSend = document.querySelector("#Send");
    buttonSend.insertAdjacentElement('afterend',buttonReset);
</script>