<x-app-layout>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    </style>
    <div class="space-y-4 text-center mt-5">
        <!-- Link to backups directory -->
        <a href="/explorer/public/pfsenseBackups"
           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">
            Open PFSense Backups
        </a>

        <!-- Link to backups directory -->
        <a href="{{route('getPFSenseBackups.get')}}"
           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">
            Get PFSense Backups
        </a>

        <!-- Link to generateFLSSchedule.php -->
        <a href="{{route('fls.form.submit')}}"
           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">
            Generate FLS Schedule
        </a>

        <!-- Link to dailyDigest.php -->
        <a href="{{route('dailyDigest.submit')}}"
           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">
            CMS Daily Digest
        </a>

        <!-- Link to certificates directory-->
        <a href="/explorer/public/vpnCertificates"
           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">
            VPN Certificates
        </a>

        <!-- Link to ISO-Random-Files directory-->
        <a href="/explorer/public/isoRandomFiles"
           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">
            ISO-Random-Files
        </a>

{{--        <!-- Link to PFSense Stats-->--}}
{{--        <a href="pfsenseStats/"--}}
{{--           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">--}}
{{--            PFSense Stats--}}
{{--        </a>--}}

        <!-- Link to BackupScript-->
        <a href="{{route('cmsBackups.showContent')}}"
           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">
            Today's backup
        </a>

        <a href="/explorer/public/cmsBackups"
           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">
            Backups by dates
        </a>
        <a href="{{route('get.table')}}"
           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">
            Open CMS Table
        </a>
        <a href="{{route('new.installation')}}"
           class="block py-3 px-4 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out cms-link mx-auto">
            Add new CMS installation
        </a>
    </div>

</x-app-layout>


