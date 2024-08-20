@if(!$dailyBackup)
    <a href="{{ route('startBackup')}}"
       class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded loading-button">
        Do a Backup check
    </a>
@endif
<div class="p-4">
    @if (isset($fileContents))
        @foreach($fileContents as $ip => $content)
            @if ($ip == 'progress')
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mb-4">
                    <div id="refresh-box" class="bg-blue-500 h-2.5 rounded-full" style="width: {{$content}}%"> {{$content}}%</div>
                </div>
                @continue
            @endif
            @if(is_array($content))
                <h3 class="text-lg font-bold mb-2 inline-block">{{$ip}}</h3>
                <a href="https://{{$ip}}" class="ml-4 btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" target="_blank">Check NAS</a>
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                    @foreach($content as $message)
                        @php
                            preg_match('/floor-(.*?)\s/', $message, $matches);
                            $floorName = isset($matches[1]) ? $matches[1] : '';
                        @endphp
                        <li class="px-4 py-2 dark:hover:bg-violet-900 text-white">{{$message}}</li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    @endif
</div>
