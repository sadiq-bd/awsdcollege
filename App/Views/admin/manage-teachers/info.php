<div class="container-fluid">
  <div class="row" id="allContainer">

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-3"></div>
            <div class="col-md-3"><button onclick="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') echo 'window.location = \'' . CONFIG['base_url']. '/admin/manage-students/'.$viewType.'\''; else echo 'window.history.back()';?>" class="btn btn-outline-primary">Go Back</button></div>
            <div class="col-md-3">
                <?php
                    if ($viewType == 'approval') {
                ?>
                <div style="display: flex; justify-content:space-around;">
                    <form action="<?= CONFIG['base_url'] ?>/admin/manage-students/approval/action" method="post"><input type="hidden" name="studentID" value="<?= $studentData['ID'] ?>"><input type="hidden" name="action" value="approve"><button class="btn btn-success" type="submit"><i class="fa fa-check-square"></i> Approve</button></form>
                    <form action="<?= CONFIG['base_url'] ?>/admin/manage-students/approval/action" method="post"><input type="hidden" name="studentID" value="<?= $studentData['ID'] ?>"><input type="hidden" name="action" value="reject"><button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Reject</button></form>   
                </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-md-3" style="display: flex;justify-content:space-around;">
                <form action="<?= CONFIG['base_url'] ?>/admin/manage-students/manage/edit" method="post"><input type="hidden" name="studentID" value="<?= $studentData['ID'] ?>"><input type="hidden" name="action" value="edit"><button class="btn btn-primary" type="submit" title="Click to edit"><i class="fa fa-pencil-square-o"></i> Update Info</button></form>
                <div><button class="btn btn-primary" onclick="printProfilePage()" title="Click to Print"><i class="fa fa-print"></i> Print</button></div>
            </div>
            
        </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="profileInfo">

      <div class="container rounded bg-white mt-5 mb-5">

        <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="img-thumbnail mt-5" width="150" src="<?= $studentData['student_photo'] ?>">
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Student Info</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Unique ID</label><input type="text" class="form-control" placeholder="UID" value="<?= $studentData['student_unique_id'] ?>" disabled></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Full Name</label><input type="text" class="form-control" placeholder="Name" value="<?= $studentData['student_full_name'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Father's Name</label><input type="text" class="form-control" placeholder="Name" value="<?= $studentData['student_father_name'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Father's NID</label><input type="text" class="form-control" placeholder="NID" value="<?= $studentData['student_father_nid'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Mother's Name</label><input type="text" class="form-control" placeholder="Name" value="<?= $studentData['student_mother_name'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Mother's NID</label><input type="text" class="form-control" placeholder="NID" value="<?= $studentData['student_mother_nid'] ?>" disabled></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="phone number" value="0<?= $studentData['student_mobile_no'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="email id" value="<?= $studentData['student_email'] ?>" disabled></div>
                    
                    <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="Address" value="<?php echo json_decode($studentData['student_address'])->postOffice . ', ' . json_decode($studentData['student_address'])->village; ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">State</label><input type="text" class="form-control" placeholder="" value="<?= $studentData['student_subdistrict'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">District</label><input type="text" class="form-control" placeholder="" value="<?= ucfirst($studentData['student_district']) ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Division</label><input type="text" class="form-control" placeholder="" value="<?= ucfirst($studentData['student_division']) ?>" disabled></div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Gender</label><input type="text" class="form-control" placeholder="" value="<?= ucfirst($studentData['student_gender']) ?>" disabled></div>
                    <div class="col-md-6"><label class="labels">Religion</label><input type="text" class="form-control" placeholder="" value="<?= ucfirst($studentData['student_religion']) ?>" disabled></div>
                    <div class="col-md-6"><label class="labels">Nationality</label><input type="text" class="form-control" placeholder="" value="<?= ucfirst($studentData['student_nationality']) ?>" disabled></div>
                    <div class="col-md-6"><label class="labels">Blood Group</label><input type="text" class="form-control" placeholder="" value="<?= ucfirst($studentData['student_blood_group']) ?>" disabled></div>
                    <div class="col-md-6"><label class="labels">Birth Date</label><input type="text" class="form-control" placeholder="" value="<?= date('d M Y', strtotime($studentData['student_birth_date'])) ?>" disabled></div>

                </div>
                <div class="row mt-3">

                    <div class="col-md-6"><label class="labels">Admitted at</label><input type="text" class="form-control" placeholder="" value="<?= date('d M Y', strtotime($studentData['student_admitted_at'])) ?>" disabled></div>

                </div>
                <!-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div> -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
            <div class="col-md-12"><label class="labels">Class</label><input type="text" class="form-control" placeholder="Class" value="<?= $studentData['student_class']['class_name'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Group</label><input type="text" class="form-control" placeholder="Group" value="<?= $studentData['student_group']['group_title'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Section</label><input type="text" class="form-control" placeholder="Section" value="<?= @$studentData['student_section']['section_title'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Roll</label><input type="text" class="form-control" placeholder="Roll" value="<?= $studentData['student_roll'] ?>" disabled></div>
                    
                    <div class="col-md-12"><label class="labels">Shift</label><input type="text" class="form-control" placeholder="" value="<?= $studentData['student_shift']['shift_title'] ?>" disabled></div>
                    <div class="col-md-12"><label class="labels">Optional Subject</label><input type="text" class="form-control" placeholder="" value="<?= @$studentData['student_optional_subject']['subject_title'] . ' (' . @$studentData['student_optional_subject']['subject_code'] . ')' ?>" disabled></div>
            </div>
        </div>
        </div>
      </div>

    </main>
  </div>
</div>

<script>
        function printDiv(div) {
        var divContents = document.getElementById(div).innerHTML;
        var a = window.open('', '', 'height=600, width=1000');
        a.document.write(`<html>
            <head>
                <link href="<?= CONFIG['base_url'] ?>/resources/styles/bootstrap.min.css" rel="stylesheet">
            </head>
        <body>`);
        a.document.write(`
        
        `);
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.onafterprint = function () {
            a.close();
        };
        a.print();

    }

    function printProfilePage() {
        let profileInfoClass = html('#profileInfo').className;
        html('#profileInfo').className = '';
        printDiv('profileInfo');
        html('#profileInfo').className = profileInfoClass;
    }

<?php
    if (isset($_POST['print'])) {
?>


    window.addEventListener('DOMContentLoaded', function() {
        printProfilePage();
    });
    

<?php
    }
?>

</script>

