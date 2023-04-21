<?php
$this->layout("_theme1",["categories" => $categories]);
?>
<!--=========================
=            FAQ            =
==========================-->


<div class="faq_area section_padding_130" id="faq">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-lg-6">
                <!-- Section Heading-->
                <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <h3><span class="row justify-content-center">Frequently Asked Questions </span></h3>
                    <p>Aqui você vai encontrar peguntas frequentes de outros usuários!</p>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="row1">
            <!-- FAQ Area-->

						<?php
                          foreach ($faqs as $faq){
                        ?>
            <div class="col-12 col-sm-10 col-lg-8">
                <div class="accordion faq-accordian" id="faqAccordion">
                    <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="card-header" id="headingOne">
                            <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?= $faq->question; ?><span class="lni-chevron-up"></span></h6>
                        </div>
                        <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#faqAccordion">
                            <div class="card-body">
                                <p class="row3"><?= $faq->answer; ?></p>
                            </div>
                        </div>
                    </div>
										<?php } ?>
                <!-- Support Button-->
                <div class="support-button" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                    <i class="lni-emoji-sad"></i>
                    <p class="mb-0 px-2">Não encontrou sua dúvida?</p>
                    <a class=""href="<?= url("app/contato"); ?>"> Nos Contate </a>
                </div>
            </div>
        </div>
    </div>
</div>
