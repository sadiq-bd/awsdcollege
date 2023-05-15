<div class="container-fluid">
    <div class="row" id="allContainer">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Sections</h1>
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
                    <form action="./sections/action" method="post" id="settingsForm">
                        <input type="hidden" name="action" value="add" style="display: none;">
                        <input type="hidden" name="actionValue" value="" style="display: none;">
                        <div class="form-group">
                            <label for="sectionClassSelect">Select Class</label>
                            <select name="sectionClassId" id="sectionClassSelect" class="form-select">
                                <option value="0">All</option>
                                <?php
                                map($classes, function($class){
                                    echo '<option value="' . $class['ID'] . '">'. $class['class_name'] .'</option>';
                                });
                                if (!empty($_GET['filter'])) {
                                ?>
                                    <script>
                                    window.addEventListener('load', e=> {
                                        html('#sectionClassSelect').value = '<?= $_GET['filter'] ?>';
                                    });
                                    </script>
                                <?php
                                }
                                ?>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="sectionTitle" placeholder="Section Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="sectionMeta" placeholder="Comments">
                        </div>
                        <button type="submit" class="btn btn-success" id="formBtn">Add</button>
                        &nbsp;
                        <a href="javascript:void(0)" class="" id="cancelEditBtn" style="display: none;">Cancel Edit</a>
                    </form>
                </div>
                <div class="col-1"></div>
                <div class="col-5">
                    <table class="table" id="settingsTable">
                        <thead>
                            <tr>
                                <td>S/N</td>
                                <td>Class</td>
                                <td>Section</td>
                                <td>Comment</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                map($sections, function($section, $i) use ($classes) {
                            ?>
                            <tr id="settings_<?= $section['ID'] ?>">
                                <td><?= ++$i ?></td>
                                <td data-target-value="<?= $section['section_class_id'] ?>"><?= (empty($section['section_class_id'])) ? '<i>All</i>' : $classes[$section['section_class_id']]['class_name'] ?></td>
                                <td><?= $section['section_title'] ?></td>
                                <td><?= $section['section_meta'] ?></td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm" onclick="editSettings('settings_<?= $section['ID'] ?>', <?= $section['ID'] ?>)"><i class="fa fa-edit"></i></button>
                                    &nbsp;
                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteSettings(<?= $section['ID'] ?>)"><i class="fa fa-trash"></i></button>
                                    
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
            

            if (dataObj['sectionClassId'] === '' || dataObj['sectionClassId'] === undefined) {
                return false;
            }
            if (dataObj['sectionTitle'] === '' || dataObj['sectionTitle'] === undefined) {
                return false;
            }


            xhr({
                url: '<?= CONFIG['base_url'] ?>/admin/settings/sections/action',
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

        html('#sectionClassSelect').addEventListener('change', e => {
            e.preventDefault();
            if (cancelEditBtn.style.display == 'none')
                window.location.href = '<?= CONFIG['base_url'] ?>/admin/settings/sections?filter=' + e.target.value;
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
            'sectionClassId': nodeElements[1].dataset.targetValue,   // index 0 is serial number
            'sectionTitle': nodeElements[2].innerHTML,
            'sectionMeta': nodeElements[3].innerHTML
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
                url: '<?= CONFIG['base_url'] ?>/admin/settings/sections/action',
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

