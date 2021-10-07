<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * File visibility modal
 */
?>

<div class="modal fade" id="visibility" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" action="/file/visibility" method="GET">
            <div class="modal-header">
                <span class="h5 modal-title">Visibility</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <input type="radio" class="btn-check" name="visibility" id="everyone" autocomplete="off" value="ALL" <?php echo ($file->Visibility === "ALL")? "checked" : "" ?>>
                <label class="btn btn-outline-success" for="everyone">Everyone</label>

                <input type="radio" class="btn-check" name="visibility" id="just-me" autocomplete="off" value="ME" <?php echo ($file->Visibility === "ME")? "checked" : "" ?>>
                <label class="btn btn-outline-danger" for="just-me">Just me</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>