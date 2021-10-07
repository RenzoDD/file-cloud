<div class="modal fade" id="folderVisibility" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" action="/folder/visibility" method="POST">
            <div class="modal-header">
                <span class="h5 modal-title">Visibility</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <input type="radio" class="btn-check" name="visibility" id="everyone" autocomplete="off" value="ALL">
                <label class="btn btn-outline-success" for="everyone">Everyone</label>

                <input type="radio" class="btn-check" name="visibility" id="just-me" autocomplete="off" value="ME">
                <label class="btn btn-outline-danger" for="just-me">Just me</label>
                
                <input type="hidden" name="id" id="txtIdV">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    var rbAll = document.getElementById("everyone");
    var rbMe = document.getElementById("just-me");
    var txtIdV = document.getElementById("txtIdV");
    function VisibilityFolder(id, visibility)
    {
        txtIdV.value = id;
        rbAll.checked = false;
        rbMe.checked = false;

        if (visibility === "ALL")
            rbAll.checked = true;
        if (visibility === "ME")
            rbMe.checked = true;
    }
</script>