

<div class="container">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h3><?= ucfirst($loginType) ?>&nbsp;Login</h3>
            <form id="loginForm">
                <div id="msgContainer"></div>
                <div class="pt-2 pb-2">
                    <input type="text" class="form-control" placeholder="<?= ucfirst($loginType) ?> ID" id="username">
                </div>
                <div class="pt-2 pb-2">
                    <input type="password" class="form-control" placeholder="Password" id="password">
                </div>
                <div class="pt-2 pb-2">
                    <button class="btn btn-outline-primary btn-block" type="submit" id="submitBtn">Login</button>
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>

<script type="text/javascript">
    var loginForm = html('#loginForm');
    var msgContainer = html('#msgContainer');
    var submitBtn = html('#submitBtn');
    var submitBtnTxt = submitBtn.innerHTML;

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();

        setMessageTxt();

        var userData = {
            'username': document.querySelector('#username').value,
            'password': document.querySelector('#password').value,
            'loginType': '<?= $loginType ?>'
        };
        for (let i in userData) {
            if (userData[i] == undefined || userData[i] == '') {
                setMessageTxt('All fields must be filled out!');
                // empty field error
                return false;
            }
        }

        submitBtn.innerHTML = '<div class="spinner-border"></div>'

        xhr({
            url: '<?= CONFIG['base_url'] ?>/login/<?= $loginType ?>',
            method: 'POST',
            async: true,
            onload: function (xhr) {
                if (xhr.status > 0) {
                    let resp = xhr.responseText;
                    resp = JSON.parse(resp);

                    submitBtn.innerHTML = submitBtnTxt;

                    if (resp.statusCode == 200) {
                        setMessageTxt('Login Success...', 'success');      
                        window.location = resp.loadPage;
                    } else {
                        setMessageTxt(resp.message);
                    }
                    
                }
            },
            postBody: JSON.stringify(userData)
        });

        return false;
    });

    function setMessageTxt(txt, status) {
        var msgContainer = html('#msgContainer');
        status = (typeof status != 'undefined') ? status : 'danger';
        if (txt === '' || txt === undefined || txt === null) {
            msgContainer.classList.remove('small', 'pt-2', 'pb-2', 'alert', 'alert-danger');
            msgContainer.innerHTML = ''; 
        } else {
            msgContainer.classList.add('small', 'pt-2', 'pb-2', 'alert', 'alert-' + status);
            msgContainer.innerHTML = txt; 
            // setTimeout(function() {
            //     setMessageTxt();
            // }, 4000);
        }
    }
</script>


