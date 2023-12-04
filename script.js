//Event handler with Ajax & Jquery
$(document).ready(function() {

    /*Create site details */
    $('#createModal form').submit(function(event) {
        event.preventDefault();
  
        // Serialize the form data
        var formData = $(this).serialize();
  
        // Send an AJAX request
        $.ajax({
          type: 'POST',
          url: 'create.php', 
          data: formData,
          dataType: 'json',
          success: function(response) {
            // Handle the response
            if (response.success) {
              // Display a success message
              alert(response.message);
              // Close the modal
              $('#createModal').modal('hide');
              // Reset the form
              $('#createModal form')[0].reset();
              // Refresh the content
              $('#content').load('./table.php');
            } else {
              // Display an error message
              alert('Error: ' + response.message);
            }
          },
          error: function() {
            // Display an error message
            alert('An error occurred. Please try again.');
          }
        });
      });

    /*Edit site details */
    // Variables to store the form inputs
    var editSiteInput = $('#editModal #site');
    var editLinkInput = $('#editModal #link');
    var editDescriptionInput = $('#editModal #description');
    var submitButton = $('#submitEdit');

    // Function to set the form values
    function setFormValues(site, link, description, id) {
        editSiteInput.val(site);
        editLinkInput.val(link);
        editDescriptionInput.val(description);
        submitButton.attr('data-id',id); // Set attribute data-id to collect id before submission
    }

    // Edit button click event (As class edit-btn will replace after each change, event handler may detach. Hence event handler attached to the content id)
    $("#content").on('click','.edit-btn',function() {
        // Retrieve the data from the row
        var id = $(this).data('id');
        var site = $('tr[data-id="' + id + '"] td[data-col="site"]').text();
        var link = $('tr[data-id="' + id + '"] td[data-col="link"]').text();
        var description = $('tr[data-id="' + id + '"] td[data-col="description"]').text();
        // Set the form values
        setFormValues(site, link, description, id);

        // Show the edit modal
        $('#editModal').modal('show');
    });

    $('#editModal form').submit(function (event) {
        event.preventDefault();

        // Retrieve the id from the submit button's data-id attribute
        var id = submitButton.attr('data-id');

        // Serialize the form data
        var formData = $(this).serialize();
         // Send an AJAX request
        $.ajax({
            type: 'POST',
            url: 'update.php?id='+id, 
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle the response
                if (response.success) {
                // Display a success message
                alert(response.message);
                // Close the modal
                $('#editModal').modal('hide');
                // Refresh the content after successful update (you can use any suitable method)
                $('#content').load('./table.php');
                } else {
                // Display an error message
                alert('Error: ' + response.message);
                }
            },
            error: function() {
                // Display an error message
                alert('An error occurred. Please try again.');
            }
        });

    })


    /*Delete site details */
    // Delete button click event (As class edit-btn will replace after each change, event handler may detach. Hence event handler attached to the content id)
    $("#content").on('click','.delete-btn',function() {
      var id = $(this).data('id');
        
      var reason = prompt("Enter your reason to delete", "");
      console.log(reason)
      if(reason == null || reason == "")
      {
         return alert("Please fill in to continue");
      }
      else
      {
        // Send AJAX request to delete.php
        $.ajax({
            type: 'POST',
            url: 'delete.php',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
            if (response.success) {
                // Handle success response
                alert(response.message);
                // Refresh the table or update the content as needed
                $('#content').load('./table.php');
            } else {
                // Handle error response
                alert('Error: ' + response.message);
            }
            },
            error: function() {
            // Handle error
            alert('An error occurred. Please try again.');
            }
        });
        }
    });
});

