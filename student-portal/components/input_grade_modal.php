<div class="modal fade" id="inputGradeModal" tabindex="-1" aria-labelledby="inputGradeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="add.php" method="POST">
            <div class="modal-header">
                <h3><?= $student_name?>'s Grade</h3>
            </div>
            <div class="modal-body">
                    <b>Subject Code</b>: <p><?= $row['code'] ?></p>    
                    <hr>
                    <input type='hidden' name='student_id' value="<?= $student_id?>">
                    <b>Midterm Grade</b>
                    <select name="midterm" class="form-select" require>
                        <option value="">Select Grade</option>
                        <option value="1.00">1.00</option>
                        <option value="1.25">1.25</option>
                        <option value="1.50">1.50</option>
                        <option value="1.75">1.75</option>
                        <option value="2.00">2.00</option>
                        <option value="2.25">2.25</option>
                        <option value="2.50">2.50</option>
                        <option value="2.75">2.75</option>
                        <option value="3.00">3.00</option>
                        <option value="4.00">4.00</option>
                        <option value="5.00">5.00</option>
                    </select><b>Final Course Grade</b>
                    <select name="midterm" class="form-select">
                        <option value="">Select Grade</option>
                        <option value="1.00">1.00</option>
                        <option value="1.25">1.25</option>
                        <option value="1.50">1.50</option>
                        <option value="1.75">1.75</option>
                        <option value="2.00">2.00</option>
                        <option value="2.25">2.25</option>
                        <option value="2.50">2.50</option>
                        <option value="2.75">2.75</option>
                        <option value="3.00">3.00</option>
                        <option value="4.00">4.00</option>
                        <option value="5.00">5.00</option>
                    </select>
            </div>
            <div class="modal-footer">
                <button type="submit" name="createGrade" class="form-control w-25 border-success text-success">Save</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>