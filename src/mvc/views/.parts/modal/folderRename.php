<div class="modal fade" id="folderRename" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" action="/folder/rename" method="POST">
            <div class="modal-header">
                <span class="h5 modal-title">Rename Folder</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">New name:</label>
                    <input type="text" class="form-control" name="name" id="txtName" placeholder="">
                    <input type="hidden" name="id" id="txtId">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Rename</button>
            </div>
        </form>
    </div>
</div>
<script>
    var txtName = document.getElementById("txtName");
    var txtId = document.getElementById("txtId");
    function RenameFolder(id, name)
    {
        txtId.value = id;
        txtName.value = name;
        txtName.placeholder = name;
    }
</script>