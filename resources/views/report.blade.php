<x-content>
    <x-slot name="title">
        {{ __('Report') }}
    </x-slot>

    <div style="width: 80%; margin: 0 auto;">
        <canvas id="areaChart"></canvas>
    </div>

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Sample data for the chart
            var data = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Estimation",
                        data: [10, 20, 15, 25, 30, 20, 35],
                        backgroundColor: 'rgba(255, 223, 0, 0.5)', // Yellow fill
                        borderColor: 'rgba(255, 223, 0, 1)',
                        borderWidth: 1,
                        fill: true,
                    },
                    {
                        label: "Reality",
                        data: [15, 10, 25, 20, 30, 25, 40],
                        backgroundColor: 'rgba(0, 0, 255, 0.5)', // Blue fill
                        borderColor: 'rgba(0, 0, 255, 1)',
                        borderWidth: 1,
                        fill: true,
                    },
                ]
            };

            // Create the chart
            var ctx = document.getElementById('areaChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </x-slot>
</x-content>
