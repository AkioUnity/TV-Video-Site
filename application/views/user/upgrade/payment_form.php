<script src="assets/plugins/jquery.validate.js"></script>   
<div id="rootwizard" class="m-t-50">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm" role="tablist" data-init-reponsive-tabs="dropdownfx">
                <li class="nav-item">
                  <a class="active" href="javascript:;"><i class="fa fa-shopping-cart tab-icon"></i> <span>Your cart</span></a>
                </li>
                <li class="nav-item">
                  <a class="" href="javascript:;" ><i class="fa fa-credit-card tab-icon"></i> <span>Payment details</span></a>
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
    <div class="col-md-5 b-r b-dashed b-grey sm-b-b">
      <div class="padding-30 sm-padding-5 sm-m-t-15 m-t-50">
        <i class="fa fa-sliders fa-2x hint-text"></i>
        <h2>Upgrade your account to a PRO or Concierge!</h2>
        <p>We're all about making things easy. Select from a PRO account or add extra channels and other fun features, or go Concierge and have everything done for you.</p>
        <p class="small hint-text">You can change your account at any time, just give us a bell!</p>
      </div>
    </div>
    <div class="col-md-7">
      <div class="padding-30 sm-padding-5">
          <h5>Account Type</h5>
          <p>Select the best service that meets your needs:</p>
        <table class="table table-condensed table-hover">
          <tr>
            <td class="col-lg-8 col-md-6 col-sm-7 ">
<input type="radio" name="membership" value="coicio" onclick="total_amount()" checked="checked"/>
              <!--<a href="javascript:;" class="remove-item"><i class="pg-close"></i></a>-->
              <span class="m-l-10 font-montserrat fs-11 all-caps">COICIO™ PRO</span>

            </td>
            <td class=" col-lg-2 col-md-3 col-sm-2 text-right">
              <h4 class="text-primary no-margin font-montserrat">$99</h4>
            </td>
          </tr>
          <tr>
            <td class="col-lg-8 col-md-6 col-sm-7">
				<input type="radio" name="membership" value="concierge" onclick="total_amount()" />
              <!--<a href="javascript:;" class="remove-item"><i class="pg-close"></i></a>-->
              <span class="m-l-10 font-montserrat fs-11 all-caps">Concierge</span>
              
            </td>
            <td class=" col-lg-2 col-md-3 col-sm-2 text-right">
              <h4 class="text-primary no-margin font-montserrat">$499</h4>
            </td>
          </tr>
        </table>
        <h5>Duration</h5>
        <div class="row">
          <div class="col-lg-7 col-md-6">
            <p class="no-margin">Save 20% by taking an annual account</p>
            <p class="small hint-text">
              To receive your 20% discount pay 12 months today.
            </p>
          </div>
          <div class="col-lg-5 col-md-6">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-default active" onclick="set_type('month')" ><!---->
                <input type="radio" name="type" value="month" checked> <span class="fs-16">Month</span>
              </label>
                <label class="btn btn-default " onclick="set_type('annual')" ><!---->
                <input type="radio" name="type" value="annual" > <span class="fs-16">Annual </span>  <span class="label label-info small"> 20% off</span>
              </label>
            </div>
          </div>
        </div>
        <br>
        <div class="row b-a b-grey no-margin">
          <div class="col-md-3 p-l-10 sm-padding-15 align-items-center d-flex">
            <div>
              <h5 class="font-montserrat all-caps small no-margin hint-text bold">Discount (20%)</h5>
              <p class="no-margin discount-amount" >$0</p>
            </div>
          </div>
          <div class="col-md-6 col-middle sm-padding-15 align-items-center d-flex">
            <div>
              <h5 class="font-montserrat all-caps small no-margin hint-text bold">Duration</h5>
              <p class="no-margin payment-type">Month</p>
            </div>
          </div>
          <div class="col-md-3 text-right bg-primary padding-10">
            <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
            <h4 class="no-margin text-white payment-total">$99</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="padding-20 sm-padding-5 sm-m-b-20 sm-m-t-20 bg-white clearfix">
  <ul class="pager wizard no-style">
    <li class="next">
      <button class="btn btn-primary btn-cons btn-animated from-left fa fa-truck pull-right" type="submit">
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

function select_membership(){
	val = $("input[name='membership']:checked").val();
}
var set_types = 'month';
function set_type(type){
	console.log(type);
	if(type=='month'){
		set_types = 'month';
/*		$('.payment-total').html('$598');
		$('.discount-amount').html('$0');
		$('.payment-type').html('Month');*/
	}
	else{
		set_types = 'annual';
/*		$('.payment-total').html('$5740.80');
		$('.discount-amount').html('$1435.20');
		$('.payment-type').html('Annual');*/
	}
	total_amount();
}

function total_amount(){
	val = $("input[name='membership']:checked").val();
//	type = $("input[name='payment_type']:checked").val();
//	console.log(type+' '+val);
	amount = 0;
	if(val=='coicio'){
		amount = 99;
	}
	else{
		amount = 499;
	}

	if(set_types=='month'){
		$('.payment-total').html('$'+amount);
		$('.discount-amount').html('$0');
		$('.payment-type').html('Month');
	}
	else{
		$('.payment-type').html('Annual');
		total = amount*12;
		per = (total*20/100).toFixed(2);
		total = (total-total*20/100).toFixed(2);
		
		$('.payment-total').html('$'+total);
		$('.discount-amount').html('$'+per);
	}
}
</script>




