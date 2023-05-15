<div class="container-fluid">
    <div class="row" id="allContainer">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Subjects</h1>
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
                    <div class="col-3">
                        <form action="./classes/action" method="post" id="settingsForm">
                            <input type="hidden" name="action" value="add" style="display: none;">
                            <input type="hidden" name="actionValue" value="" style="display: none;">
                            <div class="form-group">
                                <label for="subjectClassSelect">Select Class</label>
                                <select name="subjectClassId" id="subjectClassSelect" class="form-select">
                                    <option value="0">All</option>
                                    <?php
                                        map($classes, function($class){
                                            echo '<option value="' . $class['ID'] . '">'. $class['class_name'] .'</option>';
                                        });
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subjectGroupSelect">Select Group</label>
                                <select name="subjectGroupId" id="subjectGroupSelect" class="form-select">
                                    <option value="0">All</option>
                                    <?php
                                        map($groups, function($group){
                                            echo '<option value="' . $group['ID'] . '">'. $group['group_title'] .'</option>';
                                        });
                                    ?>
                                </select>
                            </div>
                            <?php
                                if (!empty($_GET['filter'])) {
                                    $filter = explode(',', $_GET['filter']);
                            ?>
                            <script>
                                window.addEventListener('load', e => {
                                    html('#subjectClassSelect').value = '<?= @$filter[0] ?>';
                                    html('#subjectGroupSelect').value = '<?= @$filter[1] ?>';
                                })
                            </script>
                            <?php
                                }
                            ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subjectTitle" placeholder="Subject Name">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="subjectCode" placeholder="Subject Code">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="subjectCqMark" placeholder="CQ Mark">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="subjectMcqMark" placeholder="MCQ Mark">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="subjectPracticalMark" placeholder="Practicle Mark">
                            </div>
<!-- <label for="subjectTypeSelect">Select Type</label>
                                <select name="subjectType" id="subjectTypeSelect" class="form-select">
                                    <option value="0">Compulsory</option>
                                    <option value="1">Optionalable</option>
                                    <option value="2">4th Subjectable</option>
                                </select>
                                 -->
                            <div class="form-group">
                                <input class="form-checkbox" type="checkbox" name="subjectIsOptionalable" id="subjectIsOptionalableCheckbox">&nbsp;&nbsp;
                                <label for="subjectIsOptionalableCheckbox">Is Optionalable</label>
                            </div>
                            <div class="form-group">
                                <input class="form-checkbox" type="checkbox" name="subjectIs4thSubjectable" id="subjectIs4thSubjectableCheckbox">&nbsp;&nbsp;
                                <label for="subjectIs4thSubjectableCheckbox">Is 4th Subjectable</label>
                            </div>

                            <button type="submit" class="btn btn-success" id="formBtn">Add</button>
                            &nbsp;
                            <a href="javascript:void(0)" class="" id="cancelEditBtn" style="display: none;">Cancel Edit</a>
                        </form>
                    </div>
                    <div class="col-9">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>S/N</td>
                                    <td>Class</td>
                                    <td>Group</td>
                                    <td>Code</td>
                                    <td>Title</td>
                                    <td>CQ</td>
                                    <td>MCQ</td>
                                    <td>Practical</td>
                                    <td>Is Optionalable</td>
                                    <td>Is 4th Subjectable</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    map($subjects, function($subject, $i) use($classes, $groups) {
                                ?>
                                <tr id="settings_<?= $subject['ID'] ?>">
                                    <td><?= ++$i ?></td>
                                    <td data-target-value="<?= $subject['subject_class_id'] ?>"><?= $subject['subject_class_id'] == 0 ? '<i>All</i>' : $classes[$subject['subject_class_id']]['class_name'] ?></td>
                                    <td data-target-value="<?= $subject['subject_group_id'] ?>"><?= $subject['subject_group_id'] == 0 ? '<i>All</i>' : $groups[$subject['subject_group_id']]['group_title'] ?></td>
                                    <td><?= $subject['subject_code'] ?></td>
                                    <td><?= $subject['subject_title'] ?></td>
                                    <td><?= $subject['subject_cq_mark'] ?></td>
                                    <td><?= $subject['subject_mcq_mark'] ?></td>
                                    <td><?= $subject['subject_practical_mark'] ?></td>
                                    <td><?= $subject['subject_is_optionalable'] ? 'True' : 'False' ?></td>
                                    <td><?= $subject['subject_is_4th_subjectable'] ? 'True' : 'False' ?></td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm" onclick="editSettings('settings_<?= $subject['ID'] ?>', <?= $subject['ID'] ?>)"><i class="fa fa-edit"></i></button>
                                        &nbsp;
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteSettings(<?= $subject['ID'] ?>)"><i class="fa fa-trash"></i></button>
                                        
                                    </td>
                                </tr>
                                <?php
                                    });
                                    
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-1"></div>

                </div>

            </div>

        </main>
    </div>
</div>


<script>

    window.addEventListener('DOMContentLoaded', function() {

        var settingsForm = html('#settingsForm');
        var formBtn = html('#formBtn');
        var cancelEditBtn = html('#cancelEditBtn');
        

        settingsForm.addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(settingsForm);
            var dataObj = {};
            formData.forEach(function(value, key) {
                dataObj[key] = value;
            });

            dataObj['subjectIsOptionalable'] = html('#isOptionalable').checked == true ? 'true' : 'false';
            

            if (dataObj['subjectTitle'] === '' || dataObj['subjectTitle'] === undefined) {
                return false;
            }
            if (dataObj['subjectCode'] === '' || dataObj['subjectCode'] === undefined) {
                return false;
            }
            if (dataObj['subjectCqMark'] === '' || dataObj['subjectCqMark'] === undefined) {
                dataObj['subjectCqMark'] = 0;
            }
            if (dataObj['subjectMcqMark'] === '' || dataObj['subjectMcqMark'] === undefined) {
                dataObj['subjectMcqMark'] = 0;
            }
            if (dataObj['subjectPracticalMark'] === '' || dataObj['subjectPracticalMark'] === undefined) {
                dataObj['subjectPracticalMark'] = 0;
            }

            dataObj['subjectIsOptionalable'] = 'false';
            if (html('#subjectIsOptionalableCheckbox').checked) {
                dataObj['subjectIsOptionalable'] = 'true';
            }

            dataObj['subjectIs4thSubjectable'] = 'false';
            if (html('#subjectIs4thSubjectableCheckbox').checked) {
                dataObj['subjectIs4thSubjectable'] = 'true';
            }


            xhr({
                url: '<?= CONFIG['base_url'] ?>/admin/settings/subjects/action',
                method: 'POST',
                onload: function(xhr) {
                    if (xhr.status == 200) {
                        let resp = xhr.responseText;
                        try {
                            resp = JSON.parse(resp);
                        } catch (error) {
                            return alert(error);
                        }
                        if (resp.status == 'success') {
                            window.location.reload();
                        }

                        return true;
                    }

                    alert('Unable to Add Section');
                    console.log(xhr.status);
                }, headers: {
                    'Content-Type': 'application/json'
                }, postBody: JSON.stringify(dataObj),
                async: true
            });

        });

        cancelEditBtn.addEventListener('click', e => {
            e.preventDefault();
            settingsFromReset();
            cancelEditBtn.style.display = 'none';
            formBtn.innerHTML = 'Add';
        });

        html('#subjectClassSelect').addEventListener('change', e => {
            e.preventDefault();
            if (cancelEditBtn.style.display == 'none')
                window.location.href = '<?= CONFIG['base_url'] ?>/admin/settings/subjects?filter=' + e.target.value + ',' + html('#subjectGroupSelect').value;
        });

        html('#subjectGroupSelect').addEventListener('change', e => {
            e.preventDefault();
            if (cancelEditBtn.style.display == 'none')
                window.location.href = '<?= CONFIG['base_url'] ?>/admin/settings/subjects?filter=' + html('#subjectClassSelect').value + ',' + e.target.value;
        });

    });


    function settingsFromReset() {
        var settingsForm = document.getElementById('settingsForm');
        settingsForm.reset();
        document.querySelector('input[name=action]').value = 'add';
        document.querySelector('input[name=actionValue]').value = '';
    }


    function editSettings(tempId, mainID) {
        var nodeElements = document.querySelectorAll('#' + tempId + ' td');
        var fieldValues = {
            'subjectClassId': nodeElements[1].dataset.targetValue,   // index 0 is serial number
            'subjectGroupId': nodeElements[2].dataset.targetValue,
            'subjectTitle': nodeElements[4].innerHTML,
            'subjectCode': nodeElements[3].innerHTML,
            'subjectCqMark': nodeElements[5].innerHTML,
            'subjectMcqMark': nodeElements[6].innerHTML,
            'subjectPracticalMark': nodeElements[7].innerHTML,
            'subjectIsOptionalable': nodeElements[8].innerHTML == 'True' ? true : false,
            'subjectIs4thSubjectable': nodeElements[9].innerHTML == 'True' ? true : false
        };

        for (let i in fieldValues) {
            let inputElement = document.querySelector('input[name=\'' + i + '\'], select[name=\'' + i + '\']');
            if (inputElement.type == 'checkbox') {
                if (fieldValues[i]) { 
                    inputElement.checked = true;
                } else {
                    inputElement.checked = false;
                }
            } else {
                inputElement.value = fieldValues[i];
            }
        }
        document.querySelector('input[name=action]').value = 'edit';
        document.querySelector('input[name=actionValue]').value = mainID;
        cancelEditBtn.style.display = 'block';
        formBtn.innerHTML = 'Update';
    }

    function deleteSettings (mainID) {
        if (confirm('Are you sure want to delete?')) {
            xhr({
                url: '<?= CONFIG['base_url'] ?>/admin/settings/subjects/action',
                method: 'POST',
                onload: function(xhr) {
                    if (xhr.status == 200) {
                        let resp = xhr.responseText;
                        try {
                            resp = JSON.parse(resp);
                        } catch (error) {
                            return alert(error);
                        }
                        if (resp.status == 'success') {
                            window.location.reload();
                        }

                        return true;
                    }

                    alert('Unable to delete section');
                    console.log(xhr.status);
                }, headers: {
                    'Content-Type': 'application/json'
                }, postBody: JSON.stringify({
                    action: 'delete',
                    actionValue: mainID
                }),
                async: true
            });

        }
    }
        
</script>

