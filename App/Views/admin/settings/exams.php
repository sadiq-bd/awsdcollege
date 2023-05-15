<div class="container-fluid">
    <div class="row" id="allContainer">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Exams</h1>
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
                    <div class="col-4">
                        <form action="./classes/action" method="post" id="settingsForm">
                            <input type="hidden" name="action" value="add" style="display: none;">
                            <input type="hidden" name="actionValue" value="" style="display: none;">
                            <div class="form-group">
                                <label for="examClassSelect">Select Class</label>
                                <select name="examClassId" id="examClassSelect" class="form-select">
                                    <option value="0">Select</option>
                                    <?php
                                        map($classes, function($class){
                                            echo '<option value="' . $class['ID'] . '">'. $class['class_name'] .'</option>';
                                        });
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="examGroupSelect">Select Group</label>
                                <select name="examGroupId" id="examGroupSelect" class="form-select">
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
                                    html('#examClassSelect').value = '<?= @$filter[0] ?>';
                                    html('#examGroupSelect').value = '<?= @$filter[1] ?>';
                                })
                            </script>
                            <?php
                                }
                            ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="examTitle" placeholder="Exam Title">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="examYear" placeholder="Year">
                            </div>

                            <div class="form-group">
                                <label for="startDateInput">Start Date</label>
                                <input id="startDateInput" type="date" class="form-control" name="examStartDate" >
                            </div>
                            <div class="form-group">
                                <label for="endDateInput">End Date</label>
                                <input id="endDateInput" type="date" class="form-control" name="examEndDate" >
                            </div>

                            <div class="form-group">
                                <label for="examGradePointSelect">Grade Point Out of</label>
                                <select name="examGradePoint" id="examGradePointSelect" class="form-select">
                                    <option value="5">5.00</option>
                                    <option value="4">4.00</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input id="isResultPublishedCheckbox" type="checkbox" class="checkbox-control" name="examIsResultPublished" >
                                <label for="isResultPublishedCheckbox">Is Result Published</label>
                                
                            </div>

                            <button type="submit" class="btn btn-success" id="formBtn">Add</button>
                            &nbsp;
                            <a href="javascript:void(0)" class="" id="cancelEditBtn" style="display: none;">Cancel Edit</a>
                        </form>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-7">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>S/N</td>
                                    <td>Class</td>
                                    <td>Group</td>
                                    <td>Title</td>
                                    <td>Year</td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>Grade Point</td>
                                    <td>Is Result Published</td>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    map($exams, function($exam, $i) use ($classes, $groups) {
                                ?>
                                <tr id="settings_<?= $exam['ID'] ?>">
                                    <td><?= ++$i ?></td>
                                    <td data-target-value="<?= $exam['exam_class_id'] ?>"><?= $exam['exam_class_id'] == 0 ? '<i>All</i>' : $classes[$exam['exam_class_id']]['class_name'] ?></td>
                                    <td data-target-value="<?= $exam['exam_group_id'] ?>"><?= $exam['exam_group_id'] == 0 ? '<i>All</i>' : $groups[$exam['exam_group_id']]['group_title'] ?></td>
                                    <td><?= $exam['exam_title'] ?></td>
                                    <td><?= $exam['exam_year'] ?></td>
                                    <td data-target-value="<?= $exam['exam_start_date'] ?>"><?= date('d/m/Y', strtotime($exam['exam_start_date'])) ?></td>
                                    <td data-target-value="<?= $exam['exam_end_date'] ?>"><?= date('d/m/Y', strtotime($exam['exam_end_date'])) ?></td>
                                    <td data-target-value="<?= $exam['exam_grade_point_out_of'] ?>"><?= $exam['exam_grade_point_out_of'] ?>.00</td>
                                    <td data-target-value="<?= $exam['exam_is_result_published'] ?>"><?= $exam['exam_is_result_published'] == 1 ? 'True' : 'False' ?></td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm" onclick="editSettings('settings_<?= $exam['ID'] ?>', <?= $exam['ID'] ?>)"><i class="fa fa-edit"></i></button>
                                        &nbsp;
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteSettings(<?= $exam['ID'] ?>)"><i class="fa fa-trash"></i></button>
                                        
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
        var isResultPublishedCheckbox = html('#isResultPublishedCheckbox');
        

        settingsForm.addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(settingsForm);
            var dataObj = {};
            formData.forEach(function(value, key) {
                dataObj[key] = value;
            });

            dataObj['examIsResultPublished'] = isResultPublishedCheckbox.checked ? 'true' : 'false';
            

            if (dataObj['examClassId'] === '' || dataObj['examClassId'] === undefined || dataObj['examClassId'] == '0') {
                alert('Select Exam Class');
                return false;
            }
            if (dataObj['examGroupId'] === '' || dataObj['examGroupId'] === undefined) {
                return false;
            }
            if (dataObj['examTitle'] === '' || dataObj['examTitle'] === undefined) {
                return false;
            }
            if (dataObj['examYear'] === '' || dataObj['examYear'] === undefined) {
                return false;
            }
            if (dataObj['examStartDate'] === '' || dataObj['examStartDate'] === undefined) {
                return false;
            }
            if (dataObj['examEndDate'] === '' || dataObj['examEndDate'] === undefined) {
                return false;
            }


            xhr({
                url: '<?= CONFIG['base_url'] ?>/admin/settings/exams/action',
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


        html('#examClassSelect').addEventListener('change', e => {
            e.preventDefault();
            if (cancelEditBtn.style.display == 'none')
                window.location.href = '<?= CONFIG['base_url'] ?>/admin/settings/exams?filter=' + e.target.value + ',' + html('#examGroupSelect').value;
        });

        html('#examGroupSelect').addEventListener('change', e => {
            e.preventDefault();
            if (cancelEditBtn.style.display == 'none')
                window.location.href = '<?= CONFIG['base_url'] ?>/admin/settings/exams?filter=' + html('#examClassSelect').value + ',' + e.target.value;
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
            'examClassId': nodeElements[1].dataset.targetValue,   // index 0 is serial number
            'examGroupId': nodeElements[2].dataset.targetValue,
            'examTitle': nodeElements[3].innerHTML,
            'examYear': nodeElements[4].innerHTML,
            'examStartDate': nodeElements[5].dataset.targetValue,
            'examEndDate': nodeElements[6].dataset.targetValue,
            'examGradePoint': nodeElements[7].dataset.targetValue,
            'examIsResultPublished': nodeElements[8].dataset.targetValue == 1 ? true : false
            
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
                url: '<?= CONFIG['base_url'] ?>/admin/settings/exams/action',
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

                    alert('Unable to delete exam');
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

