<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Rename modal
 */
?>

<div class="modal fade" id="rename" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" action="/file/rename" method="POST">
            <div class="modal-header">
                <span class="h5 modal-title">Rename File</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">New name:</label>
                    <input type="text" class="form-control" name="name" placeholder="<?php echo $file->Name;?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Rename</button>
            </div>
        </form>
    </div>
</div>