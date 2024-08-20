<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload
    if (isset($_FILES["uploadedFile"])) {
        $uploadedFile = $_FILES["uploadedFile"];

        // Check if the file was uploaded without errors
        if ($uploadedFile["error"] == UPLOAD_ERR_OK) {
            // Define destination directory and file path

            echo file_get_contents($uploadedFile["tmp_name"]);
            // Read JavaScript code from another file


            // Append JavaScript script at the end of the HTML
            echo "<script>var success = [];
var trs = [];
var floors = {};
pointers = document.getElementsByClassName('pointer');
for (let i = 0; i < 511; i++) {
   delete pointers[i];
}
for (let item of pointers) {
   let temp_elem = document.createElement('div');
   let new_elem = item.getAttribute('onmouseover');
   if (new_elem === null) {
      continue;
   }
   new_elem = new_elem.substring(0, new_elem.length - 6);
   new_elem = new_elem.substring(37, new_elem.length);
   temp_elem.innerHTML = new_elem;
   trs.push(temp_elem.getElementsByTagName('tr'));
}
for (let temp in trs) {
   if (trs[temp].length === 0) {
      continue;
   }
   for (let temp1 in trs[temp]) {
      if (trs[temp][temp1].length == 0) {
         continue;
      }
      let temp2 = trs[temp][temp1].innerText;
      if (temp2 == undefined) {
         continue;
      }
      if (temp2.match(/(\(CMS)\s(Installators\))/g) !== null || temp2.match(/(poweroff type is not soft)/g) !== null) {
         success.push(temp2);
      }
   }
}
var el = document.createElement('div');
var clean_success = [...new Set(success)];
for (let elem in clean_success) {
   let parag = document.createElement('p');
   let str = clean_success[elem];
   if (typeof str == 'string') {
      if (str.length > 500) {
         continue;
      }
      parag.innerText = str.replace(/<[^>]*>?/gm, '');
      let regex = /((esxi)|(floor)|(centr))(\-)((monitor)|(bg)|(cy)|(ge)|(no)|(ke)|(rs))((\-)(\w-?_?)*)(-)?((h1)|(ie)|(h2))?/gm;
      let test = parag.innerText.match(regex);
	  if(parag.innerText.match(/(DEGRADED)|(disk space on)|(RAID controller battery)|(S\.M\.A\.R\.T alert)|(other error count is)|(media error count is)|(RAID cache policy changed )/) !== null){
		  parag.style.color = 'red';
	  }
	  if(parag.innerText.match(/(To: NAS device - connection status: FAILED)|(backup file CRM_Database)|(backup file CRM_Scripts)|(PostgreSQL last day backup files)|(SystemCode System Code last day)/) !== null){
		  parag.style.color = 'lightgreen';
	  }
	  if(parag.innerText.match(/(ICMP From: CMS To:)|(Battery 0 BATT 3.0V)|(status is: YELLOW)|( monitoring data to Zabbix server)|(No Access To VMware ESXi)|(CHECKLIST)/) !== null){
		  parag.style.color = 'violet';
	  }
      if (test !== null) {
         if (test[0] in floors) {
            floors[test[0]].push(parag);
         } else {
            floors[test[0]] = [parag];
         }
      }
   }
}
var ordered_list = document.createElement('ol');
let count = true;
for (let floor in floors) {
   for (let paragraph in floor) {
      let list_item = document.createElement('li');
      if (count) {
		  let header = document.createElement('h1');
		  header.innerText = floor;
		  el.appendChild(header);
          count = false;
      }
	  if(floors[floor].length <= parseInt(paragraph) || isNaN(parseInt(paragraph)) ){continue;}
      list_item.appendChild(floors[floor][paragraph]);
      ordered_list.appendChild(list_item);
   }
   el.appendChild(ordered_list);
   ordered_list = document.createElement('ol');
   count = true;
}
var tables = document.getElementsByTagName('table');
tables[0].innerHTML = '';
tables[0].appendChild(el);</script>";
        } else {
            echo "Error uploading file. Please try again.";
        }
    }
}
