<style>
    div.row {
        padding: 4px 0 4px 0;
        margin: 4px 0 4px 0;
        text-align: center;
    }
</style>
<div class="container">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 style="font-weight: 550;">Admission</h4>
            <form id="admissionForm" enctype="multipart/form-data" method="POST">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                   <label for="admissionClassSelect">Addmission Class </label>
                                </div>
                                <div class="col-md-6">
                                    <select id="admissionClassSelect" class="form-control" name="admissionClassSelect">
                                        <option value="0">Select</option>
                                        <?php
                                            foreach($classes as $class) {
                                                if ($class['class_admission_status'] !== 1) continue;
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

                    
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                <label for="admissionSessionSelect">Session </label>
                                </div>
                                <div class="col-md-6">
                                    <select id="admissionSessionSelect" class="form-control" name="admissionSessionSelect">
                                        <option value="0">Select</option>
                                        <option value="<?= date('Y') ?>"><?= date('Y') ?></option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>


                    <div id="classSelectNextStep" style="display: none;">


                        <div class="row">
                            <div class="col-md-8 pt-3">
                                
                                <div class="row">
                                    <div class="col-md-5"><label for="studentNameInput">Full Name </label></div>
                                    <div class="col-md-7"><input type="text" id="studentNameInput" class="form-control" name="studentNameInput"></div>
                                </div>
                                                            
                                <div class="row">
                                    <div class="col-md-5"><label for="studentFatherNameInput">Father's Name </label></div>
                                    <div class="col-md-7"><input type="text" id="studentFatherNameInput" class="form-control" name="studentFatherNameInput"></div>
                                </div>
                                                                                                
                                <div class="row">
                                    <div class="col-md-5"><label for="studentFatherNidInput">Father's NID </label></div>
                                    <div class="col-md-7"><input type="text" id="studentFatherNidInput" class="form-control" name="studentFatherNidInput"></div>
                                </div>
                                                               
                                <div class="row">
                                    <div class="col-md-5"><label for="studentMotherNameInput">Mother's Name </label></div>
                                    <div class="col-md-7"><input type="text" id="studentMotherNameInput" class="form-control" name="studentMotherNameInput"></div>
                                </div>
                                                                                               
                                <div class="row">
                                    <div class="col-md-5"><label for="studentMotherNidInput">Mother's NID </label></div>
                                    <div class="col-md-7"><input type="text" id="studentMotherNidInput" class="form-control" name="studentMotherNidInput"></div>
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <!-- Photo -->
                                <div class="" style="width: 100%; border: 1px solid #007bff;height: 200px; padding:5px; overflow:hidden; border-radius:3px;" onclick="document.getElementById('studentPictureSelect').click()">
                                    <img src="/resources/images/user.svg" alt="Select Pic" style="width: 200px; height: 200px; object-fit: contain;" id="studentImage">
                                </div>
                                <input type="file" accept="image/*" id="studentPictureSelect" style="display: none;" hidden>
                                <a href="javascript:void(0)" onclick="document.getElementById('studentPictureSelect').click()" class="btn btn-block btn-outline-primary">Select Picture </a>
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
                                    <div class="col-md-8"><input type="date" id="studentBirthInput" class="form-control" name="studentBirthInput"></div>
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
                                <div class="row" id="subjectSelectArea" style="display:none;">
                                    <div class="col-md-4"><label for="studentSectionSelect">Subjects </label></div>
                                    <div class="col-md-8">
                                        <a href="javascript:void(0)" class="btn btn-outline-secondary btn-block" id="subjectSelectBtn">Select</a>
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
                                        <input type="text" class="form-control" id="studentUpozillaInput" value="" name="studentUpozillaInput">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentPostOfficeInput">Post Office </label></div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="studentPostOfficeInput" value="" name="studentPostOfficeInput">
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentVillageInput">Village </label></div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="studentVillageInput" value="" name="studentVillageInput">
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
                                        <input type="tel" class="form-control" id="studentMobileInput" placeholder="1xxxxxxxxx" name="studentMobileInput">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><label for="studentEmailInput">Email </label></div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="studentEmailInput" placeholder="user@example.com" name="studentEmailInput" notrequired>
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
                                <button type="submit" class="btn btn-success">&nbsp;&nbsp;Submit&nbsp;&nbsp;</button>
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


<!-- Modal -->
<div class="modal fade" id="subjectSelectionModal" aria-labelledby="subjectSelectionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subjectSelectionModalLabel">Subject Selection</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>Compulsory Subjects</h6>
        <div id="requiredSubjectsArea">
                                             
        </div>
        <br>
        <h6>Select Optional Subjects</h6>
        <div id="optionalSubjectSelect1">

        </div>
        <br>
        <div id="optionalSubjectSelect2">

        </div>
        <br>
        <div id="optionalSubjectSelect3">

        </div>
        <br>
        <h6>Select 4th Subject</h6>
        <div id="fourthSubjectSelect">

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modalCloseBtn">OK</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    
window.addEventListener('DOMContentLoaded', function() {

    var authToken = 'h23ry3f5con72yr78cr5y2nr5q3n5';

    var admissionClassSelect = html('#admissionClassSelect');
    var admissionSessionSelect = html('#admissionSessionSelect');
    var classSelectNextStep = html('#classSelectNextStep');
    var admissionForm = html('#admissionForm');
    var studentPictureSelect = html('#studentPictureSelect');
    var studentPasswordInput = html('#studentPasswordInput');
    var studentConfirmPasswordInput = html('#studentConfirmPasswordInput');
    var studentGroupSelect = html('#studentGroupSelect');
    var subjectSelectArea = html('#subjectSelectArea');
    var subjectSelectBtn = html('#subjectSelectBtn');
    var subjectSelectionModal = new bootstrap.Modal(html('#subjectSelectionModal'), {
            keyboard: false
    });
    var requiredSubjectsArea = html('#requiredSubjectsArea');
    var optionalSubjectSelect = [
        html('#optionalSubjectSelect1'),
        html('#optionalSubjectSelect2'),
        html('#optionalSubjectSelect3')
    ];
    var fourthSubjectSelect = html('#fourthSubjectSelect');


    var gotoNextStep = function(e) {
        if (admissionClassSelect.value == 0 || admissionSessionSelect.value == 0) {
            // is admission opened

            
            classSelectNextStep.style.display = 'none';
        } else {
            classSelectNextStep.style.display = 'block';
        }
    };
    admissionClassSelect.addEventListener('change', gotoNextStep);
    admissionSessionSelect.addEventListener('change', gotoNextStep);

    studentGroupSelect.addEventListener('change', e => {
        e.preventDefault();
        if (e.target.value > 0) {
            subjectSelectArea.style.display = 'block';
            subjectSelectArea.removeAttribute('style');
            // fetch specific subjects
            xhr({
                method: 'POST',
                url: '<?= CONFIG['base_url'] ?>/admission/get_selectable_subjects',
                headers: {
                    'Content-Type': 'application/json'
                },
                postBody: JSON.stringify({
                    'classId': admissionClassSelect.value,
                    'groupId': studentGroupSelect.value
                }),
                async: false,
                onload: function (xhr) {
                    if (xhr.status == 200) {
                        var resp = JSON.parse(xhr.responseText);
                        if (resp.status == 'success') {
                            var subjects = JSON.parse(resp.message);

                            requiredSubjectsArea.innerHTML = '';
                            optionalSubjectSelect[0].innerHTML = '';
                            requiredSubjectsArea.innerHTML += '<ul>';

                            var optSelect = document.createElement('select');
                            optSelect.classList.add('form-control');

                            var fourthSelect = optSelect.cloneNode(true);
                            fourthSelect.name = 'student4thSubjectSelect';
                            fourthSelect.id = 'student4thSubjectSelect';

                            let subject1stOpt = document.createElement('option');
                            subject1stOpt.value = 0;
                            subject1stOpt.innerText = 'Select';

                            optSelect.appendChild(subject1stOpt.cloneNode(true));
                            fourthSelect.appendChild(subject1stOpt.cloneNode(true));

                            for (let i = 0 ; i < subjects.length; i++) {
                                    
                                var subjectOpt = document.createElement('option');
                                subjectOpt.value = subjects[i]['ID'];
                                subjectOpt.innerText = subjects[i]['subject_title'] + ' ('+ subjects[i]['subject_code'] +')';
                                
                                if (subjects[i]['subject_is_optionalable']) {
                                    optSelect.appendChild(subjectOpt.cloneNode(true));
                                } 
                                if (subjects[i]['subject_is_4th_subjectable']) {
                                    fourthSelect.appendChild(subjectOpt.cloneNode(true));
                                } 
                                if (!subjects[i]['subject_is_optionalable'] && !subjects[i]['subject_is_4th_subjectable']) {
                                    requiredSubjectsArea.innerHTML += '<li>' + subjects[i]['subject_title'] + ' ('+ subjects[i]['subject_code'] +')</li>';
                                }
                            }
                            for (let i = 0; i < optionalSubjectSelect.length; i++) {
                                optionalSubjectSelect[i].innerHTML = '';
                                var newOptSelect = optSelect.cloneNode(true);
                                newOptSelect.name = 'studentOptionalSubjectSelect' + (i+1);
                                newOptSelect.id = 'studentOptionalSubjectSelect' + (i+1);
                                optionalSubjectSelect[i].appendChild(newOptSelect);
                            }

                            fourthSubjectSelect.innerHTML = '';
                            fourthSubjectSelect.appendChild(fourthSelect);

                            requiredSubjectsArea.innerHTML += '</ul>';

                        }
                    }
                }

            });
        } else {
            subjectSelectArea.style.display = 'none';
        }
    });

    subjectSelectBtn.addEventListener('click', e => {
        e.preventDefault();
        subjectSelectionModal.show();
    });

    html('#modalCloseBtn').onclick = () => {
        subjectSelectionModal.hide()
    };


    // form submit event
    admissionForm.addEventListener('submit', function(e) {
        e.preventDefault();

        submitLoader_show();

        var initFormData = new Promise(function(resolve, reject) {

            var formData = new FormData(admissionForm);
            var dataObj = {};
            dataObj['authToken'] = authToken;
            var emptyFields = [];
            var emptyFieldsIndex = 0;
            formData.forEach(function(value, key){
                // basic validation
                if ((value == '' 
                    || value == '0' )
                    && !html('input[name=\''+key+'\'], select[name=\''+key+'\']').hasAttribute('notrequired')
                ) {
                    emptyFields[emptyFieldsIndex++] = key;

                } 

                dataObj[key] = value;
            });

            
            if (emptyFields.length > 0) {
                reject({
                        'message': FORM_ERROR_MESSAGES['empty-fields'],
                        'highlightElements': emptyFields
                    });
            }

            
            var selectedSubjects = [
                optionalSubjectSelect[0].children[0].value,
                optionalSubjectSelect[1].children[0].value,
                optionalSubjectSelect[2].children[0].value,
                fourthSubjectSelect.children[0].value
            ];
            selectedSubjects.forEach((value, key) => {
                if (value == 0 || value == undefined || value == '') {
                    reject({
                        'message': 'Please choose your subjects',
                        'highlightElement': 'subjectSelectBtn'
                    });
                }
            });
            let findDuplicates = arr => arr.filter((item, index) => arr.indexOf(item) !== index);
            
            if (findDuplicates(selectedSubjects).length > 0) {
                reject({
                        'message': 'Please Select Unique Subjects',
                        'highlightElement': 'subjectSelectBtn'
                    });
            }

            dataObj['studentSelectedSubjects'] = selectedSubjects;

            dataObj['admissionClassSelectName'] = html('#admissionClassSelect option')[admissionClassSelect.value].innerHTML;
            dataObj['admissionClassSelectId'] = admissionClassSelect.value;


            if (studentPasswordInput.value !== studentConfirmPasswordInput.value) {

                reject({
                        'message': FORM_ERROR_MESSAGES['confirmation-password-mismatch'],
                        'highlightElement': 'studentConfirmPasswordInput'
                    });

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
                        resolve(JSON.stringify(dataObj));
                    } else {
                        reject(
                            
                        );
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
                    reject('unable to read image file! please use an updated browser');  
                }
                freader.readAsBinaryString(studentPictureSelect.files[0]);
            
            } else {

                reject({
                            'message': 'Please select a photo (max ' + MAX_PHOTO_UPLOAD_SIZE + ' MegaByte)',
                            'highlightElement': 'studentPictureSelect'
                        });
            }

        });


        initFormData.then(
            function (formData) {
                setErrorHighlighDefault();
                admission_form_ajax(formData);
                submitLoader_hide();
            },
            function (err) {
                alert('Error: ' + err['message']);
                console.log(err);
                setErrorHighlighDefault();
                if (err['highlightElement'] != undefined) {
                    setErrorHighligh(err['highlightElement']);
                }
                if (err['highlightElements'] != undefined) {
                    for (let i in err['highlightElements']) {
                        setErrorHighligh(err['highlightElements'][i]);
                    }
                }
                submitLoader_hide();
            }
        );  

    });

    function setErrorHighlighDefault() {
        var elements = [];

        (new FormData(admissionForm)).forEach(function(value, key) {
            elements.push(key);
        });
        
        elements.push('subjectSelectBtn');
        elements.forEach((value) => {
            document.getElementById(value).style.borderColor = '#ced4da';
            document.getElementById(value).style.backgroundColor = '#fff';
        })
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


    function admission_form_ajax(data) {
        xhr({
            method: 'POST',
            url: '<?= CONFIG['base_url'] ?>/admission-submit',
            onload: function(xhr) {
                submitLoader_hide();
                if (xhr.status == 200) {
                    let resp = xhr.responseText;
                    try {
                        resp = JSON.parse(resp)
                        if (resp.status == 'success') {
                            window.location = resp.loadPage;
                        } else {
                            alert(resp.message);
                        }
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


