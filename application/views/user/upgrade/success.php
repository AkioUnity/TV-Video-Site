<script src="assets/plugins/jquery.validate.js"></script>   
<div id="rootwizard" class="m-t-50">
  <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm" role="tablist" data-init-reponsive-tabs="dropdownfx">
    <li class="nav-item">
      <a class="" href="javascript:;"><i class="fa fa-shopping-cart tab-icon"></i> <span>Your cart</span></a>
    </li>
        <li class="nav-item">
          <a class="" href="javascript:;" ><i class="fa fa-credit-card tab-icon"></i> <span>Payment details</span></a>
        </li>
    <li class="nav-item">
      <a class="active" href="javascript:;"><i class="fa fa-check tab-icon"></i> <span>Summary</span></a>
    </li>
  </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane slide-left padding-20 sm-no-padding active" id="tab4">
                  <h1>Thank you.</h1>
                  <!-- SHOW IF SUCCESS -->
                  <p>Your order has been processed. You will receive a copy of your invoice via email. </p>
                  <p>Invoices can take up to 24hrs i busy periods, typical time is under 10 minutes.</p>
                  <!--//END SHOW IF SUCCESS -->
                </div>
                <div class="padding-20 sm-padding-5 sm-m-b-20 sm-m-t-20 bg-white clearfix">
                  <ul class="pager wizard no-style">
                    <li class="next finish ">
                      <button class="btn btn-primary btn-cons btn-animated from-left fa fa-cog pull-right" type="button" onclick="window.location='<?=$_user_link.'/account'?>'">
                        <span>Finish</span>
                      </button>
                    </li>
                  </ul>
                </div>
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

