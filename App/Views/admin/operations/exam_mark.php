<div class="container-fluid">
  <div class="row" id="allContainer">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" >
        <div class="container mt-4">
          <h4>Mark Distrubution</h4>
          <div class="row mt-4">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                
                <form action="">

                  <div class="form-group">
                    <select name="examSelect" id="examSelectId" class="form-select">
                      <option value="0">Select Exam</option>
                      <?php
                        map($exams, function($value, $key) {
                          return '<option value="'.$value['ID'].'">'.$value['exam_title'].' ('.$value['class_name'].' - '.$value['exam_year'].')</option>';
                        });
                      ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <select name="subjectSelect" id="subjectSelectId" class="form-select">
                      <option value="0">Select Subject</option>
                      <?php
                        map($subjects, function($value, $key) {
                          return '<option value="'.$value['ID'].'">'.$value['subject_title'].' ('.$value['subject_code'].')</option>';
                        });
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <input name="rollInput" type="text" class="form-control" placeholder="Student Roll or Roll Range (eg. 1-20)">
                  </div>
                  <button type="submit" class="btn btn-outline-success">Search</button>
                </form>
                <?php
                    if (isset($_GET['examSelect'])) {
                  ?>
                <script>
                  window.addEventListener('load', e => {
                    html('select[name=examSelect]').value = '<?= @$_GET['examSelect'] ?>';
                    html('select[name=subjectSelect]').value = '<?= @$_GET['subjectSelect'] ?>';
                    html('input[name=rollInput]').value = '<?= @$_GET['rollInput'] ?>';
                  });
                </script>
                <?php
                    }
                ?>
            </div>
            <div class="col-md-4"></div>
          </div>
        </div>

        <br><br>
        <div class="container">
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <table class="table">
                <thead>
                  <tr>
                    <td>UID</td>
                    <td>Roll</td>
                    <td>Name</td>
                    <td>Father</td>
                    <td>Mother</td>
                    <td>CQ</td>
                    <td>MCQ</td>
                    <td>Practical</td>
                    <td>Total</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    
                    map($resultingList, function($value, $key) use (&$studentsIds) {
                  ?>
                  <tr>
                    <td><?= $value['student_unique_id'] ?> </td>
                    <td><?= $value['student_roll'] ?></td>
                    <td><?= $value['student_full_name'] ?></td>
                    <td><?= $value['student_father_name'] ?></td>
                    <td><?= $value['student_mother_name'] ?></td>
                    <td>
                      <input type="number" class="form-control" name="cq" value="<?= $value['student_cq_mark'] ?>" data-std-id="<?= $value['studentId'] ?>">
                    </td>
                    <td>
                      <input type="number" class="form-control" name="mcq" value="<?= $value['student_mcq_mark'] ?>" data-std-id="<?= $value['studentId'] ?>">
                    </td>
                    <td>
                      <input type="number" class="form-control" name="practical" value="<?= $value['student_practical_mark'] ?>" data-std-id="<?= $value['studentId'] ?>">
                    </td>
                    <td>
                      <input type="number" class="form-control" name="total" value="<?= $value['student_cq_mark'] + $value['student_mcq_mark'] + $value['student_practical_mark'] ?>" data-std-id="<?= $value['studentId'] ?>" disabled>
                      <input type="hidden" name="type" data-std-id="<?= $value['studentId'] ?>" value="<?= is_null($value['result_modified_at']) ? 'add' : 'edit' ?>" style="display: none;">
                    </td>
                  </tr>
                  <?php
                    });
                  ?>
                </tbody>
              </table>
              <br>
              <button class="btn btn-success" id="saveBtn">Save</button>
            </div>
            <div class="col-md-1"></div>
          </div>
        </div>


    </main>
  </div>
</div>


<script>
window.addEventListener('DOMContentLoaded', e => {


  var cqMarks = document.querySelectorAll('input[name=cq]');
  var mcqMarks = document.querySelectorAll('input[name=mcq]');
  var practicalMarks = document.querySelectorAll('input[name=practical]');
  var totalMarks = document.querySelectorAll('input[name=total]');
  var entryType = document.querySelectorAll('input[name=type]');

  var saveBtn = document.getElementById('saveBtn');

  var results = [];

  var evnts = ['focus', 'click', 'change', 'keyup'];
  for (var i = 0; i < evnts.length; i++) {
    
    for (let j = 0; j < cqMarks.length; j++) {
      cqMarks[j].addEventListener(evnts[i], e => {
        updateTotal(j);
      });
      mcqMarks[j].addEventListener(evnts[i], e => {
        updateTotal(j);
      });
      practicalMarks[j].addEventListener(evnts[i], e => {
        updateTotal(j);
      });
    }

  }


  saveBtn.addEventListener('click', e => {
    results = [];
    for (let i = 0; i < cqMarks.length; i++) {
      results.push({
        studentId: cqMarks[i].dataset.stdId,
        cq: parseInt(cqMarks[i].value == '' ? 0 : cqMarks[i].value),
        mcq: parseInt(mcqMarks[i].value == '' ? 0 : mcqMarks[i].value),
        practical: parseInt(practicalMarks[i].value == '' ? 0 : practicalMarks[i].value),
        total: parseInt(totalMarks[i].value == '' ? 0 : totalMarks[i].value),
        type: entryType[i].value
      });
    }

    xhr({
        url: '<?= CONFIG['base_url'] ?>/admin/operations/exam_mark_distribution/action?examId=' + html('select[name=examSelect]').value + '&subjectId=' + html('select[name=subjectSelect]').value,
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

            alert('Marks Updated');
            console.log(xhr.status);
        }, headers: {
            'Content-Type': 'application/json'
        }, postBody: JSON.stringify(results),
        async: true
    });


  });



  function updateTotal(i) {
    totalMarks[i].value = parseInt(cqMarks[i].value == '' ? 0 : cqMarks[i].value) 
        + parseInt(mcqMarks[i].value == '' ? 0 : cqMarks[i].value) 
        + parseInt(practicalMarks[i].value == '' ? 0 : cqMarks[i].value);
    return parseInt(totalMarks[i].value);
  }

});
</script>
