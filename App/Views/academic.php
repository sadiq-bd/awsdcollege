
<div class="container-fluid">
  <div class="row" id="allContainer">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

      <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="img-thumbnail mt-5" width="150px" src="<?= $userData[$userType . '_photo'] ?>">
                <span class="font-weight-bold"><?= $userData[$userType . '_full_name'] ?></span>
                <span class="text-black-50">0<?= $userData[$userType . '_mobile_no'] ?></span>
                <span class="text-black-50"><?= $userData[$userType . '_email'] ?></span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Academic Info</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Full Name</label><input type="text" class="form-control" placeholder="Name" value="<?= $userData[$userType . '_full_name'] ?>" disabled></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Class</label><input type="text" class="form-control" placeholder="Class" value="<?= $userData['student_class']['class_name'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Group</label><input type="text" class="form-control" placeholder="Group" value="<?= $userData['student_group']['group_title'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Section</label><input type="text" class="form-control" placeholder="Section" value="<?= @$userData['student_section']['section_title'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Roll</label><input type="text" class="form-control" placeholder="Roll" value="<?= $userData['student_roll'] ?>" disabled></div>
                    
                    <div class="col-md-12"><label class="labels">Shift</label><input type="text" class="form-control" placeholder="" value="<?= $userData['student_shift']['shift_title'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Subjects</label><input type="text" class="form-control" placeholder="" value="<?= $userData['student_selected_subjects'] ?>" disabled></div>
                    
                </div>
                <!-- <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Gender</label><input type="text" class="form-control" placeholder="" value="<?= $userData[$userType . '_gender'] ?>" disabled></div>
                    <div class="col-md-6"><label class="labels">Religion</label><input type="text" class="form-control" placeholder="" value="<?= $userData[$userType . '_religion'] ?>" disabled></div>
                    <div class="col-md-6"><label class="labels">Nationality</label><input type="text" class="form-control" placeholder="" value="<?= $userData[$userType . '_nationality'] ?>" disabled></div>
                    <div class="col-md-6"><label class="labels">Blood Group</label><input type="text" class="form-control" placeholder="" value="<?= $userData[$userType . '_blood_group'] ?>" disabled></div>
                    <div class="col-md-6"><label class="labels">Birth Date (Year-Month-Day)</label><input type="text" class="form-control" placeholder="" value="<?= $userData[$userType . '_birth_date'] ?>" disabled></div>

                </div> -->
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
      </div>
      </div>
    </main>
  </div>
</div>
</div>