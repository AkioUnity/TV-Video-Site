<div class="row">
<div class="col-lg-6 m-b-10 d-flex">
<!-- START WIDGET widget_pendingComments.tpl-->

<div class="widget-11-2 card no-border card-condensed no-margin widget-loader-circle align-self-stretch d-flex flex-column">
  <div class="card-header top-right">
    <div class="card-controls">
      <ul>
        <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i
                        class="portlet-icon portlet-icon-refresh"></i></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="padding-25">
    <div class="pull-left">
      <h2 class="text-success no-margin">About</h2>
      <p class="no-margin">COICIO™ + PropertyTV</p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="p-l-25 p-r-25">
    <div class="pull-left">
        <p>Property TV is the world's first Property focused OTT (Over The Top) streaming service, also known as Post-Cable and COICIO™ is the technology that makes it happen. Property TV Broadcasts LIVE and On-Demand content to a worldwide audience.</p>
        <p>Featuring engaging, entertaining and high produced content, Property TV also allows for industry thought leaders to create and Broadcast their very own TV Shows and Videos via their very own Property TV Channel.</p>
        <p>Anyone can create their own TV Channel, just fill in an <a href="channel_request">application</a> so we can make sure your content is aligned with PRoperty TV's culture, terms &amp; conditions.</p>
        <p><b>Property TV's LIVE Broadcast Network:</b></p>
        <div>    
            <div class="fa-item">
                <i class="fa fa-facebook x2"></i> Facebook LIVE
                <i class="fa fa-twitter x2 p-l-20"></i> Twitter LIVE
                <i class="fa fa-instagram x2 p-l-20"></i> Instagram TV
            </div>
            <div class="fa-item p-t-10">
                <i class="fa fa-youtube"></i> YouTube LIVE
                <i class="fa fa-apple x2 p-l-20 "></i> Apple
                <i class="fa fa-ra x2 p-l-20"></i> Roku
                <img src="assets/frontends/images/pTV-20px.png" class=" p-l-20">pTV
            </div>
            <p class="p-t-10">
                ... &amp; more to come.
            </p>
            <hr />
            <p>
        </div>    
        </p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="padding-25 mt-auto">
    <p class="small no-margin">
      <a href="mailto:help@propertytv.io"><i class="fa fs-16 fa-info-circle text-success m-r-10"></i>
      <span class="hint-text ">Contact</span></a>
    </p>
  </div>
</div>
<!-- END WIDGET -->
</div>
<?php
if($user_details->approved_channel==1){
	if($this->data['userPermission']&&(in_array('channel',$this->data['userPermission']))){
?>          
<div class="col-lg-6 m-b-10 d-flex">
<!-- START WIDGET widget_pendingComments.tpl-->

<div class="widget-11-2 card no-border card-condensed no-margin widget-loader-circle align-self-stretch d-flex flex-column">
  <div class="card-header top-right">
    <div class="card-controls">
      <ul>
        <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i
                        class="portlet-icon portlet-icon-refresh"></i></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="padding-25">
    <div class="pull-left">
      <h2 class="text-success no-margin">Getting Started</h2>
      <p class="no-margin">How To?</p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="p-l-25 p-r-25">
    <div class="pull-left">
        <p>We strongly recommend using the <a href="/create_new"><b>WIZARD</b></a> to get started. The best process is as follows:
      <ol>
          <li>Create your <a href="/create"><b>Channel</b></a></li>
          <li>Create <a href="/create"><b>Categories</b></a>, such as Buying Tips, Testimonials, Selling</li>
          <li>Make sure your Channel and Categories are switched to <b>ON</b></li>
      </ol>
        <b>Now your Channel is set up</b> and you can upload videos to create your shows...<br />Repeat the following process for each Show.
        <ul>
        <li>To create your <a href="/create_new"><b>SHOW</b></a></li>
          <ul>
              <li>Upload your Video in MP4 only</li>
              <li>Give it a title</li>
              <li>Add a series & episode number, such as "Series 1" &amp; "Episode 2"</li>
              <li>Add TAGS so you and viewers can easily find your video/show</li>
              <li>Assign your Show to your <b>Channel</b> and <b>Category</b></li>
              <li>To place your video in the very top area of your Channel, select "<b>Hero Area</b>"</li>
              <li>Add a show summary and description</li>
              <li>Upload your show imagery</li>
              <li>Click <b>Make LIVE</b></li>
          </ul>
      </ul>  
      </p>
      <p>
          If you would like more than 1x Channel or would like to Broadcast LIVE, please upgrade your account.
      </p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="padding-25 mt-auto">
    <p class="small no-margin">
      <a href="mailto:help@propertytv.io"><i class="fa fs-16 fa-info-circle text-success m-r-10"></i>
      <span class="hint-text ">Contact</span></a>
    </p>
  </div>
</div>
<!-- END WIDGET -->
</div>
<?php
	}
}
?>          



</div>
