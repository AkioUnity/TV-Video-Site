<script src="<?=site_url()?>assets/frontends/vendors/jquery.creditCardValidator.js"></script>
<script src="<?=site_url()?>assets/plugins/jquery.validate.js"></script>   
<div id="rootwizard" class="m-t-50">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm" role="tablist" data-init-reponsive-tabs="dropdownfx">
                <li class="nav-item">
                  <a class="" href="javascript:;"><i class="fa fa-shopping-cart tab-icon"></i> <span>Your cart</span></a>
                </li>
                <li class="nav-item">
                  <a class="active" href="javascript:;" ><i class="fa fa-credit-card tab-icon"></i> <span>Payment details</span></a>
                </li>
                
                <li class="nav-item">
                  <a class="" href="javascript:;"><i class="fa fa-check tab-icon"></i> <span>Summary</span></a>
                </li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>

<div class="tab-pane padding-20 sm-no-padding active slide-left" id="tab1">
  <div class="row row-same-height">
                    <div class="col-md-5 b-r b-dashed b-grey ">
                      <div class="padding-30 sm-padding-5 sm-m-t-15 m-t-50">
                        <h2>We Secured Your Line!</h2>
                        <p>Your account is almost ready. Fill in your payment detail and you'll be all set.</p>
                        <p class="small hint-text">Your order is as follows:</p>
                        <table class="table table-condensed">
                          <tbody><tr>
                            <td class=" col-md-9">
                              <span class="m-l-10 font-montserrat fs-11 all-caps"><?=$session_data['user_form']['membership']?></span>
                            </td>
                            <td class=" col-md-3 text-right">
                              <span><?=$session_data['user_form']['type']=='month'?'1 Month':'12 Month'?></span>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" class=" col-md-3 text-right">
                              <h4 class="text-primary no-margin font-montserrat">$<?=$session_data['user_form']['amount']?></h4>
                            </td>
                          </tr>
                        </tbody></table>
                        <p class="small">Invoices are issued at the time of payment. You can cancel your order at any time. If you need a hand, call or email support, available by clicking your profile picture at the top of this page.</p>
                        <p class="small">By pressing Pay Now You will Agree to the Payment <a href="#">Terms &amp; Conditions</a></p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="padding-30 sm-padding-5">
                        <ul class="list-unstyled list-inline m-l-30">
                          <li><a href="#" class="p-r-30 text-black">Credit card</a></li>
                          <li><a href="#" class="p-r-30 text-black  hint-text">PayPal</a></li>
                        </ul>
                          <div class="bg-master-light padding-30 b-rad-lg">
                            <h2 class="pull-left no-margin">Credit Card</h2>
                            <ul class="list-unstyled pull-right list-inline no-margin">
                              <li>
                                <a href="#">
                                  <img width="51" height="32" data-src-retina="assets/users/images/visa2x.png" data-src="assets/users/images/visa.png" class="brand" alt="logo" src="assets/users/images/visa.png">
                                </a>
                              </li>
                              <li>
                                <a href="#" class="hint-text">
                                  <img width="51" height="32" data-src-retina="assets/users/images/amex2x.png" data-src="assets/users/images/amex.png" class="brand" alt="logo" src="assets/users/images/amex.png">
                                </a>
                              </li>
                              <li>
                                <a href="#" class="hint-text">
                                  <img width="51" height="32" data-src-retina="assets/users/images/mastercard2x.png" data-src="assets/users/images/mastercard.png" class="brand" alt="logo" src="assets/users/images/mastercard.png">
                                </a>
                              </li>
                            </ul>
                            <div class="clearfix"></div>
                            <div class="form-group form-group-default required m-t-25">
                              <label>Card holder's name</label>
                              <input type="text" class="form-control" name="card_name"  placeholder="Name on the card" required="">
                            </div>
                            <div class="form-group form-group-default required">
                              <label>Card number</label>
                              <input type="text" class="form-control" name="card_number" placeholder="8888-8888-8888-8888" id="input-card" required="">
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <label>Expiration Date</label>
                                <br>
                                <select class="cs-select cs-skin-slide" name="card_month">
                                  <option value="01" selected="">Jan (01)</option>
                                  <option value="02">Feb (02)</option>
                                  <option value="03">Mar (03)</option>
                                  <option value="04">Apr (04)</option>
                                  <option value="05">May (05)</option>
                                  <option value="06">Jun (06)</option>
                                  <option value="07">Jul (07)</option>
                                  <option value="08">Aug (08)</option>
                                  <option value="09">Sep (09)</option>
                                  <option value="10">Oct (10)</option>
                                  <option value="11">Nov (11)</option>
                                  <option value="12">Dec (12)</option>
                                </select>
                                <select class="cs-select cs-skin-slide" name="card_year">
<?php
for($i=date('Y');$i<=date('Y')+20;$i++){
?>
<option value="<?=$i?>"><?=$i?></option>
<?php	
}
?>
                                </select>
                              </div>
                              <div class="col-md-2 offset-md-4">
                                <div class="form-group required">
                                  <label>CVC Code</label>
                                  <input type="text" class="form-control" name="card_cvv" placeholder="000" required="">
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
</div>

<div class="padding-20 sm-padding-5 sm-m-b-20 sm-m-t-20 bg-white clearfix">
  <ul class="pager wizard no-style">
    <li class="next">
      <button class="btn btn-primary btn-cons btn-animated from-left fa fa-truck pull-right" id="pay" type="submit">
        <span>Pay</span>
      </button>
    </li>
    
  </ul>
</div>

<?=form_close()?>
                <div class="wizard-footer padding-20 bg-master-light">
                  <p class="small hint-text pull-left no-margin">
                    The Top Content Is Soley Created using pages UI Elements such as Invoice, Tabs, Form Layouts etc. and are prior for representation Purpose Only.
                  </p>
                  <div class="pull-right">
                    <img src="assets/users/images/logo.png" alt="logo" data-src="assets/users/images/logo.png" data-src-retina="assets/users/images/logo.png" width="78" height="22">
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>


<script>
$( ".edit-form" ).validate({
});

jQuery(document).ready(function() {
		$('#pay').prop("disabled", true);
        jQuery('#input-card').validateCreditCard(function(result) {
			$btn =false;
			console.log(result);
			if(result.valid==true){
				$btn =true;
			}
			if($btn){
			 $('#pay').removeAttr("disabled");
			}
/*            $('.log').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name)
                     + '<br>Valid: ' + result.valid
                     + '<br>Length valid: ' + result.length_valid
                     + '<br>Luhn valid: ' + result.luhn_valid);*/
        });
});
</script>




