
// document.addEventListener('DOMContentLoaded', function () {

//     document.getElementById('addArtistForm').addEventListener('submit', function (event) {
//         event.preventDefault();

//         // Get form data
//         const formData = new FormData(this);

//         // Perform AJAX request to store the artist data
//         fetch('/profile', {
//             method: 'POST',
//             body: formData,
//         })
//             .then(response => response.json())
//             .then(data => {
//                 // Check if the request was successful
//                 if (data.success) {

//                     // Reset form inputs
//                     this.reset();
//                     // Close the modal after successful submission
//                     $('#addArtistModal').modal('hide');

//                     // Create HTML for the new artist
//                     const newArtist = data.artist;
//                     const artistHtml = `
//                     <tr>
//                         <td>${newArtist.id}</td>
//                         <td>${newArtist.name}</td>
//                         <td>${newArtist.status}</td>
//                         <td>${newArtist.role.name}</td>
//                         <td>${newArtist.email}</td>
//                         <td>${newArtist.phone}</td>
//                         <td>${newArtist.address}</td>
//                     </tr>
//                 `;

//                     // Append the new artist to the table body
//                     const artistTableBody = document.querySelector('#artistsTableBody');
//                     artistTableBody.insertAdjacentHTML('beforeend', artistHtml);

//                     // Show success message with SweetAlert
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success',
//                         text: data.message,  // Assuming your backend sends a success message
//                     });

//                     // Optionally, reload or update the artists table
//                 } else {
//                     // Show error message with SweetAlert
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error',
//                         text: data.error,  // Assuming your backend sends an error message
//                     });
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 // Show error message with SweetAlert
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Error',
//                     text: 'An unexpected error occurred.',
//                 });
//             });
//     });




//     document.getElementById('addArtProjectForm').addEventListener('submit', function (event) {
//         event.preventDefault();

//         const formData = new FormData(this);

//         fetch('/art-projects', {
//             method: 'POST',
//             body: formData,
//         })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.success) {

//                     this.reset();
//                     $('#addArtProjecttModal').modal('hide');

//                     const newArtProject = data.artProject;
//                     const artProjectHtml = `
//                     <tr>
//                         <td>${newArtProject.id}</td>
//                         <td>${newArtProject.name}</td>
//                         <td>${newArtProject.description}</td>
//                         <td>${newArtProject.status}</td>
//                         <td>${newArtProject.budget}</td>
//                         <td>${newArtProject.start_date}</td>
//                         <td>${newArtProject.end_date}</td>
//                         <td>
//                 <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editArtProjectModal_${newArtProject.id}">Edit</button>
//                 <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteArtProjectModal_${newArtProject.id}" onclick="deleteArtProject(${newArtProject.id}, 'deleteArtProjectModal_${newArtProject.id}')">Delete</button>
//                 <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#assignArtProjectModal_${newArtProject.id}">Assign</button>
//                 <!-- Add other buttons as needed -->
//             </td>
//                     </tr>
//                 `;

//                     const artProjectTableBody = document.querySelector('#artProjectsTableBody');
//                     artProjectTableBody.insertAdjacentHTML('beforeend', artProjectHtml);

//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success',
//                         text: data.message,
//                     });
//                 } else {
//                     // Show error message
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error',
//                         text: data.error,
//                     });
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 // Show error message with SweetAlert
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Error',
//                     text: 'An unexpected error occurred.',
//                 });
//             });
//     });



//     document.getElementById('add-partner-button').addEventListener('click', function () {

//         document.getElementById('add-partner-form').style.display = 'table-row';
//     });
//     // Handle form submission
//     document.getElementById('submitPartnerForm').addEventListener('click', function () {

//         event.preventDefault();

//         const formData = new FormData(document.getElementById('partnerForm'));

//         fetch('/partners', {
//             method: 'POST',
//             body: formData,
//         })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.success) {
//                     document.getElementById('partnerForm').reset();
//                     document.getElementById('add-partner-form').style.display = 'none';

//                     const newPartner = data.partner;
//                     const partnerTableBody = document.querySelector('#partnerTableBody');
//                     const partnerHtml = `
//             <tr>
//                 <td>${newPartner.id}</td>
//                 <td>${newPartner.name}</td>
//                 <td>${newPartner.contact_info}</td>
//                 <td>${newPartner.description}</td>
//                 <td>
//                     <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editPartnerModal_${newPartner.id}">Edit</button>
//                     <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletePartnerModal_${newPartner.id}">Delete</button>
//                 </td>
//             </tr>
//         `;

//                     partnerTableBody.insertAdjacentHTML('beforeend', partnerHtml);

//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success',
//                         text: data.message,
//                     });
        
//                     // Optionally, update or reload the partners table
//                 } else {
//                     // Show error message with SweetAlert
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error',
//                         text: data.error,
//                     });
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Error',
//                     text: 'An unexpected error occurred.',
//                 });
//             });
//     });
//     document.getElementById('close-partner-form').addEventListener('click', function () {

//         document.getElementById('add-partner-form').style.display = 'none';
//     });

//     // Function to delete art project
//     function deleteArtProject(projectId) {
//         // Perform AJAX request to delete the art project
//         fetch(`/art-projects/${projectId}`, {
//             method: 'DELETE',
//         })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.success) {
//                     // Delete the corresponding row from the table
//                     const rowToDelete = document.getElementById(`artProjectRow_${projectId}`);
//                     rowToDelete.parentNode.removeChild(rowToDelete);
    
//                     // Show success message with SweetAlert
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success',
//                         text: data.message,
//                     }).then(() => {
//                         // Manually close the delete modal
//                         const deleteModal = document.getElementById(`deleteArtProjectModal_${projectId}`);
//                         const modalInstance = bootstrap.Modal.getInstance(deleteModal);
//                         modalInstance.hide();
//                     });
//                 } else {
//                     // Show error message with SweetAlert
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error',
//                         text: data.error,
//                     });
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 // Show error message with SweetAlert
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Error',
//                     text: 'An unexpected error occurred.',
//                 });
//             });
//     }
    
//     function assignArtist(projectId, artistId, artistName) {
//         // Send an AJAX request to assign the artist to the project
//         // ...
    
//         console.log(`Assigning artist ${artistName} to project ${projectId}, artist ID: ${artistId}`);
//         // Update the UI
//         var assignedArtistsList = document.getElementById('assignedArtists');
//         var availableArtistsButton = document.querySelector('[data-artist-id="' + artistId + '"]');
    
//         // Create a new list item for the assigned artist
//         var listItem = document.createElement('li');
//         listItem.textContent = artistName;
    
//         // Create a button to remove the assigned artist
//         var removeButton = document.createElement('button');
//         removeButton.setAttribute('type', 'button');
//         removeButton.classList.add('btn', 'btn-sm', 'btn-danger');
//         removeButton.textContent = 'Remove';
//         removeButton.addEventListener('click', function () {
//             removeAssignedArtist(projectId, artistId);
//         });
    
//         // Append the remove button to the list item
//         listItem.appendChild(removeButton);
    
//         // Append the list item to the assigned artists list
//         assignedArtistsList.appendChild(listItem);
    
//         // Remove the assigned artist button from the available artists list
//         availableArtistsButton.remove();
//     }
    

//     function removeAssignedArtist(projectId, artistId, artistName) {
//         // Assuming you have an AJAX function to handle the removal
//         // Make an AJAX request to your server to remove the artist from the project
    
//         // Once the removal is successful, update the UI
//         // Add the artist back to the available artists list
//         var availableArtistsSection = document.getElementById('editAssignedArtists');
//         var addButton = document.createElement('button');
//         addButton.setAttribute('type', 'button');
//         addButton.classList.add('btn', 'btn-success');
//         addButton.textContent = 'Assign ' + artistName;
//         addButton.onclick = function () {
//             assignArtist(projectId, artistId, artistName);
//         };
    
//         availableArtistsSection.appendChild(addButton);
    
//         // Remove the artist from the assigned artists list
//         var assignedArtistsList = document.getElementById('assignedArtists');
//         var assignedArtists = assignedArtistsList.getElementsByTagName('li');
    
//         for (var i = 0; i < assignedArtists.length; i++) {
//             var li = assignedArtists[i];
//             if (li.textContent.includes(artistName)) {
//                 li.remove();
//                 break;
//             }
//         }
//     }
    
    

// });
