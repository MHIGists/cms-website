<x-app-layout>
    <div class="container mx-auto">
        <div class="py-8">
            <h1 class="text-2xl font-bold mb-4 text-white">Installation Information</h1>
            @if (session('error'))
                <div class="bg-red-600 border border-red-400 text-white px-4 py-3 rounded relative"
                     role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if (session('ping'))
                <div class="bg-green-500 border border-green-400 text-white px-4 py-3 rounded relative"
                     role="alert">
                    {{ session('ping') }}
                </div>
            @endif
            @if (session('no-ping'))
                <div class="bg-red-600 border border-red-400 text-white px-4 py-3 rounded relative"
                     role="alert">
                    {{ session('no-ping') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-500 border border-green-400 text-white px-4 py-3 rounded relative"
                     role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('update.installation.info') }}" method="POST" class="form-control">
                @csrf
                <div class="inline-block">
                    <input type="hidden" name="id" value="{{ $installation->id }}">
                    <div class="mb-4">
                        <label for="casino" class="block text-white font-bold mb-2">Casino</label>
                        <input type="text" id="casino" name="casino" value="{{ $installation->Casino }}"
                               class="bg-gray-800 text-white form-input">
                    </div>

                    <div class="mb-4">
                        <label for="host_password" class="block text-white font-bold mb-2">Host Password</label>
                        <input type="text" id="host_password" name="host_password"
                               value="{{ $installation->Host_Password }}"
                               class="bg-gray-800 text-white form-input">
                    </div>
                    <div class="mb-4">
                        <label for="zabbix_password" class="block text-white font-bold mb-2">Zabbix Password</label>
                        <input type="text" id="zabbix_password" name="zabbix_password"
                               value="{{ $installation->Zabbix_Password }}"
                               class="bg-gray-800 text-white form-input">
                    </div>
                    <div class="mb-4">
                        <label for="floor_name" class="block text-white font-bold mb-2">Floor Name</label>
                        <input type="text" id="floor_name" name="floor_name" value="{{ $installation->floor_name }}"
                               class="bg-gray-800 text-white form-input">
                    </div>
                </div>
                <div class="inline-block">
                    <div class="m-auto">
                        <label for="host_1_2" class="block text-white font-bold mb-2">Host 1/2</label>
                        <input type="text" id="host_1_2" name="host_1_2" value="{{ $installation->HOST_1_2 }}"
                               class="bg-gray-800 text-white form-input">
                        @if(!empty($installation->HOST_1_2))
                            <a href="{{ route('check', ['ip' => $installation->HOST_1_2]) }}"
                               class="loading-button btn bg-green-500 text-white font-bold py-2 px-4 rounded">Ping</a>
                        @endif
                    </div>
                    <div class="m-auto">
                        <label for="router" class="block text-white font-bold mb-2">Router</label>
                        <input type="text" id="router" name="router" value="{{ $installation->Router }}"
                               class="bg-gray-800 text-white form-input">
                        @if(!empty($installation->Router))
                            <a href="{{ route('check', ['ip' => $installation->Router]) }}"
                               class="loading-button btn bg-green-500 text-white font-bold py-2 px-4 rounded">Ping</a>
                        @endif
                    </div>
                    <div class="m-auto">
                        <label for="nas" class="block text-white font-bold mb-2">NAS</label>
                        <input type="text" id="nas" name="nas" value="{{ $installation->NAS }}"
                               class="bg-gray-800 text-white form-input">
                        @if(!empty($installation->NAS))
                            <a href="{{ route('check', ['ip' => $installation->NAS]) }}"
                               class="loading-button btn bg-green-500 text-white font-bold py-2 px-4 rounded">Ping</a>
                        @endif
                    </div>
                    <div class="m-auto">
                        <label for="cms_ip" class="block text-white font-bold mb-2">CMS IP</label>
                        <input type="text" id="cms_ip" name="cms_ip" value="{{ $installation->cms_ip }}"
                               class="bg-gray-800 text-white form-input">
                        @if(!empty($installation->cms_ip))
                            <a href="{{ route('check', ['ip' => $installation->cms_ip]) }}"
                               class="loading-button btn bg-green-500 text-white font-bold py-2 px-4 rounded">Ping</a>
                        @endif

                    </div>
                </div>
                <div class="mb-4">
                    <span  class="block text-green-700 text-bold text-xl mb-2">Last edited: {{$installation->LastUpdateUser}}</span>
                    </div>
                <div class="mb-4">
                    <label for="notes" class="block text-white font-bold mb-2">Installation Notes</label>
                    <textarea autocomplete="off" autocapitalize="off" spellcheck="false" id="notes" name="notes"
                              class="resize bg-gray-800 text-white form-control w-1/2">{{$installation->notes}}</textarea>
                </div>
                <button type="submit" class="btn mt-4 px-4 py-2 bg-blue-500 text-white rounded-md">Update Information
                </button>
            </form>
            <div id="installationCommands" >
                <h1 class="text-2xl font-bold mb-4 text-white">Installation Commands</h1>
                <button onclick="getLicenseKeys()"
                        class="loading-button btn inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                    Get license keys
                </button>
                <button
                    onclick="document.getElementById('pfsenseBackups').removeAttribute('hidden'); window.scrollBy(0, 150);"
                    class="btn inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                    Open pfsense backups
                </button>
                <div id="pfsenseBackups" hidden>
                    <iframe class="md:block w-full h-75 md:h-auto"
                            src="{{route('explorer', ['directory' => 'public/pfsenseBackups/' . $installation->Router])}}"></iframe>
                </div>
            </div>
            <div class="mb-4" id="license_keys">
                <h2 class="block text-white font-bold mb-2">CMS License Keys</h2>
                @foreach(array_filter(explode("\n", $installation->license_keys)) as $key)
                    <div class="flex items-center mb-2">
                        <div
                            class="appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline bg-gray-800 text-white">{{ $key }}</div>
                        <a href="https://{{$installation->cms_ip}}/"
                           target="_blank"
                           class="ml-4 copy-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                           data-text="{{ explode(' ', $key)[1] }}">Copy
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <button onclick="confirmDelete()"
                class="btn inline-block bg-red-600 text-white font-bold py-2 px-4 rounded">
            Delete Installation
        </button>
    </div>
    <script>
        function getLicenseKeys() {
            // Make an AJAX request to the route
            fetch("{{ route('get.specific.license.keys', ['id' => $installation->id]) }}");
            document.getElementById('loading-screen').style.display = 'flex';
            setTimeout(() => {

                window.location.reload();
            }, 10000);
        }

        function confirmDelete() {
            // Show confirmation dialog
            if (confirm("Are you sure you want to delete this installation?")) {
                // If "DELETE" is clicked, execute deleteInstallation function
                window.location = "{{ route('delete.installation.info', ['id' => $installation->id])}}"
            }
        }
    </script>
    <script>
        let buttons = document.querySelectorAll('.copy-button');
        var newWindow;
        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                var textToCopy = this.getAttribute('data-text');

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
                    btn.innerText = 'Copy';
                }, 2000);

                let result = false;
                var buttonsArray = Array.from(buttons);
                buttonsArray.some(function (button) {
                    if (button.href === "") {
                        result = true;
                        return true; // This will break the loop
                    }
                });

                if (!result) {
                    newWindow = window.open(this.href, '_blank');
                    this.removeAttribute('href');
                    this.removeAttribute('target');
                    return true;
                }
                this.removeAttribute('href');
                this.removeAttribute('target');
                newWindow.focus();
            });
        });
    </script>
</x-app-layout>
