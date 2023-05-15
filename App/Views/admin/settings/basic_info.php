<div class="container-fluid">
    <div class="row" id="allContainer">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Institute Informations</h1>
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
                <div class="col-2"></div>
                <div class="col-8">

                    <form class="container" method="post" id="instituteInfoUpdate">

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Institute Name</span></div>
                                    <input type="text" class="form-control" name="institute_title" value="<?= $siteOptions['institute_title'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Institute EIIN</span></div>
                                    <input type="text" class="form-control" name="institute_eiin" value="<?= $siteOptions['institute_eiin'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Institute Bio</span></div>
                                    <input type="text" class="form-control" name="institute_bio" value="<?= $siteOptions['institute_bio'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Institute Contact Mobile</span></div>
                                    <input type="text" class="form-control" name="institute_contact_mobile" value="<?= $siteOptions['institute_contact_mobile'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Institute Contact Email</span></div>
                                    <input type="text" class="form-control" name="institute_contact_email" value="<?= $siteOptions['institute_contact_email'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Institute Address</span></div>
                                    <input type="text" class="form-control" name="institute_address" value="<?= $siteOptions['institute_address'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Institute Hotline</span></div>
                                    <input type="text" class="form-control" name="institute_hotline" value="<?= $siteOptions['institute_hotline'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="text-right">
                                    <button class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="col-2"></div>
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
                            alert('Institute Information Updated Successfully');
                        }

                        return true;
                    }

                    alert('Unable to update Institute Information');
                }, headers: {
                    'Content-Type': 'application/json'
                }, postBody: JSON.stringify(dataObj),
                async: true
            });

        });

    });

</script>

