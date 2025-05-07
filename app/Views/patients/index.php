<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="p-6 bg-gray-100">

    <div class="mb-4 flex gap-2">
        <input type="text" id="search" placeholder="Search by name..." class="border p-2 rounded w-1/3">
        <button id="new" class="bg-blue-500 text-white px-4 py-2 rounded">Add Patient</button>
    </div>

    <table class="min-w-full bg-white mb-4 border">
        <thead class="bg-gray-200 text-left">
            <tr>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Gender</th>
                <th class="p-2 border">Address</th>
                <th class="p-2 border">DOB</th>
                <th class="p-2 border">PCP</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody id="patient-table"></tbody>
    </table>

    <div id="form-modal" class="bg-white p-4 rounded shadow-md hidden">
        <input type="hidden" id="Pat_ID">

        <div class="mb-2">
            <input type="text" id="Pat_Name" placeholder="Name" class="border p-2 w-full">
        </div>

        <div class="mb-2">
            <select id="Pat_Gender" class="border p-2 w-full">
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
        </div>

        <div class="mb-2">
            <textarea id="Pat_Address" placeholder="Address" class="border p-2 w-full"></textarea>
        </div>

        <div class="mb-2">
            <input type="date" id="Pat_DOB" class="border p-2 w-full">
        </div>

        <div class="mb-2">
            <input type="text" id="PCP" placeholder="Primary Care Provider" class="border p-2 w-full">
        </div>

        <button id="save" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
    </div>

    <script>
        function fetchPatients(search = '') {
            console.log('patient fethced');
            $.get('/patients/list', {
                search
            }, function(data) {
                let rows = '';
                data.forEach(p => {
                    rows += `<tr>
            <td class="p-2 border">${p.Pat_Name}</td>
            <td class="p-2 border">${p.Pat_Gender}</td>
            <td class="p-2 border">${p.Pat_Address}</td>
            <td class="p-2 border">${p.Pat_DOB}</td>
            <td class="p-2 border">${p.PCP}</td>
            <td class="p-2 border">
              <button onclick="edit(${p.Pat_ID})" class="text-blue-500">Edit</button>
              <button onclick="remove(${p.Pat_ID})" class="text-red-500">Delete</button>
            </td>
          </tr>`;
                });
                $('#patient-table').html(rows);
            });
        }

        function edit(id) {
            $.get('/patients/list', function(data) {
                const patient = data.find(p => p.Pat_ID == id);
                if (patient) {
                    $('#form-modal').show();
                    $('#Pat_ID').val(patient.Pat_ID);
                    $('#Pat_Name').val(patient.Pat_Name);
                    $('#Pat_Gender').val(patient.Pat_Gender);
                    $('#Pat_Address').val(patient.Pat_Address);
                    $('#Pat_DOB').val(patient.Pat_DOB);
                    $('#PCP').val(patient.PCP);
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
                        $('#form-modal').hide();
                    },
                });
            }
        }

        $('#new').click(function() {
            $('#form-modal').show();
            $('#Pat_ID').val('');
            $('#Pat_Name, #Pat_Address, #PCP').val('');
            $('#Pat_Gender').val('');
            $('#Pat_DOB').val('');
        });

        $('#save').click(function() {
            const id = $('#Pat_ID').val();
            const data = {
                Pat_Name: $('#Pat_Name').val(),
                Pat_Gender: $('#Pat_Gender').val(),
                Pat_Address: $('#Pat_Address').val(),
                Pat_DOB: $('#Pat_DOB').val(),
                PCP: $('#PCP').val()
            };

            const url = id ? `/patients/update/${id}` : '/patients/create';

            console.log('the url is ', url);

            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                success: function(response) {
                    alert('Patient saved successfully!');
                    fetchPatients();
                    $('#form-modal').hide();
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + xhr.responseText);
                    console.log('error is', error, xhr.responseText)
                    console.error('Save error:', error, xhr.responseText);
                }
            });
        });


        $('#search').on('input', function() {
            fetchPatients(this.value);
        });

        $(document).ready(() => fetchPatients());
    </script>

</body>

</html>