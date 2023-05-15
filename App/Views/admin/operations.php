
<div class="container-fluid">
  <div class="row" id="allContainer">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Operations</h1>
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
            <div class="container">

              <div class="row border mt-1 mb-2" style="padding: 8px; cursor:pointer;" 
                  onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/operations/exam_mark_distribution';">
                  <div class="col-2"><i class="fa fa-file-text-o"></i></div>
                  <div class="col-10">Exams Mark Distribution</div>
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



