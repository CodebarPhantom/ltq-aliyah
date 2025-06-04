@extends('layouts.main')

@section('content')
    <div class="container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-bold leading-none text-gray-900">
                    {{ $data['pageTitle'] }}
                </h1>
                {{-- <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                Central Hub for Personal Customization
            </div> --}}
            </div>
        </div>
    </div>
    <div class="container-fixed">
        <div class="flex flex-col justify-center gap-1 rounded-lg p-4 bg-primary-light">
            <h3 class="text-md leading-none font-semibold text-gray-900">
                Welcome !
            </h3>
            <p class="text-gray-700 text-2sm font-normal">
                Selamat Datang {{ Auth::User()->name }}
            </p>
        </div>
    </div>

    <div class="container-fixed mt-4">
        <!-- Calendar Header -->
        <div class="flex items-center justify-between mb-4">
            <button id="prevMonth" class="p-2 btn btn-primary "><i class="ki-filled ki-double-left-arrow"></i>
                Previous</button>
            <h2 id="monthName" class="text-xl font-bold"></h2>
            <button id="nextMonth" class="p-2 btn btn-primary ">Next <i class="ki-filled ki-double-right-arrow"></i></button>
        </div>
        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-1 text-center text-sm">
            <!-- Days of Week -->
            <div class="font-bold">Minggu</div>
            <div class="font-bold">Senin</div>
            <div class="font-bold">Selasa</div>
            <div class="font-bold">Rabu</div>
            <div class="font-bold">Kamis</div>
            <div class="font-bold">Jumat</div>
            <div class="font-bold">Sabtu</div>
        </div>
        <div id="dates" class="grid grid-cols-7 gap-1 text-sm">
            <!-- Calendar days will be dynamically added here -->
        </div>

    </div>

    {{-- <div class="container-fixed flex flex-col items-center justify-center h-1/2 mt-2">
        <img src="{{ asset('assets/media/illustrations/22.svg') }}" alt="Dashboard Coming Soon" class="w-1/2 h-1/2">
        <h3 class="text-lg font-semibold text-gray-900 mt-4">
            Coming Soon!
        </h3>
    </div> --}}
@endsection

@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.9.6/plugin/isBetween.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // Current month and year
        let currentMonth = dayjs().month();
        let currentYear = dayjs().year();

        // Dummy data for testing
        const dummyData = {
            "calendars": [{
                "start_date": "2025-01-01",
                "end_date": "2025-01-01",
                "note": "Libur Nasional",
                "color": "success"
            }, {
                "start_date": "2025-01-01",
                "end_date": "2025-01-01",
                "note": "Izin",
                "color": "success"
            }]

        };

        // Extend Day.js with isBetween plugin
        dayjs.extend(window.dayjs_plugin_isBetween);

        // Fetch data and render calendar
        async function fetchMonthData(year, month) {
            try {
                // Replace with your API call
                const attendanceMonthUrl = "{{ route('api.v1.dashboard.attendance-month') }}";
                const response = await axios.get(`${attendanceMonthUrl}?year=${year}&month=${month + 1}`);
                console.log(response.data.data.calendars);
                renderCalendar(response.data.data.calendars, year, month);
                //renderCalendar(dummyData.calendars, year, month); // Using dummy data
            } catch (error) {
                console.error("Error fetching calendar data:", error);
            }
        }

        // Render the calendar
        function renderCalendar(events, year, month) {
            const monthName = document.getElementById("monthName");
            const datesContainer = document.getElementById("dates");
            monthName.textContent = dayjs(new Date(year, month)).format("MMMM YYYY");

            const firstDayOfMonth = dayjs(new Date(year, month, 1)).day();
            const totalDaysInMonth = dayjs(new Date(year, month + 1, 0)).date();
            const daysArray = [];

            // Add leading blank days for the first week
            for (let i = 0; i < firstDayOfMonth; i++) {
                daysArray.push({
                    date: null,
                    events: []
                });
            }

            // Add days of the current month
            for (let i = 1; i <= totalDaysInMonth; i++) {
                daysArray.push({
                    date: dayjs(new Date(year, month, i)),
                    events: []
                });
            }

            // Add trailing blank days to complete the grid (42 cells)
            const trailingDays = 42 - daysArray.length;
            for (let i = 1; i <= trailingDays; i++) {
                daysArray.push({
                    date: dayjs(new Date(year, month + 1, i)),
                    events: []
                });
            }

            // Map events to their respective days
            events.forEach(event => {
                const startDate = dayjs(event.start_date);
                const endDate = dayjs(event.end_date);
                daysArray.forEach(day => {
                    if (day.date && day.date.isBetween(startDate, endDate, "day", "[]")) {
                        day.events.push(event);
                    }
                });
            });
            // Render calendar
            datesContainer.innerHTML = "";
            daysArray.forEach(day => {
                const dayElement = document.createElement("div");
                dayElement.className = `relative w-full flex flex-col justify-start items-start border min-h-16 ${
                    day.date ? "bg-gray-50" : "bg-gray-200"
                    }`;

                if (day.date) {
                    const dateLabel = document.createElement("div");
                    dateLabel.className = "text-xs text-gray-700";
                    dateLabel.textContent = day.date.date();
                    dayElement.appendChild(dateLabel);

                    day.events.forEach((event, index) => {
                        const eventBlock = document.createElement("div");
                        eventBlock.className = `mt-1 w-full text-xs text-white rounded p-1 bg-${event.color }`;
                        eventBlock.style.zIndex = index + 1;
                        eventBlock.textContent = event.note;
                        dayElement.appendChild(eventBlock);
                    });
                }

                datesContainer.appendChild(dayElement);
            });
        }


        // Event listeners for navigation
        document.getElementById("prevMonth").addEventListener("click", () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            fetchMonthData(currentYear, currentMonth);
        });

        document.getElementById("nextMonth").addEventListener("click", () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            console.log(currentYear, currentMonth);
            fetchMonthData(currentYear, currentMonth);
        });

        // Initial fetch
        fetchMonthData(currentYear, currentMonth);
    </script>
@endpush
