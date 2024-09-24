    <!-- Bootstrap JS and dependencies (jQuery and Popper.js) -->
    <script>
        function setDeleteId(button) {
            var id = button.getAttribute('data-id');
            document.getElementById('deleteId').value = id;
            $('#deleteModal').modal('show');
        }
        function setCreateId(button) {
            var id = button.getAttribute('data-id');
            document.getElementById('contentID').value = id;
            $('#createContentModal').modal('show');
        }

        function setEditTimelineData(timelineItem) {
            document.getElementById('edit_timeline_id').value = timelineItem.id;
            document.getElementById('edit_timeline_title').value = timelineItem.timeline_title;
            document.getElementById('edit_history_date').value = timelineItem.history_date;
            $('#editTimelineModal').modal('show');
        }

        function setDeleteTimelineId(id) {
            document.getElementById('delete_timeline_id').value = id;
            $('#deleteModal').modal('show');
        }

        function setEditContentData(contentItem) {
            document.getElementById('edit_content').value = contentItem.content; // Update to match contentItem properties
            document.getElementById('edit_status').value = contentItem.status;   // Update to match contentItem properties
            document.getElementById('edit_id').value = contentItem.id; // Correct hidden input for content ID
            $('#editContentModal').modal('show'); // Show modal
        }
        function setDeleteContent(id) {
            document.getElementById('delete_content_id').value = id;
            $('#deleteContentModal').modal('show');
        }

        function selectItem(element) {
            var selectedValue = element.innerHTML.trim();  // Trim any extra spaces
            var selectedId = element.getAttribute('data-id'); // Get nursery_owner_id from data attribute

            // Set the selected value in the input
            document.getElementById("searchInput").value = selectedValue;
            
            // Set the selected nursery_owner_id in the hidden input
            document.getElementById("nurser_owner_id_fk").value = selectedId;
            
            // Close the dropdown
            document.getElementById("dropdownContent").classList.remove("show");
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeSearchFilter('searchInput', 'nurseryOwnersTable', 'noRecords');
        });
        
        // searchFilter.js
        function initializeSearchFilter(searchInputId, tableId, noRecordsId) {
            document.getElementById(searchInputId).addEventListener('keyup', function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = document.getElementById(searchInputId);
                filter = input.value.toLowerCase();
                table = document.getElementById(tableId);
                tr = table.getElementsByTagName('tr');
                found = false;

                // Loop through all table rows, excluding the header
                for (i = 1; i < tr.length; i++) {
                    tr[i].style.display = "none"; // Hide the row initially

                    // Check if any cell in the row contains the search input value
                    td = tr[i].getElementsByTagName('td');
                    for (j = 0; j < td.length; j++) {
                        if (td[j]) {
                            txtValue = td[j].textContent || td[j].innerText;
                            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                                tr[i].style.display = ""; // Show the row if a match is found
                                found = true;
                                break;
                            }
                        }
                    }
                }

                // Show or hide the 'No records' message
                var noRecords = document.getElementById(noRecordsId);
                if (!found) {
                    noRecords.style.display = "block"; // Show "no records" message if nothing is found
                } else {
                    noRecords.style.display = "none"; // Hide "no records" message if results are found
                }
            });
            
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>