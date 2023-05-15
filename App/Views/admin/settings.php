
<div class="container-fluid">
  <div class="row" id="allContainer">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Settings</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
          </button>
        </div>
      </div>

      <div class="container">

        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <h4>Basic</h4>
            <div class="container">

              <div class="row border mt-1 mb-2" style="padding: 8px; cursor:pointer;" 
                  onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/settings/classes';">
                  <div class="col-2"><i class="fa fa-bookmark"></i></div>
                  <div class="col-10">Classes</div>
              </div>

              <div class="row border mt-1 mb-2" style="padding: 8px; cursor:pointer;" 
                  onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/settings/sections';">
                  <div class="col-2"><i class="fa fa-object-group"></i></div>
                  <div class="col-10">Sections</div>
              </div>

              <div class="row border mt-1 mb-2" style="padding: 8px; cursor:pointer;" 
                  onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/settings/subjects';">
                  <div class="col-2"><i class="fa fa-book"></i></div>
                  <div class="col-10">Subjects</div>
              </div>

              <div class="row border mt-1 mb-2" style="padding: 8px; cursor:pointer;" 
                  onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/settings/exams';">
                  <div class="col-2"><i class="fa fa-file-text-o"></i></div>
                  <div class="col-10">Exams</div>
              </div>


            </div>
          </div>
          <div class="col-md-3"></div>
        </div>

        <br><br>
        
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <h4>Genaral</h4>
            <div class="container">

              <div class="row border mt-1 mb-2" style="padding: 8px; cursor:pointer;" 
                  onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/settings/institute_basic';">
                  <div class="col-2"><i class="fa fa-cog"></i></div>
                  <div class="col-10">Institute Informations</div>
              </div>

              <div class="row border mt-1 mb-2" style="padding: 8px; cursor:pointer;" 
                  onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/settings/notices';">
                  <div class="col-2"><i class="fa fa-bell-o"></i></div>
                  <div class="col-10">Notices</div>
              </div>

              <div class="row border mt-1 mb-2" style="padding: 8px; cursor:pointer;" 
                  onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/settings/gallery';">
                  <div class="col-2"><i class="fa fa-photo"></i></div>
                  <div class="col-10">Slider &amp; Gallery</div>
              </div>

              <div class="row border mt-1 mb-2" style="padding: 8px; cursor:pointer;" 
                  onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/settings/institute_head';">
                  <div class="col-2"><i class="fa fa-user"></i></div>
                  <div class="col-10">Institute Head Photo &amp; Message</div>
              </div>

              <div class="row border mt-1 mb-2" style="padding: 8px; cursor:pointer;" 
                  onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/settings/institute_chairman';">
                  <div class="col-2"><i class="fa fa-user"></i></div>
                  <div class="col-10">Institute Chairman Photo &amp; Message</div>
              </div>

            </div>
          </div>
          <div class="col-md-3"></div>
        </div>

        
      </div>

    </main>
  </div>
</div>
</div>



