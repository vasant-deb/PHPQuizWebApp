<?php ?>

<div class="container-fluid upload-details">
                    <div class="row">
                          <?php foreach($faqs as $faq): ?>
                        <div class="col-lg-12">
                            <div class="bk-accordion" id="accordionExample">
                               
                                <div class="card">
                                    <div class="card-header" id="heading<?php echo $faq['Faq']['id']; ?>">
                                        <h5 class="mb-0">
                                            <a href="#" class="acc-btn" data-toggle="collapse" data-target="#collapse<?php echo $faq['Faq']['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $faq['Faq']['id']; ?>">
                                               <i class="fa fa-plus"></i> <?php echo $faq['Faq']['name']; ?>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapse<?php echo $faq['Faq']['id']; ?>" class="collapse" aria-labelledby="heading<?php echo $faq['Faq']['id']; ?>" data-parent="#accordionExample">
                                        <div class="card-body"> <?php echo $faq['Faq']['description']; ?>
                                        </div>
                                    </div>
                                </div>
								<br>
                                </div>

                                          </div>


                            <?php endforeach; ?>
                       
                       

                            </div>
                        </div>
                        <!-- End Single Accordion -->
                    
                


       

       