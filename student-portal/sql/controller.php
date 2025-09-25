<?PHP
include("../conn.php");

// create
if(isset($_POST["add"])){
    if(isset($_POST["studno"])){
        $studno = $_POST["studno"];
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $course = $_POST["course_id"];

        // check if existing studno
        $checkIfExisting = $conn->query("SELECT * FROM students WHERE student_no = $studno");
        if(mysqli_num_rows($checkIfExisting) >= 1){
            header("location:../student.php?error=2");
            exit;
        }

        $sql = "INSERT INTO students (student_no, name, gender, course_id) VALUES ('$studno','$name','$gender','$course')";
        $result = $conn->query($sql);
        header("location:../student.php");
    }else if(isset($_POST["code"])){
        $code = $_POST["code"];
        $name = $_POST["name"];

        // check if existing studno
        $checkIfExisting = $conn->query("SELECT * FROM courses WHERE code = '$code'");
        if(mysqli_num_rows($checkIfExisting) >= 1){
            header("location:../courses.php?error=2");
            exit;
        }

        $sql = "INSERT INTO courses (code, name) VALUES ('$code','$name')";
        $result = $conn->query($sql);
        header("location:../courses.php");

    }
}

// edit
if(isset($_POST["edit"])){
    if(isset($_POST["studentEdit"])){
        $id = $_POST["studentEdit"];
        $studno = $_POST["studno"];
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $course = $_POST["course_id"];
        $sql = "UPDATE students SET student_no = '$studno', name = '$name', gender = '$gender', course_id = '$course' WHERE student_id = '$id'";
        $result = $conn->query($sql);
        header("location:../student.php");
    }else if (isset($_POST["coursesEdit"])){
        $id = $_POST["coursesEdit"];
        $code = $_POST["code"];
        $name = $_POST["name"];
        $sql = "UPDATE courses SET code = '$code', name = '$name' WHERE course_id = '$id'";
        $result = $conn->query($sql);
        header("location:../courses.php");
    }
}

// delete
if(isset($_POST["delete"])){
    $table = $_POST["from"];
    $id = $_POST["delete"];
    $where = ($table == "students") ? "student_id": "course_id";
    
    //check if course, if use in students
    if($table == "courses"){
        $checkIfExisting = $conn->query("SELECT * FROM students WHERE course_id = $id");
        if(mysqli_num_rows($checkIfExisting) >= 1){
            header("location:../courses.php?error=1");
            exit;
        }
    }
    $sql = "DELETE FROM $table WHERE $where = $id";
    $result = $conn->query($sql);
    ($table == "students") ? header("location:../student.php") : header("location:../courses.php");
    
}

//signin
if(isset($_POST["signin"])){

}