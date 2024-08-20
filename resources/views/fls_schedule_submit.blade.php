<x-app-layout>
    <div class="container mx-auto mt-5 text-white">
        <h2 class="text-2xl font-bold mb-4">Information Form</h2>
        <form action="{{route('fls.schedule.result')}}" method="GET" id="infoForm">
            <div id="peopleFields">
                <div class="mb-6">
                    <label for="person1Name" class="block mb-1">Person 1's Name</label>
                    <input type="text" class="form-input w-full bg-black" id="person1Name" name="personName[]" required>
                    <div class="flex mt-2">
                        <div class="w-1/2 pr-2">
                            <label for="person1DaysToWork" class="block mb-1">Days Left to Work</label>
                            <input type="number" class="form-input w-full bg-black" id="person1DaysToWork" name="daysToWork[]" required>
                        </div>
                        <div class="w-1/2 pl-2">
                            <label for="person1DaysFree" class="block mb-1">Days Left Free</label>
                            <input type="number" class="form-input w-full bg-black" id="person1DaysFree" name="daysFree[]" required>
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="person2Name" class="block mb-1">Person 2's Name</label>
                    <input type="text" class="form-input w-full bg-black" id="person2Name" name="personName[]" required>
                    <div class="flex mt-2">
                        <div class="w-1/2 pr-2">
                            <label for="person2DaysToWork" class="block mb-1">Days Left to Work</label>
                            <input type="number" class="form-input w-full bg-black" id="person2DaysToWork" name="daysToWork[]" required>
                        </div>
                        <div class="w-1/2 pl-2">
                            <label for="person2DaysFree" class="block mb-1">Days Left Free</label>
                            <input type="number" class="form-input w-full bg-black" id="person2DaysFree" name="daysFree[]" required>
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="person3Name" class="block mb-1">Person 3's Name</label>
                    <input type="text" class="form-input w-full bg-black" id="person3Name" name="personName[]" required>
                    <div class="flex mt-2">
                        <div class="w-1/2 pr-2">
                            <label for="person3DaysToWork" class="block mb-1">Days Left to Work</label>
                            <input type="number" class="form-input w-full bg-black" id="person3DaysToWork" name="daysToWork[]" required>
                        </div>
                        <div class="w-1/2 pl-2">
                            <label for="person3DaysFree" class="block mb-1">Days Left Free</label>
                            <input type="number" class="form-input w-full bg-black" id="person3DaysFree" name="daysFree[]" required>
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="person4Name" class="block mb-1">Person 4's Name</label>
                    <input type="text" class="form-input w-full bg-black" id="person4Name" name="personName[]" required>
                    <div class="flex mt-2">
                        <div class="w-1/2 pr-2">
                            <label for="person4DaysToWork" class="block mb-1">Days Left to Work</label>
                            <input type="number" class="form-input w-full bg-black" id="person4DaysToWork" name="daysToWork[]" required>
                        </div>
                        <div class="w-1/2 pl-2">
                            <label for="person4DaysFree" class="block mb-1">Days Left Free</label>
                            <input type="number" class="form-input w-full bg-black" id="person4DaysFree" name="daysFree[]" required>
                        </div>
                    </div>
                </div>
                <!-- Repeat for person 2, 3, 4 -->
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Submit</button>
        </form>
    </div>
</x-app-layout>
