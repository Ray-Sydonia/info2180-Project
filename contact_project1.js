function loadContactDetails(contactId) {
    fetch(`view_contact.php?contact_id=${contactId}`)
        .then(response => response.json())
        .then(data => {
            const { title, firstname, lastname, email, company, telephone, type, assigned_firstname, assigned_lastname, id } = data.contact;

            // Display contact details in HTML
            document.getElementById('contactDetails').innerHTML = `
                <p><strong>Full Name:</strong> ${title} ${firstname} ${lastname}</p>
                <p><strong>Email:</strong> ${email}</p>
                <p><strong>Company:</strong> ${company}</p>
                <p><strong>Telephone:</strong> ${telephone}</p>
                <p><strong>Type:</strong> ${type}</p>
                <p><strong>Assigned To:</strong> ${assigned_firstname} ${assigned_lastname}</p>
                <button onclick="assignToMe(${id})">Assign to Me</button>
                <button onclick="toggleType(${id}, '${type}')">Switch Type</button>
            `;

            // Display contact's notes
            const notesList = data.notes.map(note => `<li>${note.comment} by ${note.firstname} ${note.lastname} on ${note.created_at}</li>`).join('');
            document.getElementById('notesList').innerHTML = notesList;
        });
}

function assignToMe(contactId) {
    fetch('assign_contact.php', {
        method: 'POST',
        body: new URLSearchParams({ 'contact_id': contactId, 'assigned_to': 1 }) // Dynamic user ID needed
    })
    .then(response => response.json())
    .then(() => loadContactDetails(contactId)); // Reload contact details
}

// Example to toggle contact type
function toggleType(contactId, currentType) {
    fetch('toggle_type.php', {
        method: 'POST',
        body: new URLSearchParams({ 'contact_id': contactId, 'new_type': currentType === 'Lead' ? 'Customer' : 'Lead' })
    })
    .then(response => response.json())
    .then(() => loadContactDetails(contactId)); // Reload contact details after type change
}
