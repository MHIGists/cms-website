<x-app-layout>
    <h1 class="text-white mt-5 mb-5">Backing up pfsense configs</h1>
    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
        <div id="refresh-box" class="bg-blue-500 h-2.5 rounded-full" style="width: 0"> 0%</div>
    </div>
    <script>
        function getContent() {
            // Make an AJAX request to the specified URL
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '{{route('getPFSenseBackups.progress')}}', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update the content of the div with ID "refresh-box"
                        var percent = Math.round(xhr.responseText * 100);
                        var el = document.getElementById('refresh-box')
                        el.innerHTML = percent + '%';
                        el.style.width = percent + '%';
                    } else {
                        console.error('Error:', xhr.status);
                    }
                }
            };
            xhr.send();
        }

        // Call getContent initially
        getContent();

        // Call getContent every 1 second
        setInterval(getContent, 1000);
    </script>
</x-app-layout>
