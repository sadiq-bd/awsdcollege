<div class="container-fluid">
    <div class="row" id="allContainer">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Notices</h1>
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
                <div class="col-md-2"></div>
                <div class="col-md-8">

                    <form class="container" method="post" id="instituteInfoUpdate">

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Update Notice Headline</span></div>
                                    <input type="text" class="form-control" name="institute_update_notice" value="<?= $siteOptions['institute_update_notice'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="text-right">
                                    <button class="btn btn-success">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>

                    </form>

                    <br><br>

                    
                    <form class="container" method="post" id="addNoticeForm">
                        <h4>Add Notice</h4>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Title</span></div>
                                    <input type="text" class="form-control" name="notice_title" value="<?= '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Body</span></div>
                                    <textarea class="form-control" name="notice_body" rows="5"></textarea>
                                </div>
                                
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Date</span></div>
                                    <input type="date" class="form-control" name="notice_date" value="<?= date('Y-m-d') ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Attachments</span></div>
                                    <input type="file" multiple="true" class="form-control" name="notice_attachment_file" id="notice_attachment_file">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="text-right">
                                    <button class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="col-md-2"></div>
            </div>
            <br>
            <div class="row mt-4">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="container">
                        <?php
                            foreach($notices as $notice) {
                        ?>
                        <div class="row mb-2 p-4 border" 
                        onclick="window.location = '<?= CONFIG['base_url'] ?>/admin/settings/notices/<?= $notice['notice_unique_id'] ?>';">
                            <div class="col-10">
                                <h6><?= $notice['notice_title'] ?></h6>
                                <p><?php 
                                    if (strlen($notice['notice_body']) > 100) {
                                        echo substr($notice['notice_title'], 0, 100) . '...';
                                    } else {
                                        echo $notice['notice_title'];
                                    }
                                ?></p>
                            </div>
                            <div class="col-2" ><span class="badge badge-primary badge-pill"><?= date('d M y', strtotime('22 Feb 2023')) ?></span></div>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="row mt-4 mb-2">
                                        
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
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        
        </div>
        
        </main>
    </div>
</div>


<script>

    window.addEventListener('DOMContentLoaded', function() {

        var updateForm = html('#instituteInfoUpdate');
        updateForm.addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(updateForm);
            var dataObj = {};
            formData.forEach(function(value, key) {
                dataObj[key] = value;
            });

            xhr({
                url: '<?= CONFIG['base_url'] ?>/admin/settings/institute_basic/update',
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
                            alert('Notice Headline Updated Successfully');
                        }

                        return true;
                    }

                    alert('Unable to update Notice Headline ');
                }, headers: {
                    'Content-Type': 'application/json'
                }, postBody: JSON.stringify(dataObj),
                async: true
            });

        });


        
        var addNoticeForm = html('#addNoticeForm');
        addNoticeForm.addEventListener('submit', function (e) {
        
            e.preventDefault();
            var noticeAttachmentFile = document.getElementById('notice_attachment_file');
            
            var formData = new FormData(addNoticeForm);
            var dataObj = {};
                

            addNoticeFormInit = new Promise(function(resolve, reject) {

                formData.forEach(function(value, key) {
                    dataObj[key] = value;
                });

                if (noticeAttachmentFile.value != '') {
                    var j = 0;
                    for (var i = 0; i < noticeAttachmentFile.files.length; i++) {
                        (function(file) {
                            var freader = new FileReader();
                            freader.addEventListener('load', function(e) {

                                dataObj['notice_attachment_file'][j++] = {
                                    name: file.name,
                                    size: file.size,
                                    type: file.type,
                                    data: window.btoa(freader.result)
                                };
                                if (i === j) {
                                    resolve(dataObj);
                                }
                            });
                            freader.onerror = function (e) {
                                reject('unable to read file');
                            };
                            freader.readAsBinaryString(file);
                        })(noticeAttachmentFile.files[i]);
                    }
                } else {
                    resolve(dataObj);
                }

            });

            addNoticeFormInit.then(function(data) {
                xhr({
                    url: '<?= CONFIG['base_url'] ?>/admin/settings/notices/add',
                    method: 'POST',
                    onload: function(xhr) {
                        if (xhr.status == 200) {
                            let resp = xhr.responseText;
                            try {
                                resp = JSON.parse(resp);
                            } catch (error) {
                                return alert(error);
                            }
                            if (resp.status !== 'success') {
                                alert(resp.message);
                                return;
                            }

                            //addNoticeForm.reset();
                            window.location.reload();
                            return true;
                        }

                        alert('Unable to add notice');
                    }, headers: {
                        'Content-Type': 'application/json'
                    }, postBody: JSON.stringify(data),
                    async: true
                });

            }, function (err) {
                alert(err);
            });
            
        });

    });

</script>

