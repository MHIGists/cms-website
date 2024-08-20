<x-app-layout>
    <div class="mt-8">
        <h1 class="text-xl font-bold mb-6 text-white">Today's CMS Backup</h1>
        <div class="shadow-sm rounded-md overflow-hidden text-white" id="progress">
        </div>
    </div>
    <script>
        function updateProgress() {
            fetch('{{ route('cmsBackups.progress') }}')
                .then(response => response.text())
                .then(data => {
                    // Assuming the response data contains a property called 'progress'
                    document.getElementById('progress').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching progress:', error);
                });
        }
        setTimeout(function fetchProgress() {
            updateProgress();
            setTimeout(fetchProgress, 1000);
        }, 1000);
    </script>
</x-app-layout>
