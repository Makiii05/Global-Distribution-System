<form method="post" style="display:inline;">
    <input type="hidden" name="delete" value="<?= $row["id"] ?>">
    <button type="submit" class="btn btn-link p-0 border-danger p-2 mx-2" onclick="return confirm('Delete This Data?')">
        <i class="bi bi-trash3 text-danger"></i>
    </button>
</form>
<!--  -->
<button type="button" class="btn btn-link edit-btn border-dark p-2 mx-2" 
        onclick='modal(<?= json_encode($row) ?>)'>
  <i class="bi bi-pencil-fill text-dark"></i>
</button>

