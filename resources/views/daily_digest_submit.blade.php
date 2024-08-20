<x-app-layout>
    <h2 class="text-2xl font-bold mb-6">Daily Digest Submission Form</h2>
    <form action="{{ route('dailyDigest.result') }}" method="post" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="text" value="" hidden>
        <div class="flex flex-col">
            <label for="fileUpload" class="text-sm font-medium text-gray-700">Choose a file:</label>
            <div class="mt-1 flex items-center">
                <input type="file" id="fileUpload" name="uploadedFile" class="w-full rounded-md border border-gray-300 px-3 py-2 text-base leading-normal focus:outline-none focus:ring-1 focus:ring-blue-500">
                <span class="ml-2 text-gray-600 text-sm">.html files only</span>
            </div>
        </div>
        <button type="submit" class="py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400">Submit File</button>
    </form>
    <script>
        function generateFloorErrors() {
            let checkFloorErrors = document.getElementById('FloorErrors');
            if (checkFloorErrors != null){
                checkFloorErrors.remove();
            }

            // Create a div element to contain all label elements for the current host
            let hostDiv = document.createElement('div');
            hostDiv.id = 'FloorErrors';
            for (let hostName in floors) {
                if (floors.hasOwnProperty(hostName)) {
                    // Create an h1 element for each host name
                    let h1Element = document.createElement('h1');
                    h1Element.textContent = hostName;

                    // Append the h1 element to the container
                    hostDiv.appendChild(h1Element);

                    // Iterate through errors for the current host
                    floors[hostName].forEach(error => {
                        // Create a label for the checkbox
                        let labelElement = document.createElement('label');

                        // Create a checkbox element for each error and wrap it inside the label
                        let checkboxElement = document.createElement('input');
                        checkboxElement.type = 'checkbox';
                        checkboxElement.value = error;

                        // Add an event listener to the checkbox to toggle the strikethrough style
                        checkboxElement.addEventListener('change', function () {
                            if (checkboxElement.checked) {
                                labelElement.style.textDecoration = 'line-through';
                            } else {
                                labelElement.style.textDecoration = 'none';
                            }
                        });

                        // Set the label text content
                        labelElement.textContent = error;

                        // Disable text selection when clicking the checkbox
                        labelElement.addEventListener('mousedown', function (event) {
                            event.preventDefault();
                        });

                        // Append the checkbox to the label
                        labelElement.appendChild(checkboxElement);

                        // Append the label to the hostDiv
                        hostDiv.appendChild(labelElement);
                        hostDiv.appendChild(document.createElement('br'));
                    });

                    // Append the hostDiv to the container
                    cms_view.appendChild(hostDiv);
                }
            }
        }


        function generateFloorErrorsArray(){
            floors = [];
            for (let i = 2; i < trs.length; i++) {
                if(excluded_errors.includes(trs[i].cells[9].innerText.trim())){
                    continue;
                }
                let hosts = trs[i].cells[7].textContent;
                let hostsArrayDirty = hosts.split(', ');
                let hostsArray = hostsArrayDirty.map(str => str.replace(/[\s"]/g, ''));

                let hosts_to_add_error = [];
                for (let j = 0; j < hostsArray.length; j++) {
                    let hostName = hostsArray[j];

                    if (!floors.hasOwnProperty(hostName)) {
                        floors[hostName] = [];
                    }
                    hosts_to_add_error.push(hostName);
                }
                let error = trs[i].cells[9].innerText;
                hosts_to_add_error.forEach(host => {
                    floors[host].push(error);
                });
            }
        }

        let table = document.getElementById("tbrep_table_1");
        let trs = table.getElementsByTagName("tr");
        let floors = [];
        let excluded_errors = [
            "SUPP2 @VIRT/VMware/GuestVM CHECKLIST Memory reservation must be set equal to VM RAM!",
            "SUPP2 @VIRT/VMware/Guest [PFSense] provisioning for device Hard disk 1 is not thick",
            "SUPP2 @BACKUP CHECKLIST NO backups configured for this host!",
            "SUPP2 @VIRT/VMware/ESXiHypervisor Hypervisor monitoring NOT WORKING (SSH: ESXI-MONITOR can't connect to ESXi hypervisor)",
            "SUPP2 @CMS/Services Application services are not fully active [cms] : ({...})",
            "SUPP2 @CMS/Services Application services are not fully active [jp] : ({...})",
            "SUPP2 @CMS/Inst No Access To VMware ESXi",
            "SUPP2 @CMS/SMIBServer App Services Messages (From Audit) ({...}) (last 1 min.) [App Name:CMS,Subsystem: SMIBServer, Level: err, Endpoint: SMIBServer]",
            "SUPP2 @CMS/SMIBServer Configuration problems (From Audit) ({...}) (last 1 min.) [App Name:CMS,Subsystem: SMIBServer, Level: err, Endpoint: SMIBServer]",
            "SUPP2 @CMS/Inst Unapplied VMware ESXi security updates from {...} days",
            "SUPP2 @TBMON/Services Application services are not fully active [tbmon] : ({...})",
            "SUPP2 @CMS/Inst Unapplied OS Security updates from {...} days",
            "SUPP2 @APP/Inst CMS version is not supported",
            "SUPP2 @CMS/Inst CMS version is not supported",
            "SUPP2 @CMS/Inst VMware ESXi version is not supported",
            "SUPP2 @CMS/Inst CMS installed version difference in application host cluster",
            "SUPP2 @CMS/Inst No Access To VMware ESXi",
            "SUPP2 @CMS/Inst CHECKLIST not completed: CMS VM RAM must be set to maximum (server physical RAM - 6 GB)",
            "SUPP2 @APP/Services scheduled job Version Monitoring is in failed",
            "SUPP2 @TBMON/Services scheduled job Version Monitoring is in failed",
            "SUPP2 @TBMON/Services [Version Monitoring Timer] is not running",
            "SUPP2 ERROR PERF @SYS/Web/nginx Duration Per Request cmsfront has increased over 30% [last 1d to avg 7d] (custom)",
            "SUPP2 ERROR PERF @SYS/Web/nginx Duration Per Request cmsfront is over 100ms [last 1 h.] (custom)",
            "SUPP2 ERROR PERF @SYS/Web/nginx Total Error Responses [499*,5xx] cmsfront is over 1% [last 1 min] (custom)",
            "SUPP2 @APP/Services [apache2] is not running",
            "SUPP2 @APP/Services [tblib-master] is not running",
            "SUPP2 @APP/Inst Operating system package files are not authentic",
            "SUPP2 @TBMON/Services [pg-index-maintenance] is not running",
            "SUPP2 @APP/Services pg-index-maintenance has been restarted",
            "SUPP2 @TBMON/Services apache2 has been restarted",
            "SUPP2 @CMS/Inst CHECKLIST not completed: CMS image is not up-to-date",
            "SUPP2 @CMS/Inst Unapplied Minor feature updates from {...} days",
            "SUPP2 @TBMON/Services scheduled job get-cms-images-from-centr failed",
            "SUPP2 @CMS/SMIBServer App Services Messages (From Audit) ({...}) (last 1 min.) [App Name:CMS,Subsystem: SMIBServer, Level: warn, Endpoint: SMIBServer]",
            "SUPP2 @VIRT/VMware/ESXi/Hypervisor EVENT Error event logged: {...}",
            "SUPP2 @CMS/Inst JP Machine Reject events over 1: {...} (last 1 hour) [api:pg_view] [floor1] [monitoring_cms_floor_1hour]",
            "SUPP2 @CMS/Inst No Access To VMware ESXi for more than 30 days",
            "SUPP2 @APP/Services apache2 has been restarted",
            "SUPP2 ERROR PERF @SYS/Web/nginx Total Requests Per Second cmsfront2hosts is over 5 [last 1 h.] (custom)",
            "SUPP2 @TBMON/Services wide-area-support has been restarted",
            "SUPP2 @TBMON/Services apache2-bo has been restarted",
            "SUPP2 @APP/Services apache2-bo has been restarted",
            "SUPP2 @APP/Services [pg-index-maintenance] is not running",
            "SUPP2 @APP/Services [apache2-bo] is not running",
            "SUPP2 @APP/Services scheduled job apache2.service failed",
            "SUPP2 @TBMON/Services scheduled job send-cms-images-to-centra failed",
            "SUPP2 @APP/Services collect-and-calc-player-l has been restarted",
            "SUPP2 @CMS/Inst Unapplied Minor fix updates from {...} days",
            "SUPP2 @TBMON/Services scheduled job apache2-bo.service failed",
            "SUPP2 @TBMON/Services [apache2] is not running",
            "SUPP2 @APP/Services scheduled job apache2-bo.service failed",
            "SUPP2 @TBMON/Services scheduled job Firewall Sync [XFirewall] failed",
            "SUPP2 @CMS/Inst/ Application version components are not authentic",
            "SUPP2 ERROR PERF @APP/Services/Central Interface cms-central/ HTTP request timed out [ 1 request * 10 sec. ]",
            "SUPP2 @TBMON/Services [apache2-bo] is not running",
            "SUPP2 @TBMON/Services pg-index-maintenance has been restarted",
            "SUPP2 @TBMON/Services scheduled job apache2.service failed",
            "SUPP2 @TBMON/Services pg-index-maintenance has been restarted",
            "SUPP2 @VIRT/VMware missing/invalid SSH certificate",
            "SUPP2 @VIRT/VMware missing/invalid SSH certificate",
            "SUPP2 @VIRT/VMware/ESXi/Hypervisor EVENT Warning event logged: {...}",
            "SUPP2 DEFERRED @VIRT/VMware/ESXiHypervisor Host sensor VirtualMachineSummary.VirtualMachineQuickStats.ManagedEntityStatus status is: YELLOW",
            "SUPP2 @APP/Services scheduled job send-cms-images-to-centra failed",
            "SUPP2 @APP/Services scheduled job get-cms-images-from-centr failed",
            "SUPP2 @VIRT/VMware/ESXiHypervisor ESXi hypervisor needs 4 GB physical memory (decrease RAM from VMs)!",
            "SUPP2 @VIRT The host is not sending monitoring data to Zabbix server (last 2 hours.)",
            "SUPP2 @TBMON/Services [tblib-master] is not running",
            "SUPP2 @APP/Services wide-area-support has been restarted",
            "SUPP2 @TBMON/Services scheduled job Authentication Log To Mon failed",
            "SUPP2 @HW/LSIMegaRAID/ESXiHypervisor Firmware fault / resetting adapter message found in /var/log/vmkwarning.log (last 1 min.)",
            "SUPP2 @APP/Services scheduled job Authentication Log To Mon failed"
        ]
        generateFloorErrorsArray();

        let cms_view = document.createElement('div');

        let excluded_errors_warning = document.createElement('h1');
        excluded_errors_warning.innerText = 'Those errors are NOT shown below'
        excluded_errors_warning.align = 'center';
        cms_view.appendChild(excluded_errors_warning);

        let ulElement = document.createElement('ul');

        excluded_errors.forEach(error => {
            let liElement = document.createElement('li');

            // Create a label for the checkbox
            let labelElement = document.createElement('label');

            // Create a checkbox element for each error and wrap it inside the label
            let checkboxElement = document.createElement('input');
            checkboxElement.type = 'checkbox';
            checkboxElement.value = error;
            checkboxElement.checked = true;

            // Add an event listener to the checkbox to toggle the strikethrough style
            checkboxElement.addEventListener('change', function () {
                if (checkboxElement.checked) {
                    labelElement.style.textDecoration = 'line-through';
                    excluded_errors.push(error);
                    generateFloorErrorsArray();
                    generateFloorErrors();
                } else {
                    labelElement.style.textDecoration = 'none';
                    let index = excluded_errors.indexOf(error);
                    if (index !== -1) {
                        excluded_errors.splice(index, 1);
                        generateFloorErrorsArray();
                        generateFloorErrors();
                    }
                }
            });

            // Set the label text content
            labelElement.textContent = error;
            labelElement.style.textDecoration = 'line-through';

            labelElement.addEventListener('mousedown', function (event) {
                event.preventDefault();
            });

            // Append the checkbox to the label
            labelElement.appendChild(checkboxElement);

            // Append the label to the list item
            liElement.appendChild(labelElement);

            // Append the list item to the unordered list
            ulElement.appendChild(liElement);
        });


        cms_view.appendChild(ulElement);

        // Assuming floors is an object with host names as keys and arrays of errors as values
        // and containerElement is the HTML element where you want to append the content

        generateFloorErrors();

        cms_view.hidden = true;
        cms_view.style.textAlign = 'center';
        document.body.appendChild(cms_view);

        //Create button child and add listener
        let button_cms = document.createElement('button');
        let button_telebid = document.createElement('button');

        button_cms.innerText = 'CMS View';
        button_telebid.innerText = 'Telebid View';

        button_cms.addEventListener('click', function() {
            table.hidden = true;
            cms_view.hidden = false;
        });
        button_telebid.addEventListener('click', function() {
            table.hidden = false;
            cms_view.hidden = true;
        });
        let parentElement = document.body;
        parentElement.insertBefore(button_telebid, parentElement.firstChild);
        parentElement.insertBefore(button_cms, parentElement.firstChild);


    </script>
</x-app-layout>
