<div class="w-full h-auto p-5 rounded-lg border bg-white">
    <div class="mb-4 flex gap-2">
        <input type="text" id="search" placeholder="Search by name..." class="border p-2 rounded w-1/3">
        <?= view('components/button', [
            'label' => 'Add Patient',
            'id' => 'new',
            'variant' => 'primary',
            'onclick' => '{openModalCreatePatient()}'
        ]) ?>
    </div>

    <table class="min-w-full p-2 bg-white mb-4 border">
        <thead class="text-left bg-gray-50">
            <tr>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Gender</th>
                <th class="p-2 border">Address</th>
                <th class="p-2 border">DOB</th>
                <th class="p-2 border">Doctor</th>
                <th class="p-2 border">Specialty</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody id="patient-table"></tbody>
    </table>

    <form id="modal-backdrop" onsubmit="handlePatientForm(event)" class="fixed inset-0 opacity-0 pointer-events-none flex items-center justify-center hidden z-50 bg-black">

        <div id="form-modal" class="w-full max-w-md p-4 space-y-5 relative rounded shadow-mdrounded shadow-md bg-white ">

            <input type="hidden" id="Pat_ID">

            <div class="mb-2">
                <label for="Pat_Name" class="block text-sm font-medium text-gray-700 mb-1">Full Name:</label>
                <input type="text" id="Pat_Name" id="Pat_Name" placeholder="Name" class="border p-2 w-full">
            </div>

            <div class="mb-2">
                <label for="Pat_Gender" class="block text-sm font-medium text-gray-700 mb-1">Gender:</label>
                <select id="Pat_Gender" class="border p-2 w-full" required>
                    <option value="">Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="Pat_Address" class="block text-sm font-medium text-gray-700 mb-1">Address:</label>
                <textarea id="Pat_Address" placeholder="Address" class="border p-2 w-full" required></textarea>
            </div>

            <div class="mb-2">
                <label for="Pat_DOB" class="block text-sm font-medium text-gray-700 mb-1">Date of birth:</label>
                <input type="date" id="Pat_DOB" class="border p-2 w-full" required>
            </div>

            <div class="mb-2">
                <label for="PCP_ID" class="block text-sm font-medium text-gray-700 mb-1">Primary care provider:</label>
                <select id="PCP_ID" class="border p-2 w-full" required>
                    <option value="">Select Poli</option>
                </select>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
        </div>

    </form>
</div>

<script>
    $(document).ready(() => {
        fetchPatients();
        $.get('/pcps/list', function(pcps) {
            const select = $('#PCP_ID');
            pcps.forEach(pcp => {
                select.append(`<option value="${pcp.PCP_ID}">${pcp.PCP_Specialty}</option>`);
            });
        });
    });

    const backdrop = $('#modal-backdrop');

    function resetAndShowModal() {
        $('#patient-form')[0].reset();
        $('#Pat_ID').val('');
    }

    function openModalCreatePatient() {
        $('#Pat_ID').val('');
        $('#Pat_Name').val('');
        $('#Pat_Gender').val('');
        $('#Pat_Address').val('');
        $('#Pat_DOB').val('');
        $('#PCP_ID').val('');
        showModal();
    }

    function showModal() {
        backdrop.removeClass('hidden opacity-0 pointer-events-none')
            .addClass('bg-opacity-50');
    }

    function hideModal() {
        backdrop.addClass('hidden opacity-0 pointer-events-none')
            .removeClass('bg-opacity-50');
    }

    $('#modal-backdrop').click(function(e) {
        if (e.target.id === 'modal-backdrop') {
            hideModal();
        }
    });

    function fetchPatients(search = '') {
        $.ajax({
            url: '/patients/list',
            method: 'GET',
            data: {
                search
            },
            success: function(data) {
                let rows = '';
                data.forEach(p => {
                    rows += `<tr>
                    <td class="p-2 border">${p.Pat_Name}</td>
                    <td class="p-2 border">${p.Pat_Gender}</td>
                    <td class="p-2 border">${p.Pat_Address}</td>
                    <td class="p-2 border">${p.Pat_DOB}</td>
                    <td class="p-2 border">${p.PCP_Name}</td>
                    <td class="p-2 border">${p.PCP_Specialty}</td>
                    <td class="p-2 border flex gap-5">
                        <button onclick="edit(${p.Pat_ID})" class="py-1 px-2 text-white rounded-md bg-blue-500">Edit</button>
                        <button onclick="remove(${p.Pat_ID})" class="py-1 px-2 text-white rounded-md bg-red-500">Delete</button>
                    </td>
                </tr>`;
                });
                $('#patient-table').html(rows);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching patients:', error);
            }
        });
    }

    function edit(id) {
        $.ajax({
            url: '/patients/list',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const patient = data.find(p => p.Pat_ID == id);
                if (patient) {
                    showModal();
                    $('#Pat_ID').val(patient.Pat_ID);
                    $('#Pat_Name').val(patient.Pat_Name);
                    $('#Pat_Gender').val(patient.Pat_Gender);
                    $('#Pat_Address').val(patient.Pat_Address);
                    $('#Pat_DOB').val(patient.Pat_DOB);
                    $('#PCP_ID').val(patient.PCP_ID);
                } else {
                    alert('Patient not found!');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching patient:', error);
                alert('Failed to load patient data. Please try again.');
            }
        });
    }

    function remove(id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: '/patients/delete/' + id,
                type: 'DELETE',
                success: function(response) {
                    alert('Patient saved successfully!');
                    fetchPatients();
                    hideModal();
                },
            });
        }
    }

    function handlePatientForm(event) {
        event.preventDefault();

        const id = $('#Pat_ID').val();
        const data = {
            Pat_Name: $('#Pat_Name').val(),
            Pat_Gender: $('#Pat_Gender').val(),
            Pat_Address: $('#Pat_Address').val(),
            Pat_DOB: $('#Pat_DOB').val(),
            PCP_ID: $('#PCP_ID').val()
        };

        const url = id ? `/patients/update/${id}` : '/patients/create';

        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function(response) {
                alert('Patient saved successfully!');
                fetchPatients();
                hideModal();
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
                console.error('Save error:', xhr.responseText);
            }
        });
    }

    $('#search').on('input', function() {
        fetchPatients(this.value);
    });

    $(document).ready(() => fetchPatients());
</script>