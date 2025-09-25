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
        <h1 class="fw-bolder mb-5">CREATE NEW DATA</h1>
        <?PHP if(isset($_POST['createStudent'])){ ?>

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
            <b>Course Code</b>
            <input class='form-control mx-3 border-0 rounded-0 border-dark text-secondary border-bottom mb-5' type='text' name='code' value='' placeholder="Enter Course Code" required>
            <b>Course Name</b>
            <input class='form-control mx-3 border-0 rounded-0 border-dark text-secondary border-bottom mb-5' type='text' name='name' value='' placeholder="Enter Course Name" required>
            <a href='courses.php' type='button' class='form-control bg-dark btn fw-bolder text-light'>Cancel</a>    
            <input type="submit" name="add" class="form-control fw-bolder bg-success text-light" value="Save Changes">
        <?PHP }?>
        </form>
    </div>
</div>