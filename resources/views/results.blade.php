<div class="overflow-x-auto">
            <table class="table-auto border-collapse border border-white">
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
                    
                <tr>
                        <td class="border px-4 py-2">{{ $result->Casino }}</td>
                        <td class="border px-4 py-2">{{ $result->Host_Password }}</td>
                        <td class="border px-4 py-2">{{ $result->Zabbix_Password }}</td>
                        <td class="border px-4 py-2">{{ $result->HOST_1_2 }}</td>
                        <td class="border px-4 py-2">{{ $result->Router }}</td>
                        <td class="border px-4 py-2">{{ $result->NAS }}</td>
                        <td class="border px-4 py-2">{{ $result->CMS_IP }}</td>
                        <td class="border px-4 py-2">{{ $result->Floor_Name }}</td>
                        <td class="border px-4 py-2">
                            <a class="text-white hover:text-blue-500 underline" >Edit</a>
                        </td>
                        <td class="border px-4 py-2">
                            <a class="text-white hover:text-red-500 underline">Delete</a>
                        </td>
               </tr>
                
                </tbody>