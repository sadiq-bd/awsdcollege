
<div class="container-fluid">
  <div class="row" id="allContainer">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Teachers</h1>
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
            <div class="col-md-1"></div>
            <div class="col-md-10">
            <div id="searchBar">
                <form action="<?= CONFIG['base_url'] ?>/admin/manage-students/manage" method="get" id="searchForm">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select name="filter" id="serachFilter" class="form-control">
                                <option value="">Filter</option>
                                <option value="student_unique_id">By Unique ID</option>
                                <option value="student_full_name">By Name</option>
                                <option value="student_class">By Class</option>
                                <option value="student_group">By Group</option>

                            </select>
                        </div>
                        <?php
                          if (!empty($_GET['filter'])) {
                        ?>
                          <script>html('#serachFilter option[value=<?=$_GET['filter']?>]').setAttribute('selected', 'true');</script>
                        <?php
                          }
                        ?>
                        <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search..." value="<?= @$_GET['search'] ?>">
                        <?php 
                          if (!empty($_GET['search'])) {
                        ?>
                        <div class="input-group-append">
                            <a class="btn btn-danger" href="<?= CONFIG['base_url'] ?>/admin/manage-students/manage">Clear Search</a>
                        </div>
                        <?php
                          }
                        ?>
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Unique ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Class</th>
                    <th scope="col">Group</th>
                    <th scope="col">Roll</th>
                    <th scope="col">Full Info</th>
                    <th scope="col">Quick Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        
                        foreach ($studentData as $key => $stdData) {
                    ?>
                    <tr>
                        <th scope="row"><?= $serialNumber-- ?></th>
                        <td><img src="<?= $stdData['student_photo'] ?>" alt="" width="50"></td>
                        <td><?= $stdData['student_unique_id'] ?></td>
                        <td><?= $stdData['student_full_name'] ?></td>
                        <td><?= $stdData['student_class']['class_name'] ?></td>
                        <td><?= $stdData['student_group']['group_title'] ?></td>
                        <td><?= $stdData['student_roll'] ?></td>
                        <td>
                            <form action="<?= CONFIG['base_url'] ?>/admin/manage-students/manage/info" method="post"><input type="hidden" name="studentID" value="<?= $stdData['ID'] ?>"><button type="submit" title="Click to view info"><i class="fa fa-info-circle"></i></button></form>
                        </td>
                        <td style="display:flex; justify-content:space-around;">
                            <form action="<?= CONFIG['base_url'] ?>/admin/manage-students/manage/edit" method="post"><input type="hidden" name="studentID" value="<?= $stdData['ID'] ?>"><input type="hidden" name="action" value="edit"><button type="submit" title="Click to edit"><i class="fa fa-pencil-square-o"></i></button></form>
                            <form action="<?= CONFIG['base_url'] ?>/admin/manage-students/manage/info" method="post"><input type="hidden" name="studentID" value="<?= $stdData['ID'] ?>"><input type="hidden" name="print" value="true"><button type="submit" title="Click to Print"><i class="fa fa-print"></i></button></form>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>

                </tbody>
                </table>

                <div>
                <?php
                    $extraSearch = !empty($_GET['search']) ? '&search=' . $_GET['search'] : '';
                    $extraSearch .= !empty($_GET['filter']) ? '&filter=' . $_GET['filter'] : '';
                    for ($page = 1; $page <= $totalPageCount; $page++) {
                ?>
                  <a href="?page=<?= $page . $extraSearch ?>"><button><?= $page ?></button></a>
                <?php
                    }
                ?>
                </div>
                
            </div>
            <div class="col-md-1"></div>
        </div>
      </div>

    </main>
  </div>
</div>
</div>



