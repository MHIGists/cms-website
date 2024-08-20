<x-app-layout>
<div id="loading" class=" fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75 z-50 transition-opacity duration-500 opacity-100">
        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-gray-300"></div>
    </div>
    <div class="bg-gray-800 p-6 text-white hidden" id="page-content" >
        <h1 class="text-3xl font-bold mb-6">CMS Installations</h1>
        <div class="overflow-x-auto">
            <input class="mb-6 bg-black" type="text" id="searchInput" placeholder="Search..." autofocus>
            <div id="preferences" class="flex-auto justify-between mb-6">
                <div>
                    <h3 class="inline-flex mb-4 font-semibold dark:text-white">Preferences</h3>
                    <button
                        class=".preference-checkbox inline-flex btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        onclick="togglePreferences()" id="preferences-toggle">Hide
                    </button>
                </div>
                <table class="center-table table-auto border-separate border border-white w-full pr-20 text-white" id="hidePreferences">
                    <thead class="bg-gray-700">
                    <tr>
                        @foreach($preferences as $preference)
                            <th>
                                <label
                                    class="text-sm font-medium text-white ">{{ $preference }}
                                    <input id="{{ $preference }}" type="checkbox" value="{{ $preference }}"
                                           class="preference-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                           checked>
                                </label>
                            </th>
                        @endforeach

                    </tr>
                    </thead>
                </table>
            </div>
            <table class="center-table table-auto border-separate border border-white text-white" id="dataTable">
                <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Casino</th>
                    <th class="px-4 py-2 text-left">Host Password</th>
                    <th class="px-4 py-2 text-left">Zabbix Password</th>
                    <th class="px-4 py-2 text-left">Host 1/2</th>
                    <th class="px-4 py-2 text-left">Router IP</th>
                    <th class="px-4 py-2 text-left">NAS IP</th>
                    <th class="px-4 py-2 text-left">CMS IP</th>
                    <th class="px-4 py-2 text-left">CMS Floor Name</th>

                </tr>
                </thead>
                <tbody class="text-white">
                @foreach($table as $row)
                    <tr>
                        <td class="border px-4 py-2">{{ $row->Casino }}</td>
                        <td class="border px-4 py-2">
                            <div>{{ $row->Host_Password }}</div>
                            <button
                                class="ml-4 copy-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                data-text="{{ $row->Host_Password }}">Copy
                            </button>
                        </td>
                        <td class="border px-4 py-2">
                            <div>{{ $row->Zabbix_Password }}</div>
                            <button
                                class="ml-4 copy-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                data-text="{{ $row->Zabbix_Password }}">Copy
                            </button>
                        </td>
                        <td class="border px-4 py-2">
                            <a class="copy-button inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-6"
                               href="https://{{ $row->HOST_1_2 }}" target="_blank" data-text="{{ $row->Host_Password }}">{{ $row->HOST_1_2 }} </a>
                            <a href="ssh://username@@if(true){{$row->HOST_1_2}}@endif:22"
                               class="copy-button hide-ssh block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" data-text="{{ $row->Host_Password }}">SSH</a>
                        </td>
                        <td class="border px-4 py-2">
                            <a class="copy-button inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-6"
                               href="https://{{ $row->Router }}" target="_blank" data-text="password">{{ $row->Router }}</a>
                            <a href="ssh://username@@if(true){{$row->Router}}@endif:22"
                               class="copy-button hide-ssh block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" data-text="password">SSH</a>
                        </td>
                        <td class="border px-4 py-2">
                            <a class="copy-button inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-6"
                               href="https://{{ $row->NAS }}" target="_blank" data-text="{{ $row->Host_Password }}">{{ $row->NAS }}</a>
                            <a href="ssh://username@@if(true){{$row->NAS}}@endif:22"
                               class="copy-button hide-ssh block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"  data-text="{{ $row->Host_Password }}">SSH</a>
                        </td>
                        <td class="border px-4 py-2">
                            <a class="copy-button block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-6"
                                href="https://{{ $row->cms_ip }}" target="_blank" data-text="password">{{ $row->cms_ip }}</a>

                            <a href="ssh://username@@if(true){{$row->cms_ip}}@endif:22"
                               class="copy-button hide-ssh block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" data-text="password">SSH</a>
                        </td>
                        <td class="border px-4 py-2">
                            <div>{{$row->floor_name }}</div>
                            <button
                                class="ml-4 copy-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                data-text="{{ $row->floor_name }}">Copy
                            </button>
                        </td>
                        <td class="border px-4 py-2">
                            <a class="inline-block bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                               href="{{route('get.installation.info', ['id' => $row->id])}}">Open</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            var searchText = this.value.toLowerCase();
            var tableRows = document.getElementById('dataTable').getElementsByTagName('tr');

            // Loop through all table rows
            for (var i = 1; i < tableRows.length; i++) {
                var row = tableRows[i];
                var rowData = row.textContent.toLowerCase();

                // If search text is found in row data, show the row, otherwise hide it
                if (rowData.indexOf(searchText) !== -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    </script>
    <script>
        // Show loading screen on page load
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('loading').style.display = 'flex';
            document.getElementById('page-content').style.display = 'none';
        });

        // Hide loading screen and show page content when everything is loaded
        window.addEventListener('load', function () {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('page-content').style.display = 'block';
        });

    </script>
    <script>
        document.querySelectorAll('.copy-button').forEach(function (button) {
            button.addEventListener('click', function () {
                var textToCopy = this.getAttribute('data-text');
                var originalText = this.innerText;
                // Create a temporary textarea element to hold the text
                var tempTextarea = document.createElement('textarea');
                tempTextarea.value = textToCopy;

                // Append the textarea to the body
                document.body.appendChild(tempTextarea);

                // Select the text inside the textarea
                tempTextarea.select();

                // Copy the selected text to the clipboard
                document.execCommand('copy');

                // Remove the temporary textarea
                document.body.removeChild(tempTextarea);

                // Change button text to indicate success
                this.innerText = 'Copied!';
                var btn = this;
                setTimeout(function () {
                    btn.innerText = originalText;
                }, 2000);
            });
        });
    </script>
    <script>
        function togglePreferences() {
            var preferences = document.getElementById('hidePreferences');
            var button = document.getElementById('preferences-toggle');
            preferences.style.display = (preferences.style.display === 'none') ? '' : 'none';
            if (preferences.style.display === 'none') {
                button.innerText = 'Show';
            } else {
                button.innerText = 'Hide'
            }
        }

    </script>
    <script>
    // Function to save preferences to localStorage
    function savePreferences() {
        const preferences = {};
        document.querySelectorAll('.preference-checkbox').forEach(function (checkbox) {
            preferences[checkbox.id] = checkbox.checked;
        });
        localStorage.setItem('preferences', JSON.stringify(preferences));
        const hideButtonState = document.getElementById('preferences-toggle').innerText;
        localStorage.setItem('hideButtonState', hideButtonState);
    }
    document.getElementById('preferences-toggle').addEventListener('click', function () {

        savePreferences(); // Save hide button state when clicked
    });
    // Function to apply saved preferences
    function applyPreferences() {
        const preferences = JSON.parse(localStorage.getItem('preferences'));
        const hideButtonState = localStorage.getItem('hideButtonState');
        if (hideButtonState) {
            const preferencesToggle = document.getElementById('preferences-toggle');
            preferencesToggle.innerText = hideButtonState;
            const preferencesTable = document.getElementById('hidePreferences');
            preferencesTable.style.display = (hideButtonState === 'Show') ? 'none' : '';
        }
        if (preferences) {
            Object.entries(preferences).forEach(([columnId, isChecked]) => {
                const checkbox = document.getElementById(columnId);
                if (checkbox) {
                    checkbox.checked = isChecked;
                    toggleColumn(columnId, isChecked);
                }
            });
        }
    }

    // Add event listener to each checkbox
    document.querySelectorAll('.preference-checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            toggleColumn(this.id, this.checked);
            savePreferences(); // Save preferences when checkbox state changes
        });
    });


    // Function to toggle column visibility
    function toggleColumn(columnId, isVisible) {
        const columnIndex = Array.from(document.querySelectorAll('#dataTable th')).findIndex(th => th.innerText === columnId);

        if (columnId === "SSH") {
        document.querySelectorAll('#dataTable tr').forEach(function (row) {
            const sshButtons = row.querySelectorAll('.hide-ssh');
            sshButtons.forEach(function (sshButton) {
                sshButton.style.display = isVisible ? '' : 'none'; // Show or hide SSH button
            });
        });
    } else {
        // For other columns
        document.querySelectorAll('#dataTable tr').forEach(function (row) {
            const cells = row.cells;
            if (cells.length > columnIndex) {
                cells[columnIndex].style.display = isVisible ? '' : 'none'; // Show or hide column
            }
        });
    }


    }

    // Apply saved preferences when the page loads
    document.addEventListener('DOMContentLoaded', function () {
        applyPreferences();
    });
</script>

</x-app-layout>
