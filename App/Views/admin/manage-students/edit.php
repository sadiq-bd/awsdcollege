<?php
extract($academicInfo);
$viewType = !empty($_POST['viewType']) ? $_POST['viewType'] : 'manage';
?>
<style>
    div.row {
        padding: 4px 0 4px 0;
        margin: 4px 0 4px 0;
        text-align: center;
    }
</style>

<div class="container-fluid">
  <div class="row" id="allContainer">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"><button onclick="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') echo 'window.location = \'' . CONFIG['base_url']. '/admin/manage-students/' . $viewType . '\''; else echo 'window.history.back()';?>" class="btn btn-outline-primary">Go Back</button></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <form id="updateForm" enctype="multipart/form-data" method="POST">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">

                                    <div class="row">
                                        <div class="col-md-5"><label for="admissionClassSelect">Class </label></div>
                                        <div class="col-md-7">
                                            <select id="admissionClassSelect" class="form-control" name="admissionClassSelect">
                                                <option value="0">Select</option>
                                                <?php
                                                    foreach($classes as $class) {
                                                ?>
                                                <option value="<?= $class['ID'] ?>"><?= $class['class_name'] ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
             
                                    <div class="row">
                                        <div class="col-md-5"><label for="admissionSessionSelect">Session </label></div>
                                        <div class="col-md-7"><input type="text" id="admissionSessionSelect" class="form-control" name="admissionSessionSelect" value="<?= $studentData['student_session'] ?>"></div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>


                    
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
             
                                    <div class="row">
                                        <div class="col-md-5"><label for="studentRollInput">Roll </label></div>
                                        <div class="col-md-7"><input type="number" id="studentRollInput" class="form-control" name="studentRollInput" value="<?= $studentData['student_roll'] ?>"></div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div id="classSelectNextStep">


                        <div class="row">
                            <div class="col-md-8 pt-3">
                                
                                <div class="row">
                                    <div class="col-md-5"><label for="studentNameInput">Full Name </label></div>
                                    <div class="col-md-7"><input type="text" id="studentNameInput" class="form-control" name="studentNameInput" value="<?= $studentData['student_full_name'] ?>"></div>
                                </div>
                                                            
                                <div class="row">
                                    <div class="col-md-5"><label for="studentFatherNameInput">Father's Name </label></div>
                                    <div class="col-md-7"><input type="text" id="studentFatherNameInput" class="form-control" name="studentFatherNameInput" value="<?= $studentData['student_father_name'] ?>"></div>
                                </div>
                                                                                                
                                <div class="row">
                                    <div class="col-md-5"><label for="studentFatherNidInput">Father's NID </label></div>
                                    <div class="col-md-7"><input type="text" id="studentFatherNidInput" class="form-control" name="studentFatherNidInput" value="<?= $studentData['student_father_nid'] ?>"></div>
                                </div>
                                                               
                                <div class="row">
                                    <div class="col-md-5"><label for="studentMotherNameInput">Mother's Name </label></div>
                                    <div class="col-md-7"><input type="text" id="studentMotherNameInput" class="form-control" name="studentMotherNameInput" value="<?= $studentData['student_mother_name'] ?>"></div>
                                </div>
                                                                                               
                                <div class="row">
                                    <div class="col-md-5"><label for="studentMotherNidInput">Mother's NID </label></div>
                                    <div class="col-md-7"><input type="text" id="studentMotherNidInput" class="form-control" name="studentMotherNidInput" value="<?= $studentData['student_mother_nid'] ?>"></div>
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <!-- Photo -->
                                <div class="" style="width: 100%; border: 1px solid #007bff;height: 200px; padding:5px; overflow:hidden; border-radius:3px;" onclick="document.getElementById('studentPictureSelect').click()">
                                    <img src="<?= getStudentImageUrl($studentData['student_photo']) ?>" alt="Select Pic" style="width: 200px; height: 200px; object-fit: contain;" id="studentImage">
                                </div>
                                <input type="file" accept="image/*" id="studentPictureSelect" style="display: none;" hidden>
                                <a href="javascript:void(0)" onclick="document.getElementById('studentPictureSelect').click()" class="btn btn-block btn-outline-primary">Change Picture </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentGenderSelect">Gender </label></div>
                                    <div class="col-md-8">
                                        <select id="studentGenderSelect" class="form-control" name="studentGenderSelect">
                                            <option value="0">Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentBirthInput">Date of Birth </label></div>
                                    <div class="col-md-8"><input type="date" id="studentBirthInput" class="form-control" name="studentBirthInput" value="<?= $studentData['student_birth_date'] ?>"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentReligionSelect">Religion </label></div>
                                    <div class="col-md-8">
                                        <select id="studentReligionSelect" class="form-control" name="studentReligionSelect">
                                            <option value="0">Select</option>
                                            <option value="islam">Islam</option>
                                            <option value="hindu">Hindu</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentNationalitySelect">Nationality </label></div>
                                    <div class="col-md-8">
                                        <select id="studentNationalitySelect" class="form-control" name="studentNationalitySelect">
                                            <option value="bangladeshi">Bangladeshi</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentBloodSelect">Blood Group </label></div>
                                    <div class="col-md-8">
                                        <select id="studentBloodSelect" class="form-control" name="studentBloodSelect">
                                            <option value="0">Select</option>
                                            <option value="a+">A (+)</option>
                                            <option value="a-">A (-)</option>
                                            <option value="b+">B (+)</option>
                                            <option value="b-">B (-)</option>
                                            <option value="o+">O (+)</option>
                                            <option value="o-">O (-)</option>
                                            <option value="ab+">AB (+)</option>
                                            <option value="ab-">AB (-)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentShiftSelect">Shift </label></div>
                                    <div class="col-md-8">
                                        <select id="studentShiftSelect" class="form-control" name="studentShiftSelect">
                                            <option value="0">Select</option>
                                            <?php
                                            foreach($shifts as $shift) {
                                            ?>
                                            <option value="<?= $shift['ID'] ?>"><?= $shift['shift_title'] ?></option>
                                            <?php
                                                }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentGroupSelect">Group </label></div>
                                    <div class="col-md-8">
                                        <select id="studentGroupSelect" class="form-control" name="studentGroupSelect">
                                            <option value="0">Select</option>
                                            <?php
                                            foreach($groups as $group) {
                                            ?>
                                            <option value="<?= $group['ID'] ?>"><?= $group['group_title'] ?></option>
                                            <?php
                                                }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentSectionSelect">Section </label></div>
                                    <div class="col-md-8">
                                        <select id="studentSectionSelect" class="form-control" name="studentSectionSelect">
                                            <option value="0">Select</option>
                                            <?php
                                            foreach($sections as $section) {
                                            ?>
                                            <option value="<?= $section['ID'] ?>"><?= $section['section_title'] ?></option>
                                            <?php
                                                }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentDivisionSelect">Division </label></div>
                                    <div class="col-md-8">
                                        
                                        <select id="studentDivisionSelect" class="form-control" name="studentDivisionSelect">
                                            <option value="0">Select</option>
                                        </select>
                                    </div>
                                    <script>
                                        var div8 = ["Dhaka","Chattogram","Khulna","Rajshahi","Barishal","Sylhet","Rangpur","Mymensingh"];var studentDivisionSelect = html('#studentDivisionSelect');for (let i in div8) {var opt = document.createElement('option');opt.value = div8[i].replace(' ', '_').replace('\'', '').toLowerCase();opt.innerHTML = div8[i];studentDivisionSelect.append(opt);}
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentZillaSelect">Zilla </label></div>
                                    <div class="col-md-8">
                                        
                                        <select id="studentZillaSelect" class="form-control" name="studentZillaSelect">
                                            <option value="0">Select</option>
                                        </select>
                                    </div>
                                    <script>
                                        var dist64 = ["Dhaka","Faridpur","Gazipur","Gopalganj","Jamalpur","Kishoreganj","Madaripur","Manikganj","Munshiganj","Mymensingh","Narayanganj","Narsingdi","Netrokona","Rajbari","Shariatpur","Sherpur","Tangail","Bogra","Joypurhat","Naogaon","Natore","Nawabganj","Pabna","Rajshahi","Sirajgonj","Dinajpur","Gaibandha","Kurigram","Lalmonirhat","Nilphamari","Panchagarh","Rangpur","Thakurgaon","Barguna","Barisal","Bhola","Jhalokati","Patuakhali","Pirojpur","Bandarban","Brahmanbaria","Chandpur","Chittagong","Comilla","Cox's Bazar","Feni","Khagrachari","Lakshmipur","Noakhali","Rangamati","Habiganj","Maulvibazar","Sunamganj","Sylhet","Bagerhat","Chuadanga","Jessore","Jhenaidah","Khulna","Kushtia","Magura","Meherpur","Narail","Satkhira"];var studentZillaSelect = html('#studentZillaSelect');for (let i in dist64) {var opt = document.createElement('option');opt.value = dist64[i].replace(' ', '_').replace('\'', '').toLowerCase();opt.innerHTML = dist64[i];studentZillaSelect.append(opt);}
                                    </script>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentUpozillaInput">Upozilla </label></div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="studentUpozillaInput" value="<?= $studentData['student_subdistrict'] ?>" name="studentUpozillaInput">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentPostOfficeInput">Post Office </label></div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="studentPostOfficeInput" value="<?= @json_decode($studentData['student_address'])->postOffice ?>" name="studentPostOfficeInput">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentVillageInput">Village </label></div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="studentVillageInput" value="<?= @json_decode($studentData['student_address'])->village ?>" name="studentVillageInput">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentMobileInput">Mobile </label></div>
                                    <div class="col-md-8 input-group">
                                        <div class="input-group-prepend">
                                            <span class="form-control" style="background-color: #e9ecef;">+880</span>
                                        </div>
                                        <input type="tel" class="form-control" id="studentMobileInput" placeholder="1xxxxxxxxx" name="studentMobileInput" value="<?= $studentData['student_mobile_no'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentEmailInput">Email </label></div>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" id="studentEmailInput" placeholder="user@example.com" name="studentEmailInput" value="<?= $studentData['student_email'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentPasswordInput">New Password </label></div>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control" id="studentPasswordInput" placeholder="Password" name="studentPasswordInput">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentConfirmPasswordInput">Confirm Password </label></div>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control" id="studentConfirmPasswordInput" placeholder="Retype Password" name="studentConfirmPasswordInput">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-success">&nbsp;&nbsp;Update&nbsp;&nbsp;</button>
                            </div>
                            <div class="col-md-2"></div>  
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-1"></div>
    </div>
    </div>


    </main>
  </div>
</div>

<script type="text/javascript">

window.addEventListener('DOMContentLoaded', function() {

    var authToken = 'h23ry3f5con72yr78cr5y2nr5q3n5';

    var admissionClassSelect = html('#admissionClassSelect');
    var admissionSessionSelect = html('#admissionSessionSelect');
    var classSelectNextStep = html('#classSelectNextStep');
    var updateForm = document.getElementById('updateForm');
    var studentPictureSelect = html('#studentPictureSelect');
    var studentPasswordInput = html('#studentPasswordInput');
    var studentConfirmPasswordInput = html('#studentConfirmPasswordInput');


    updateForm.addEventListener('submit', function(e) {
        e.preventDefault();

        submitLoader_show();

        var initFormData = new Promise(function(resolve, reject) {

            var formData = new FormData(updateForm);
            var dataObj = {};
            dataObj['authToken'] = authToken;
            dataObj['studentID'] = <?= $studentData['ID'] ?>;

            formData.forEach(function(value, key){
                if (
                    key != 'studentPasswordInput' && 
                    key != 'studentConfirmPasswordInput'
                    ) {
                    // basic validation
                    if (value == '' 
                        || value == '0'
                    ) {

                        reject({
                            'message': FORM_ERROR_MESSAGES['empty-fields'],
                            'highlightElement': key
                        });

                    } 
                }
                dataObj[key] = value;
            });

            dataObj['admissionClassSelectName'] = html('#admissionClassSelect option')[admissionClassSelect.value].innerHTML;
            dataObj['admissionClassSelectId'] = admissionClassSelect.value;

            if (studentPasswordInput.value !== '') {
                if (studentPasswordInput.value !== studentConfirmPasswordInput.value) {

                    reject({
                            'message': FORM_ERROR_MESSAGES['confirmation-password-mismatch'],
                            'highlightElement': 'studentConfirmPasswordInput'
                        });
                }
            } else {
                dataObj['studentPasswordInput'] = undefined;
                dataObj['studentConfirmPasswordInput'] = undefined;
            }

            if (studentPictureSelect.value != '') {     // check if image selected

                var freader = new FileReader();
                freader.addEventListener('load', function(e) {
                    var fileName = studentPictureSelect.files[0].name.split('.');
                    var fileExt = fileName[fileName.length - 1];
                    
                    if (IMAGE_FILE_EXTENSIONS.includes(fileExt) &&
                        studentPictureSelect.files[0].size < 1024 * 1024 * MAX_PHOTO_UPLOAD_SIZE
                    ) {    
                        dataObj['studentPicture'] = {
                            'name': studentPictureSelect.files[0].name,
                            'size': studentPictureSelect.files[0].size,
                            'type': studentPictureSelect.files[0].type,
                            'data': window.btoa(freader.result)
                        };  
                        dataObj['previousPicture'] = '<?= pathinfo($studentData['student_photo'], PATHINFO_BASENAME) ?>'; 
                        resolve(JSON.stringify(dataObj));
                    } else {
                        
                        reject({
                            'message': FORM_ERROR_MESSAGES['invalid-image-file'] + 
                                    ' or ' + FORM_ERROR_MESSAGES['file-size-exceed'] +
                                    '. Valid Image File extensions: ' + IMAGE_FILE_EXTENSIONS.join(', ') +
                                    '. Max Image file size ' + MAX_PHOTO_UPLOAD_SIZE + ' MegaByte',
                            'highlightElement': 'studentPictureSelect'
                        });
                    }
                    
                });
                freader.onerror = function(e) {

                    reject({
                            'message': 'unable to read image file! please use an updated browser',
                            'highlightElement': 'studentPictureSelect'
                        });
                }
                freader.readAsBinaryString(studentPictureSelect.files[0]);
            
            } else {
                resolve(JSON.stringify(dataObj));
            }

        });

        initFormData.then(
            function (formData) {
                setErrorHighlighDefault();
                update_form_ajax(formData);
                submitLoader_hide();
            },
            function (err) {
                alert('Error: ' + err['message']);
                setErrorHighlighDefault();
                if (err['highlightElement'] != undefined) {
                    setErrorHighligh(err['highlightElement']);
                }
                submitLoader_hide();
            }
        );  

    });

    function setErrorHighlighDefault() {
        var updateFormData = new FormData(updateForm);
        updateFormData.forEach(function(value, key) {
            document.getElementById(key).style.borderColor = '#ced4da';
            document.getElementById(key).style.backgroundColor = '#fff';
        });
    }

    function setErrorHighligh(e) {
        document.getElementById(e).style.borderColor = '#f01d1d';
        document.getElementById(e).style.backgroundColor = '#f7e1e1';
        document.getElementById(e).focus();
    }

    var studentPictureSelect = html('#studentPictureSelect');
    studentPictureSelect.addEventListener('change', function(event){
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('studentImage');
            output.src = reader.result;
        }
        reader.readAsDataURL(studentPictureSelect.files[0]);
    });

    function update_form_ajax(data) {
        xhr({
            method: 'POST',
            url: '<?= CONFIG['base_url'] ?>/admin/manage-students/manage/update',
            onload: function(xhr) {
                submitLoader_hide();
                if (xhr.status == 200) {
                    let resp = xhr.responseText;
                    try {
                        resp = JSON.parse(resp)
                        // if (resp.status == 'success') {
                        //     window.location = resp.loadPage;
                        // } else {
                        //     alert(resp.message);
                        // }
                        alert(resp.message);
                    } catch (e) {
                        console.error(e);
                    }
                }
            },
            headers: {
                'Content-Type': 'application/json'
            },
            postBody: data,
            async: true
        });
    }


    var optSelections = [
        '#admissionClassSelect option[value=\'<?= $studentData['student_class'] ?>\']',
        '#studentGenderSelect option[value=\'<?= $studentData['student_gender'] ?>\']',
        '#studentReligionSelect option[value=\'<?= $studentData['student_religion'] ?>\']',
        '#studentNationalitySelect option[value=\'<?= $studentData['student_nationality'] ?>\']',
        '#studentBloodSelect option[value=\'<?= $studentData['student_blood_group'] ?>\']',
        '#studentShiftSelect option[value=\'<?= $studentData['student_shift'] ?>\']',
        '#studentGroupSelect option[value=\'<?= $studentData['student_group'] ?>\']',
        '#studentSectionSelect option[value=\'<?= @$studentData['student_section'] ?>\']',
        '#studentDivisionSelect option[value=\'<?= $studentData['student_division'] ?>\']',
        '#studentZillaSelect option[value=\'<?= $studentData['student_district'] ?>\']'
    ];
    for (let i in optSelections) {
        html(optSelections[i]).selected = true;
    }
        
});
</script>


<div class="submit-loader" id="submitLoader">
    <div style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%);transform: translateY(-50%);">
        <div class="spinner-border"></div>
    </div>
</div>
<script>
var submitLoader = html('#submitLoader');submitLoader.style.position = 'fixed';submitLoader.style.zIndex = '999999999999';submitLoader.style.top = '0';submitLoader.style.right = '0';submitLoader.style.bottom = '0';submitLoader.style.left = '0';submitLoader.style.background = '#eef';submitLoader.style.opacity = '0.7';submitLoader.style.display = 'none';var submitLoader_show = function () {submitLoader.style.display = 'block';}; var submitLoader_hide = function () {submitLoader.style.display = 'none';}
</script>





