<?PHP
require("conn.php");
if(isset($_POST['student_no'])){
    
    $student_name = "";
    $student_course = "";
    $student_code = "";
    $student_id = "";
    $student_info = $conn->query("SELECT 
        s.student_id AS id,
        s.name AS name,
        c.name AS course,
        c.code AS code
        FROM students s
        JOIN courses c ON c.course_id=s.course_id
        WHERE student_no=$_POST[student_no]
        ");
    $sql = "SELECT
        sub.code AS code,
        sub.des AS des,
        sub.days AS day,
        sub.time AS time,
        r.name AS room,
        t.name AS teacher,
        sub.unit AS unit
        FROM student_subjects ss
        JOIN subjects sub ON ss.subject_id=sub.subject_id
        JOIN students s ON ss.student_id=s.student_id
        JOIN teachers t ON t.id = sub.teacher_id
        JOIN rooms r ON r.id = sub.room_id
        WHERE s.student_no = $_POST[student_no]
        ";
    if(isset($_POST['enroll'])){
        $student_id = $_POST['student_id'];
        $subject_id = $_POST['subject_id'];

        $check = $conn->query("SELECT * FROM student_subjects WHERE student_id = $student_id AND subject_id = $subject_id");

        if(mysqli_num_rows($check) == 0){
            $enroll = $conn->prepare("INSERT INTO student_subjects (student_id, subject_id) VALUES (?, ?)");
            $enroll->bind_param("ii", $student_id, $subject_id);
            $enroll->execute();
        }
    }
    $result=$conn->query($sql);
    if(mysqli_num_rows($student_info) != 1){
        header("Location:enroll.php?error=4");
    }else{
        while($info=$student_info->fetch_assoc()){
            $student_name = $info['name'];
            $student_course = $info['course'];
            $student_code = $info['code'];
            $student_id = $info['id'];
        }
    }
}
$student_list_query = $conn->query("
    SELECT 
        st.student_id AS id, 
        st.student_no AS studno,
        st.name AS name, 
        st.gender AS gender, 
        cr.name AS course_name 
    FROM students st 
    JOIN courses cr ON st.course_id = cr.course_id
");

$student_list = [];
?>
<!DOCTYPE html>
<html lang="en">
<?PHP 
require("components/head.php");
?>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?PHP
            require("components/sidebar.php");
            require("components/search_modal.php");
            ?>
            <div class="col py-3 d-flex flex-column">
                
                <div class="d-flex w-100">
                <h3>Enroll Student</h3>
                </div>

                <hr>
                <div class="mx-4 mb-auto">
                    <h5>Student # </h5>
                    <div class="d-flex gap-2">
                        <form action="enroll.php" method="POST" id="stud_no_form">
                            <input type="number" id="stud_no_input" class="mx-3 form-control" name="student_no" value="<?PHP echo isset($_POST['student_no']) ? $_POST['student_no'] : "" ?>">
                        </form>
                        <button type="button" class="btn btn-dark ms-3" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <hr>
                    <?PHP if(isset($_POST['student_no'])) { ?>

                    <div class="d-flex gap-3">
                        <b>Name:</b> <p><?= $student_name ?></p>
                    </div>
                    <div class="d-flex gap-3">
                        <b>Course:</b> <p><?= $student_code ?></p>
                    </div>
                    <table class="table table-striped table-hover overflow-scroll">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Subject Code</th>
                                <th scope="col">Description</th>
                                <th scope="col">Days</th>
                                <th scope="col">Time</th>
                                <th scope="col">Room</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP
                            while($row=$result->fetch_assoc()){
                                echo "<tr>
                                    <td>$row[code]</td>
                                    <td>$row[des]</td>
                                    <td>$row[day]</td>
                                    <td>$row[time]</td>
                                    <td>$row[room]</td>
                                    <td>$row[teacher]</td>
                                    <td>$row[unit]</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="m-2 mx-4">
                    <div class="">
                        <h5>Subjects</h5>
                        <form action="enroll.php" method="POST" class="d-flex mx-4 gap-3">
                            <input type="hidden" name="student_no" value="<?= $_POST['student_no'] ?? "" ?>">
                            <input type="hidden" name="student_id" value="<?= $student_id?>">
                            <select name="subject_id" class="form-select">
                                <?PHP
                                $sql = "
                                SELECT
                                    sub.subject_id AS id,
                                    sub.code AS code,
                                    sub.des AS des,
                                    sub.days AS day,
                                    sub.time AS time,
                                    r.name AS room,
                                    t.name AS teacher,
                                    sub.unit AS unit
                                FROM subjects sub
                                JOIN teachers t ON t.id = sub.teacher_id
                                JOIN rooms r ON r.id = sub.room_id
                                WHERE sub.subject_id NOT IN (
                                    SELECT subject_id FROM student_subjects WHERE student_id = $student_id
                                )
                                ";
                                $result=$conn->query($sql);
                                while($row=$result->fetch_assoc()){
                                    echo "<option value='$row[id]'>$row[code] -- $row[des] -- $row[day] -- $row[time] -- $row[room] -- $row[teacher]</option>";
                                }
                                ?>
                            </select>

                            <input type="submit" name="enroll" value="Enroll" class="btn bg-dark text-light">
                        </form>
                    </div>
                    <form action="print/p_stud_subs.php" method="POST" target="_blank" class="mx-4 mt-2">
                        <input type="hidden" name="student_no" value="<?= $_POST['student_no'] ?? "" ?>">
                        <input type="submit" value="Print" class="btn bg-dark text-light">
                    </form>
                </div>
                <?PHP } ?>
            </div>
        </div>
    </div>
</body>
<script>
    const studForm = document.getElementById('stud_no_form');
    const studInp = document.getElementById('stud_no_input');
    const studentList = <?= json_encode($student_list) ?>;
    const table = document.getElementById("student_list_table");
    const searchBy = document.getElementById("search_by");
    const searchByInput = document.getElementById("search_by_input");

    searchBy.onchange = search_student;
    searchByInput.oninput = search_student;

    function search_student() {
        const filterBy = searchBy.value;        
        const keyword = searchByInput.value.toLowerCase();

        table.innerHTML = "";

        const results = studentList.filter(stud => 
            stud[filterBy].toLowerCase().includes(keyword)
        );

        if (results.length === 0) {
            table.innerHTML = '<tr><td colspan="4" class="text-center text-muted">No matching students</td></tr>';
            return;
        }

        results.forEach(stud => {
            const row = `
                <tr>
                    <td>${stud.studno}</td>
                    <td>${stud.name}</td>
                    <td>${stud.course_name}</td>
                    <td>
                        <form action="enroll.php" method="POST">
                            <input type="hidden" name="student_no" value="${stud.studno}">
                            <button type="submit" class="btn border-dark">
                                <i class="bi bi-journal-plus p-1"></i>
                            </button>
                        </form>
                    </td>
                </tr>`;
            table.insertAdjacentHTML("beforeend", row);
        });
    }

    studInp.onchange = function () {
        studForm.submit();
    }
</script>

</html>