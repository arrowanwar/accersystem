document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.getElementById('er-table-body');
    const createBtn = document.getElementById('create-btn');
    const hqErModal = new bootstrap.Modal(document.getElementById('hqErModal'));
    const form = document.getElementById('hqErForm');
    const hqErIdInput = document.getElementById('hqErId');

    // Function to fetch and display data
    async function fetchHqErs() {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/hq-ers');
            const ers = response.data.data;
            tableBody.innerHTML = ''; // Clear table
            ers.forEach(er => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${er.id}</td>
                    <td>${er.hq_er_no}</td>
                    <td>${er.date}</td>
                    <td>${er.section}</td>
                    <td>${er.nothi_no || 'N/A'}</td>
                    <td>
                        <button class="btn btn-sm btn-info edit-btn" data-id="${er.id}">Edit</button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${er.id}">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        } catch (error) {
            console.error('Error fetching HQ ERs:', error);
            alert('Failed to fetch data.');
        }
    }

    // Handle form submission (Create or Update)
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = hqErIdInput.value;
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            if (id) {
                // UPDATE request
                await axios.put(`http://127.0.0.1:8000/api/hq-ers/${id}`, data);
                alert('HQ ER updated successfully!');
            } else {
                // CREATE request
                await axios.post('http://127.0.0.1:8000/api/hq-ers', data);
                alert('HQ ER created successfully!');
            }
            hqErModal.hide();
            fetchHqErs(); // Refresh the table
        } catch (error) {
            console.error('Error submitting form:', error);
            alert('Failed to save data. Check the console for details.');
        }
    });

    // Event listener for the "Add New" button
    createBtn.addEventListener('click', () => {
        form.reset();
        hqErIdInput.value = '';
        hqErModal.show();
    });

    // Event delegation for "Edit" and "Delete" buttons
    tableBody.addEventListener('click', async (e) => {
        const target = e.target;
        const id = target.dataset.id;

        if (target.classList.contains('edit-btn')) {
            try {
                const response = await axios.get(`http://127.0.0.1:8000/api/hq-ers/${id}`);
                const er = response.data;
                
                // Populate the form with data
                hqErIdInput.value = er.id;
                document.getElementById('hq_er_no').value = er.hq_er_no;
                document.getElementById('date').value = er.date;
                document.getElementById('section').value = er.section;
                document.getElementById('nothi_no').value = er.nothi_no || '';
                document.getElementById('code').value = er.code || '';
                
                hqErModal.show();
            } catch (error) {
                console.error('Error fetching data for edit:', error);
                alert('Failed to load data for editing.');
            }
        }

        if (target.classList.contains('delete-btn')) {
            if (confirm('Are you sure you want to delete this entry?')) {
                try {
                    await axios.delete(`http://127.0.0.1:8000/api/hq-ers/${id}`);
                    alert('HQ ER deleted successfully!');
                    fetchHqErs(); // Refresh the table
                } catch (error) {
                    console.error('Error deleting entry:', error);
                    alert('Failed to delete the entry.');
                }
            }
        }
    });

    // Initial data load
    fetchHqErs();
});