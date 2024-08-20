<x-app-layout>
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-semibold mb-4">Installation Form</h2>
        <form action="/submit-new-installation" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- Name of Installation -->
            <div class="mb-4">
                <label for="installation_name" class="block text-gray-700 font-semibold mb-2">Name of Installation</label>
                <input type="text" id="installation_name" name="installation_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Enter installation name" required>
            </div>
            <!-- Password for Installation -->
            <div class="mb-4">
                <label for="installation_password" class="block text-gray-700 font-semibold mb-2">Password for Installation</label>
                <input type="password" id="installation_password" name="installation_password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Enter password" required>
            </div>
            <!-- Zabbix Password for Installation -->
            <div class="mb-4">
                <label for="zabbix_password" class="block text-gray-700 font-semibold mb-2">Zabbix Password for Installation</label>
                <input type="password" id="zabbix_password" name="zabbix_password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Enter Zabbix password" required>
            </div>
            <!-- IP of Installation -->
            <div class="mb-4">
                <label for="installation_ip" class="block text-gray-700 font-semibold mb-2">IP of Installation</label>
                <input type="text" id="installation_ip" name="installation_ip" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Enter installation IP" required>
            </div>
            <!-- IP of Router -->
            <div class="mb-4">
                <label for="router_ip" class="block text-gray-700 font-semibold mb-2">IP of Router</label>
                <input type="text" id="router_ip" name="router_ip" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Enter Router IP" required>
            </div>
            <!-- IP of NAS -->
            <div class="mb-4">
                <label for="nas_ip" class="block text-gray-700 font-semibold mb-2">IP of NAS</label>
                <input type="text" id="nas_ip" name="nas_ip" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Enter NAS IP" required>
            </div>
             <!-- IP of CMS -->
             <div class="mb-4">
                <label for="CMS_IP" class="block text-gray-700 font-semibold mb-2">IP of CMS</label>
                <input type="text" id="CMS_IP" name="CMS_IP" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Enter CMS IP" required>
            </div>
             <!-- Floor name -->
             <div class="mb-4">
                <label for="Floor_Name" class="block text-gray-700 font-semibold mb-2">FLoor name</label>
                <input type="text" id="Floor_Name" name="Floor_Name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Floor_Name" required>
            </div>
            <!-- Upload Certificates for Installation -->
            <div class="mb-4">
                <label for="certificates" class="block text-gray-700 font-semibold mb-2">Upload Certificates for Installation</label>
                <input type="file" id="certificates" name="certificates" class="w-full" accept=".zip" >
            </div>
            <!-- Upload PFSense Config for Installation -->
            <div class="mb-4">
                <label for="pfsense_config" class="block text-gray-700 font-semibold mb-2">Upload PFSense Config for Installation</label>
                <input type="file" id="pfsense_config" name="pfsense_config" class="w-full" accept=".xml" >
            </div>
            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-md">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
