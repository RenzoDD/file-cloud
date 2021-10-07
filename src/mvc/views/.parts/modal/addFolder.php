<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Add folder modal
 */
?>

<div class="modal fade" id="addFolder" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" action="/folder/create" method="post">
            <div class="modal-header">
                <span class="h5 modal-title">
                    <i class="bi bi-folder-plus"></i> Add folder
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Folder name:</label>
                    <input type="text" class="form-control" name="FolderName" placeholder="My New Folder">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>