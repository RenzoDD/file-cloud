<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Add file modal
 */
?>

<div class="modal fade" id="addFile" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" enctype="multipart/form-data" action="/file/upload" method="post">
            <div class="modal-header">
                <span class="h5 modal-title">
                    <i class="bi bi-file-earmark-plus"></i> Add file    
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Local file path:</label>
                    <input class="form-control" type="file" name="FilePath">
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Cancel</button>
                <button type="submit" class="btn btn-success"><i class="bi bi-upload"></i> Upload</button>
            </div>
        </form>
    </div>
</div>