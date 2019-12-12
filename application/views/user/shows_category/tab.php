<nav class="navbar navbar-default bg-master-lighter sm-padding-10 full-width p-t-0 p-b-0" role="navigation">
    <div class="container-fluid full-width">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header text-center">
        <button type="button" class="navbar-toggle collapsed btn btn-link no-padding" data-toggle="collapse" data-target="#sub-nav">
          <i class="pg pg-more v-align-middle"></i>
        </button>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="sub-nav">
        <div class="row">
          <div class="col-sm-4">
                <h3><?=$name?></h3>
          </div>
          <div class="col-sm-4">
            <ul class="navbar-nav d-flex flex-row">
              <!--<li class="nav-item"><a href="#">Open</a></li>-->
              <li class="nav-item"><a href="<?=$_cancel.'/create'?>" data-toggle="tooltip" data-placement="bottom" title="Add New"><i class="fa fa-plus"></i> Add New</a></li>
            </ul>
          </div>
          <div class="col-sm-4">
          </div>
        </div>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
