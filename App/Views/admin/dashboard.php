
<div class="container-fluid">
  <div class="row" id="allContainer">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
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

      <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
          <div class="col-md-4">
            <div class="card" style="width: 18rem;" onclick="window.location = '<?php echo CONFIG['base_url']; ?>/admin/manage-students/manage';">
              <img class="card-img-top" src="<?php echo CONFIG['base_url']; ?>/resources/images/badges/manage-student.png" alt="Card">
              <div class="card-body">
                <h5 class="card-title">Total Approved Student</h5>
                <h4 class="card-text"><?= $approvedStudentCount ?></h4>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card" style="width: 18rem;" onclick="window.location = '<?php echo CONFIG['base_url']; ?>/admin/manage-students/approval';">
              <img class="card-img-top" src="<?php echo CONFIG['base_url']; ?>/resources/images/badges/student-approval.png" alt="Card">
              <div class="card-body">
                <h5 class="card-title">Total Unapproved Student</h5>
                <h4 class="card-text"><?= $unApprovedStudentCount ?></h4>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card" style="width: 18rem;" onclick="window.location = '<?php echo CONFIG['base_url']; ?>/admin/manage-teachers/manage';">
              <img class="card-img-top" src="<?php echo CONFIG['base_url']; ?>/resources/images/badges/register-student.png" alt="Card">
              <div class="card-body">
                <h5 class="card-title">Total Teacher</h5>
                <h4 class="card-text"><?= $teacherCount ?></h4>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>
</div>



