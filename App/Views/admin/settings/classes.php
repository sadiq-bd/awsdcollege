<div class="container-fluid">
    <div class="row" id="allContainer">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Classes</h1>
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
                <div class="col-1"></div>
                <div class="col-4">
                    <form action="./classes/action" method="post" id="settingsForm">
                        <input type="hidden" name="action" value="add" style="display: none;">
                        <input type="hidden" name="actionValue" value="" style="display: none;">
                        <div class="form-group">
                            <input type="text" class="form-control" name="className" placeholder="Class Name">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" class="form-checkbox" name="classAdmissionStatus" id="admissionStatus">
                            &nbsp;&nbsp;<label for="admissionStatus">Admission Status</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" class="form-checkbox" name="classHasGroup" id="hasGroup">
                            &nbsp;&nbsp;<label for="hasGroup">Has Group</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="classMeta" placeholder="Comments">
                        </div>
                        <button type="submit" class="btn btn-success" id="formBtn">Add</button>
                        &nbsp;
                        <a href="javascript:void(0)" class="" id="cancelEditBtn" style="display: none;">Cancel Edit</a>
                    </form>
                </div>
                <div class="col-1"></div>
                <div class="col-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>S/N</td>
                                <td>Class</td>
                                <td>Admission</td>
                                <td>Has Group</td>
                                <td>Comment</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                map($classes, function($class, $i) {
                            ?>
                            <tr id="settings_<?= $class['ID'] ?>">
                                <td><?= ++$i ?></td>
                                <td><?= $class['class_name'] ?></td>
                                <td><?= $class['class_admission_status'] ? 'open' : 'close' ?></td>
                                <td><?= $class['class_has_group'] ? 'True' : 'False' ?></td>
                                <td><?= $class['class_meta'] ?></td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm" onclick="editSettings('settings_<?= $class['ID'] ?>', <?= $class['ID'] ?>)"><i class="fa fa-edit"></i></button>
                                    &nbsp;
                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteSettings(<?= $class['ID'] ?>)"><i class="fa fa-trash"></i></button>
                                    
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


            dataObj['classAdmissionStatus'] = (html('#admissionStatus').checked == true) ? 'true' : 'false';
            dataObj['classHasGroup'] = (html('#hasGroup').checked == true) ? 'true' : 'false';
            

            if (dataObj['className'] === '' || dataObj['className'] === undefined) {
                return false;
            }


            xhr({
                url: '<?= CONFIG['base_url'] ?>/admin/settings/classes/action',
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

                    alert('Unable to Add class');
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
            'className': nodeElements[1].innerHTML,   // index 0 is serial number
            'classAdmissionStatus': (nodeElements[2].innerHTML === 'open') ? true : false,
            'classHasGroup': (nodeElements[3].innerHTML === 'True') ? true : false,
            'classMeta': nodeElements[4].innerHTML
        };
        for (let i in fieldValues) {
            let inputElement = document.querySelector('input[name=\'' + i + '\']');
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
                url: '<?= CONFIG['base_url'] ?>/admin/settings/classes/action',
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

                    alert('Unable to delete class');
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

