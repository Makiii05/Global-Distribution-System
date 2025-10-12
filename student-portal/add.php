<?PHP
require('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<?PHP 
require("components/head.php");
?>
<div class='container w-50 mt-5'>
    <div>
        <form action='sql/controller.php' method="POST">
        <?PHP if(isset($_POST['createStudent'])){ ?>
        <h1 class="fw-bolder mb-5">CREATE NEW DATA</h1>

                <b>Student Number</b>
                <input class='form-control mx-3 border-0 rounded-0 border-dark text-secondary border-bottom mb-5' type='text' name='studno' placeholder='Enter Student Number' required>
                <b>Student Name</b>
                <input class='form-control mx-3 border-0 rounded-0 border-dark text-secondary border-bottom mb-5' type='text' name='name' placeholder='Enter Student Name' required>
                <b>Gender</b>
                <select class='form-select mx-3 border-0 rounded-0 border-dark text-secondary border-bottom mb-5' name='gender'>
                    <option value='M'>Male</option>
                    <option value='F'>Female</option>
                </select>
                
                <b>Courses</b>
                <select class='form-select mx-3 border-0 rounded-0 border-dark text-secondary border-bottom mb-5' name='course_id' required>
                <?PHP 
                $courses = $conn->query("SELECT * FROM courses");
                while($course=$courses->fetch_assoc()){
                    echo "<option value='$course[course_id]'>$course[name]</option>";
                }
                echo "</select>";
                ?>
            <input type="submit" name="add" class="form-control fw-bolder bg-success text-light" value="Save Changes">
            <a href='student.php' type='button' class='form-control bg-dark btn fw-bolder text-light'>Cancel</a> 
        <?PHP }else if(isset($_POST['createCourse'])){ ?>
        <h1 class="fw-bolder mb-5">CREATE NEW DATA</h1>
            <b>Course Code</b>
            <input class='form-control mx-3 border-0 rounded-0 border-dark text-secondary border-bottom mb-5' type='text' name='code' value='' placeholder="Enter Course Code" required>
            <b>Course Name</b>
            <input class='form-control mx-3 border-0 rounded-0 border-dark text-secondary border-bottom mb-5' type='text' name='name' value='' placeholder="Enter Course Name" required>
            <input type="submit" name="add" class="form-control fw-bolder bg-success text-light" value="Save Changes">
            <a href='courses.php' type='button' class='form-control bg-dark btn fw-bolder text-light'>Cancel</a>    
        <?PHP }?>
        </form>
        <?PHP if(isset($_POST['createGrade'])) {?>
            <?PHP
            $student_name = '';
            $student_id = '';
            $semester = $_POST['semester_id'] ?? 1;
            $student_info = $conn->query("SELECT 
                s.student_id AS id,
                s.name AS name,
                c.name AS course,
                c.code AS code
                FROM students s
                JOIN courses c ON c.course_id=s.course_id
                WHERE student_id=$_POST[student_id]
                ");
            $result = $conn->query("SELECT
                sub.code AS code,
                sub.des AS des,
                sub.unit AS unit,
                ss.midterm AS midterm,
                ss.fcg AS fcg
                FROM student_subjects ss
                JOIN subjects sub ON ss.subject_id=sub.subject_id
                JOIN students s ON ss.student_id=s.student_id
                WHERE s.student_id = $_POST[student_id]
                AND ss.semester_id = $semester
                ");
            ?>
            <h1 class="fw-bolder mb-5">ADD STUDENT GRADE</h1>
            <?PHP
            while($row=$student_info->fetch_assoc()){
                echo "<div class='d-flex gap-3 my-2'>
                    <b>Name:</b> <p>$row[name]</p>
                </div>";
                echo "<div class='d-flex gap-3 my-2'>
                    <b>Course:</b> <p>$row[course]</p>
                </div>";
                $student_name = $row['name'];
                $student_id = $row['id'];
            }
            ?>
            <div class="d-flex gap-3 my-2">
                <b>Semester:</b>
                <form action="add.php" method="POST" id="semester_form">
                    <input type="hidden" name="createGrade">
                    <input type="hidden" name="student_id" value="<?= $_POST['student_id'] ?>">
                    <select name="semester_id" class="form-select" id="semester_select">
                        <?PHP
                        $semesters = $conn->query("SELECT * FROM semesters");
                        while($row=$semesters->fetch_assoc()){
                            echo "<option value='$row[semester_id]' ";
                            echo ($semester == $row['semester_id']) ? 'selected' : '';
                            echo ">$row[code]</option>";
                        }
                        ?>
                    </select>
                </form>
            </div>
            <table class="table table-striped table-hover overflow-scroll mt-2">
                <thead class="table-dark">
                    <th>Subject Code</th><th>Subject Name</th><th>Units</th><th>Midterm Grade</th><th>Final Course Grade</th><th></th>
                </thead>
                <tbody>
                    <?PHP
                    while($row=$result->fetch_assoc()){
                        $fcg= $row['fcg']??'No Grade';
                        $midterm= $row['midterm']??'No Grade';
                        echo "<tr>";
                        echo "<td>$row[code]</td>";
                        echo "<td>$row[des]</td>";
                        echo "<td>$row[unit]</td>";
                        echo "<td>$midterm</td>";
                        echo "<td>$fcg</td>";
                        echo "<td>
                        <button type='button' class='btn btn-dark ms-3' data-bs-toggle='modal' data-bs-target='#inputGradeModal'>
                            Input Grade
                        </button>
                        </td>";
                        require("components/input_grade_modal.php");
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="w-25 d-flex">
                <input type="button" name="add" class="form-control fw-bolder bg-dark text-light" value="Print">
                <a href='grade.php' type='button' class='form-control bg-dark btn fw-bolder text-light'>Cancel</a> 
            </div>
        <?PHP }?>
    </div>
</div>

<script>
    const semForm = document.getElementById("semester_form");
    const semSelect = document.getElementById("semester_select");
    semSelect.onchange = function () {
        semForm.submit();
    }
</script>