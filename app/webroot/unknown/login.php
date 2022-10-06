<?php include 'includes/header.php';?>
<div class="breadcrumbs-area breadcrumbs-bg ptb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumbs-inner">
                            <h5 class="breadcrumbs-disc m-0">Best Products for you</h5>
                    <h2 class="breadcrumbs-title text-black m-0"> <span class="text-defualt">L</span>OGIN / <span class="text-defualt"> R</span>EGISTER</h2>
                            <ul class="top-page">
                                <li><a href="index.html">Home</a></li>
                                <li>&gt;</li>
                                <li>About</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="register-area pt-90">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="registered-customers">
                                <h4 class="text-uppercase mb-20"><strong>REGISTERED CUSTOMERS</strong></h4>
                                <form action="#">
                                    <div class="login-account p-30 box-shadow">
                                        <p>If you have an account with us, Please log in.</p>
                                        <input type="text" placeholder="Email Address" name="name">
                                        <input type="password" placeholder="Password" name="password">
                                        <p><small><a href="#">Forgot our password?</a></small></p>
                                        <button type="submit" class="cart-button text-uppercase">login</button>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="registered-customers new-customers">
                                <div class="section-title text-uppercase mb-20">
                                    <h4>NEW CUSTOMERS</h4>
                                </div>
                                <?php 
                              $msg = $this->Session->flash(); 
                              echo $msg; 							
                              ?>
                           <?php echo $this->Form->create('User'); ?>
                                    <div class="login-account p-30 box-shadow">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="First Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="last Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="custom-select">
                                                    <option value="defalt">country</option>
                                                    <option value="c-1">Australia</option>
                                                    <option value="c-2">Bangladesh</option>
                                                    <option value="c-3">Unitd States</option>
                                                    <option value="c-4">Unitd Kingdom</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                               <?php echo $this->Form->input('state', array('class'=>'form-control col-md-3','placeholder'=>''));?>	
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="custom-select">
                                                    <option value="defalt">Town/City</option>
                                                    <option value="c-1">Victoria</option>
                                                    <option value="c-2">Chittagong</option>
                                                    <option value="c-3">Boston</option>
                                                    <option value="c-4">Cambridge</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="Phone here...">
                                            </div>
                                        </div>
                                        <input type="text" placeholder="Company neme here...">
                                        <input type="text" placeholder="Email address here...">
                                        <input type="password" placeholder="Password">
                                        <input type="password" placeholder="Confirm Password">
                                        <div class="checkbox">
                                            <label class="mr-10"> 
                                                <small>
                                                    <input type="checkbox" name="signup">Sign up for our newsletter!
                                                </small>
                                            </label>
                                            <label> 
                                                <small>
                                                    <input type="checkbox" name="signup">Receive special offers from our partners!
                                                </small>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button value="register" type="submit" class="cart-button text-uppercase mt-20">Register</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="reset" class="cart-button text-uppercase mt-20">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include 'includes/footer.php';?>        
