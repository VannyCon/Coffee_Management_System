
 <!-- TIMELINE MODALS START-->
 <!-- Create Timeline Modal -->
 <div class="modal fade" id="createTimelineModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Enter Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

                <div class="modal-body">
                    <form method="POST" action="">
                            <div class="form-group">
                                <label for="timeline_title">Timeline Title</label>
                                <input type="text" class="form-control" id="timeline_title"  name="timeline_title"  placeholder="Enter first value" required>
                            </div>
                            <div class="form-group">
                                <label for="history_date">Date</label>
                                <input type="date" class="form-control" id="history_date" name="history_date" placeholder="Enter second value" required>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="createTimeline">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
 <!-- Timeline Modal -->
<!-- Edit Timeline Modal -->
<div class="modal fade" id="editTimelineModal" tabindex="-1" aria-labelledby="editTimelineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTimelineModalLabel">Edit Timeline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="edit_timeline_title">Timeline Title</label>
                        <input type="text" class="form-control" id="edit_timeline_title" name="timeline_title" placeholder="Enter new title">
                    </div>
                    <div class="form-group">
                        <label for="edit_history_date">Date</label>
                        <input type="date" class="form-control" id="edit_history_date" name="history_date" placeholder="Enter new date">
                    </div>
                    <input type="hidden" id="edit_timeline_id" name="timelineID">
                    <input type="hidden" name="action" value="editTimeline">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Timeline Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this timeline?</p>
                <form method="POST" action="">
                    <input type="hidden" id="delete_timeline_id" name="timelineID">
                    <input type="hidden" name="action" value="deleteTimeline">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- TIMELINE MODALS END-->

<!-- CONTENT MODALS -->
 <!-- Create Content Modal -->
 <div class="modal fade" id="createContentModal" tabindex="-1" aria-labelledby="createContentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createContentModalLabel">Enter Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                            <div class="form-group">
                                <label for="content">Content</label>
                                <input type="text" class="form-control" id="content"  name="content"  placeholder="Enter first value">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" id="status"  name="status"  placeholder="Enter first value">
                            </div>
                            <div class="form-group">
                                <label for="history_time">Time</label>
                                <input type="time" class="form-control" id="status"  name="status"  placeholder="10:00pm">
                            </div>
                        </div>
                        <input type="hidden" name="contentID" id="contentID">
                        <input type="hidden" name="action" value="createContent">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
 <!-- Create Content Modal -->

<!-- Edit Content Modal -->
<div class="modal fade" id="editContentModal" tabindex="-1" aria-labelledby="editContentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContentModalLabel">Enter Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="content">Content</label>
                        <input type="text" class="form-control" id="edit_content" name="content" placeholder="Enter first value">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="edit_status" name="status" placeholder="Enter status">
                    </div>
                    <!-- Use hidden field for contentID -->
                    <input type="hidden" name="contentID" id="edit_id"> <!-- Correct hidden field ID -->
                    <input type="hidden" name="action" value="editContent">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Timeline Modal -->
<div class="modal fade" id="deleteContentModal" tabindex="-1" aria-labelledby="deleteContentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteContentModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this timeline?</p>
                <form method="POST" action="">
                    <input type="hidden" id="delete_content_id" name="contentID">
                    <input type="hidden" name="action" value="deleteContent">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>