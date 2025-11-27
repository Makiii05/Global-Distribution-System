<form method="post" style="display:inline;">
    <input type="hidden" name="delete" value="<?= $row["id"] ?>">
    <?PHP if(isset($_POST["view_schedule"])): ?>
    <input type="hidden" name="view_schedule" value="<?= $_POST["view_schedule"] ?>">
    <?PHP endif; ?>
    <button type="submit" class="btn btn-link p-0 border-danger p-2 mx-2" onclick="return confirm('Delete This Data?')">
        <i class="bi bi-trash3 text-danger"></i>
    </button>
</form>
<!--  -->
<button type="button" class="btn btn-link edit-btn border-dark p-2 mx-2" 
        onclick='modal(<?= json_encode($row) ?>)'>
  <i class="bi bi-pencil-fill text-dark"></i>
</button>

