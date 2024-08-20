<x-app-layout>
<?php
$people_names = $_GET['personName'];
$people_days_to_work = $_GET['daysToWork'];
$people_days_free = $_GET['daysFree'];
// Function to generate work schedule for a given month
function getPersonWorkDay(array $person_Data){
    if ($person_Data['work_days'] > 0){
        if ($person_Data['work_days'] > 2){
            $person_Data['result'] = 'Д';
        }else{
            $person_Data['result'] = 'Н';
        }
        $person_Data['work_days']--;
    }else{
        $person_Data['result'] = ' ';
        $person_Data['days_off']--;
    }
    if ($person_Data['days_off'] == 0){
        $person_Data['work_days'] = 4;
        $person_Data['days_off'] = 4;
    }
    return $person_Data;
}
function generateWorkSchedule($monthStartDate, $people_names, $people_days_to_work, $people_days_free, $previousMonthData = null)
{
    $schedules = [];
    $work_off_days = [];
    foreach ($people_names as $index => $person_name) {
        $schedules[$person_name] = [];
        $work_off_days[$person_name] = ['work_days' => $people_days_to_work[$index], 'days_off' => $people_days_free[$index]];
    }

// Calculate the number of days in the specified month
    $daysInMonth = (int)$monthStartDate->format('t');
    foreach ($schedules as $index => $person) {
        $schedules[$index] = array_fill(1, $daysInMonth, '');
    }
    if ($previousMonthData != null) {
        $work_off_days = $previousMonthData;
    }
    $people = array_keys($schedules);
    for ($i = 1; $i <= $daysInMonth; $i++) {
        foreach ($people as $person) {
            $result = getPersonWorkDay($work_off_days[$person]);
            $schedules[$person][$i] = $result['result'];
            $work_off_days[$person] = $result;
        }
    }

    // HTML table with Bootstrap classes for styling
    echo "<div class='container mt-4'><h2 class='mb-4 text-2xl font-semibold'>Work Schedule for " . $monthStartDate->format('F Y') . "</h2><table class='table-auto border-separate border border-white'><thead class='bg-gray-200'><tr><th class='px-4 py-2'>Човек/Ден</th>";

    // Display day numbers as column headers
    for ($day = 1; $day <= $daysInMonth; $day++) {
        echo "<th>$day</th>";
    }

    echo "</tr></thead><tbody>";

    // Display each person's schedule as rows in the table
    foreach ($schedules as $person => $schedule) {
        echo "<tr><td>$person</td>";
        foreach ($schedule as $day) {
            echo "<td>$day</td>";
        }
        echo "</tr>";
    }

    echo "</tbody></table><button class='btn'>Export</button></div>";
    // Return the data to carry over to the next month
    $work_off_days['people_names'] = $people_names;
    $work_off_days['people_days_to_work'] = $people_names;
    $work_off_days['people_days_free'] = $people_names;
    return $work_off_days;
}

// Get the current date
$currentDate = new DateTime();

// Calculate the start date for the current month
$currentMonthStartDate = new DateTime($currentDate->format('Y-m-d'));
$currentMonthStartDate->modify('first day of this month');

// Generate work schedule table for the current month and get data for the next month
$currentMonthData = generateWorkSchedule($currentMonthStartDate, $people_names, $people_days_to_work, $people_days_free);

// Calculate the start date for the next month
$nextMonthStartDate = new DateTime($currentDate->format('Y-m-d'));
$nextMonthStartDate->modify('first day of next month');

// Generate work schedule table for the next month, continuing from the previous month
generateWorkSchedule($nextMonthStartDate, $currentMonthData['people_names'], $currentMonthData['people_days_to_work'],$currentMonthData['people_days_free'], $currentMonthData);
?>
<script type="text/javascript">
    function printDiv(divID) {
        //Get the HTML of div
        let divElements = divID.innerHTML;
        //Get the HTML of whole page
        let oldPage = document.body.innerHTML;
        //Reset the page's HTML with div's HTML only
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
            divElements + "</body>";
        //Print Page
        window.print();
        //Restore orignal HTML
        document.body.innerHTML = oldPage;

    }
    // Your JavaScript code here
    let buttons = document.getElementsByClassName('btn');
    let tables = document.getElementsByTagName('div');
    buttons[0].addEventListener('click', function (){
        printDiv(tables[0]);
    });
    buttons[1].addEventListener('click', function (){
        printDiv(tables[1]);
    });

</script>
</x-app-layout>
