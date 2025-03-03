<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
        <div class="bg-blue-500 text-white p-6 rounded-2xl shadow-md flex items-center gap-4">
            <i class="ri-admin-line text-3xl"></i>
            <div>
                <h2 class="text-xl font-semibold"># of Admins</h2>
                <p class="text-lg" id="adminsCount">10</p>
            </div>
        </div>

        <div class="bg-blue-400 text-white p-6 rounded-2xl shadow-md flex items-center gap-4">
            <i class="ri-stethoscope-line text-3xl"></i>
            <div>
                <h2 class="text-xl font-semibold"># of Doctors</h2>
                <p class="text-lg" id="doctorsCount">25</p>
            </div>
        </div>

        <div class="bg-blue-600 text-white p-6 rounded-2xl shadow-md flex items-center gap-4">
            <i class="ri-nurse-line text-3xl"></i>
            <div>
                <h2 class="text-xl font-semibold"># of Nurses</h2>
                <p class="text-lg" id="nursesCount">40</p>
            </div>
        </div>

        <div class="bg-blue-700 text-white p-6 rounded-2xl shadow-md flex items-center gap-4">
            <i class="ri-user-heart-line text-3xl"></i>
            <div>
                <h2 class="text-xl font-semibold"># of Midwives</h2>
                <p class="text-lg" id="midwivesCount">15</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-md mt-4">
        <h2 class="text-xl font-semibold mb-2">Statistical Data</h2>
        <canvas id="statsChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('statsChart').getContext('2d');

        const data = {
            labels: ['Admins', 'Doctors', 'Nurses', 'Midwives'],
            datasets: [{
                label: 'Count',
                data: [10, 25, 40, 15], // Static Data
                backgroundColor: ['#10B981', '#34D399', '#059669', '#065F46'], // Green Shades
                borderColor: ['#047857', '#065F46', '#064E3B', '#022C22'], // Darker Green Borders
                borderWidth: 1
            }]
        };

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</div>
