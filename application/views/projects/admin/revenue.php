<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-[#00204a]">Revenue Analytics</h1>
            <p class="text-sm text-gray-500 font-medium">Track your platform earnings every day and every hour.</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50 transition-all">
                <i class="fa-solid fa-download mr-2"></i> Export Report
            </button>
            <button class="bg-[#d4af37] text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg shadow-yellow-500/20 hover:scale-105 transition-all">
                <i class="fa-solid fa-plus mr-2"></i> Add Transaction
            </button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-coins"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Today's Revenue</p>
                    <p class="text-2xl font-black text-gray-900">₹<?= number_format($kpis['today']) ?></p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs font-bold text-emerald-600">
                <i class="fa-solid fa-arrow-trend-up"></i>
                <span>+12.5% from yesterday</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Monthly Target</p>
                    <p class="text-2xl font-black text-gray-900">₹<?= number_format($kpis['month']) ?></p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs font-bold text-blue-600">
                <i class="fa-solid fa-chart-line"></i>
                <span>75% of goal reached</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-vault"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Total Earnings</p>
                    <p class="text-2xl font-black text-gray-900">₹<?= number_format($kpis['total']) ?></p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs font-bold text-purple-600">
                <i class="fa-solid fa-user-check"></i>
                <span><?= number_format($kpis['count']) ?> Transactions</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Avg. Transaction</p>
                    <p class="text-2xl font-black text-gray-900">₹<?= number_format($kpis['avg']) ?></p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs font-bold text-rose-600">
                <i class="fa-solid fa-bolt"></i>
                <span>Premium Value</span>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Hourly Tracking -->
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-xl shadow-gray-100/50">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-lg font-black text-[#00204a]">Hourly Pulse</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Live tracking for today</p>
                </div>
                <div class="w-10 h-10 bg-rose-50 text-rose-500 rounded-xl flex items-center justify-center animate-pulse">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <div id="hourlyChart" class="min-h-[350px]"></div>
        </div>

        <!-- Daily Tracking -->
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-xl shadow-gray-100/50">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-lg font-black text-[#00204a]">Revenue Growth</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Last 30 days performance</p>
                </div>
                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-simple"></i>
                </div>
            </div>
            <div id="dailyChart" class="min-h-[350px]"></div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-gray-100/50 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-black text-[#00204a]">Recent Transactions</h3>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Last 10 payments processed</p>
            </div>
            <a href="<?= site_url('admin/subscriptions') ?>" class="text-xs font-black text-[#d4af37] uppercase tracking-widest hover:translate-x-1 transition-all">
                View All <i class="fa-solid fa-chevron-right ml-1"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Customer</th>
                        <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Transaction ID</th>
                        <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Purpose</th>
                        <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Date</th>
                        <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if (empty($recent)): ?>
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center text-gray-400 font-bold text-sm">No recent transactions found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($recent as $r): ?>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-rise-dark rounded-xl flex items-center justify-center text-white font-bold text-xs">
                                            <?= strtoupper(substr($r->full_name ?: 'U', 0, 1)) ?>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 leading-none"><?= $r->full_name ?: 'Unknown' ?></p>
                                            <p class="text-[10px] text-gray-400 mt-1"><?= $r->email ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="text-xs font-mono font-bold text-gray-500"><?= $r->provider_payment_id ?: 'N/A' ?></span>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest">
                                        <?= str_replace('_', ' ', $r->purpose) ?>
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="text-xs font-bold text-gray-900"><?= date('d M, Y', strtotime($r->created_at)) ?></p>
                                    <p class="text-[10px] text-gray-400 mt-1"><?= date('h:i A', strtotime($r->created_at)) ?></p>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <span class="text-sm font-black text-emerald-600">₹<?= number_format($r->amount_paise / 100) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ApexCharts Script -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data from PHP
        const dailyData = <?= json_encode($daily) ?>;
        const hourlyData = <?= json_encode($hourly) ?>;

        const dailyLabels = Object.keys(dailyData);
        const dailyValues = Object.values(dailyData);

        const hourlyLabels = Object.keys(hourlyData);
        const hourlyValues = Object.values(hourlyData);

        // Hourly Pulse Chart (Line)
        const hourlyOptions = {
            series: [{
                name: 'Revenue (₹)',
                data: hourlyValues
            }],
            chart: {
                height: 350,
                type: 'area',
                toolbar: { show: false },
                zoom: { enabled: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#f43f5e'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: hourlyLabels,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#94a3b8', fontWeight: 600 }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (val) { return "₹" + val.toLocaleString(); },
                    style: { colors: '#94a3b8', fontWeight: 600 }
                }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4
            },
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: function (val) { return "₹" + val.toLocaleString(); }
                }
            }
        };

        const hourlyChart = new ApexCharts(document.querySelector("#hourlyChart"), hourlyOptions);
        hourlyChart.render();

        // Daily Growth Chart (Bar)
        const dailyOptions = {
            series: [{
                name: 'Revenue (₹)',
                data: dailyValues
            }],
            chart: {
                height: 350,
                type: 'bar',
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#3b82f6'],
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    columnWidth: '50%',
                    distributed: false,
                    dataLabels: { position: 'top' }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) { return val > 0 ? "₹" + val : ""; },
                offsetY: -20,
                style: {
                    fontSize: '10px',
                    colors: ["#64748b"],
                    fontWeight: 700
                }
            },
            xaxis: {
                categories: dailyLabels.map(d => d.split('-')[2]), // Just show the day number
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#94a3b8', fontWeight: 600 }
                },
                title: {
                    text: 'Day of Month',
                    style: { color: '#94a3b8', fontWeight: 700, fontSize: '10px' }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (val) { return "₹" + val.toLocaleString(); },
                    style: { colors: '#94a3b8', fontWeight: 600 }
                }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4
            },
            tooltip: {
                theme: 'dark',
                x: {
                    formatter: function(val, { series, seriesIndex, dataPointIndex, w }) {
                        return dailyLabels[dataPointIndex];
                    }
                }
            }
        };

        const dailyChart = new ApexCharts(document.querySelector("#dailyChart"), dailyOptions);
        dailyChart.render();
    });
</script>




