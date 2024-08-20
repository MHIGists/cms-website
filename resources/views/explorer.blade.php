<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4 text-white">{{ explode('/' ,$directory)[array_key_last(explode('/' ,$directory))] }}</h1>  @if (empty($directories) && empty($files))
            <p class="text-gray-500">No directories or files found</p>
        @else
            @if (!empty($directories))
                <h2 class="text-xl font-bold mb-3 text-white">Directories</h2>
                <ul class="list-group">
                    @foreach ($directories as $directory)
                        <li class="list-group-item text-white hover:bg-gray-300 dark:hover:text-gray-400">
                            <a href="/explorer/{{ $directory }}">{{ explode('/' ,$directory)[array_key_last(explode('/' ,$directory))] }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if (!empty($files))
                <h2 class="text-xl font-bold mb-3 text-white">Files</h2>
                <ul class="list-group text-white">
                    @foreach ($files as $file)
                        <li class="list-group-item text-white hover:bg-gray-300 dark:hover:text-gray-400">
                            <a href="/download/{{ $file }}">{{ explode('/' ,$file)[array_key_last(explode('/' ,$file))] }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endif
    </div>
    <script>
        // Get all li elements within the document
        var listItems = document.querySelectorAll('li');

        // Convert the NodeList to an array
        var itemsArray = Array.from(listItems);

        // Sort the array based on the third octet of the IP address
        itemsArray.sort((a, b) => {
            var ipA = a.textContent.split('.')[2];
            var ipB = b.textContent.split('.')[2];
            return parseInt(ipA, 10) - parseInt(ipB, 10);
        });

        // Clear the existing list items from the parent element
        var parent = listItems[0].parentNode; // Assuming all li elements share the same parent
        parent.innerHTML = '';

        // Append the sorted li elements back to the parent element
        itemsArray.forEach(item => parent.appendChild(item));

    </script>
</x-app-layout>
