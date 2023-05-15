
<div class="container-fluid">
  <div class="row" id="allContainer">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

      <div class="container rounded bg-white mt-5 mb-5">
      <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="img-thumbnail mt-5" width="150" src="<?= $adminData['admin_photo'] ?>">
                <span class="font-weight-bold"><?= $adminData['admin_full_name'] ?></span>
                <span class="text-black-50">0<?= $adminData['admin_mobile_no'] ?></span>
                <span class="text-black-50"><?= $adminData['admin_email'] ?></span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Info</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Full Name</label><input type="text" class="form-control" placeholder="Name" value="<?= $adminData['admin_full_name'] ?>" disabled></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="phone number" value="0<?= $adminData['admin_mobile_no'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="email id" value="<?= $adminData['admin_email'] ?>" disabled></div>

                </div>
                
                <!-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div> -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <!-- <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div> -->
            </div>
        </div>
      </div>
      </div>

    </main>
  </div>
</div>

