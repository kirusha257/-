<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика — Ресторан AAA</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        :root { --gold:#c9a84c; --gold-light:#e8c97a; --gold-dim:rgba(201,168,76,0.1); --bg:#111110; --bg-card:#1c1c1a; --bg-input:#151514; --border:rgba(255,255,255,0.07); --border-gold:rgba(201,168,76,0.3); --text:#e8e4dc; --text-muted:#7a7670; --red:#e07070; --red-bg:rgba(192,57,43,0.12); --radius:12px; --radius-sm:7px; }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;padding:36px 28px 60px;}
        .page-wrap{max-width:1200px;margin:0 auto;}
        .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:40px;padding-bottom:22px;border-bottom:1px solid var(--border);}
        .topbar__title{font-family:'Cormorant Garamond',serif;font-size:1.9rem;font-weight:500;color:var(--gold);}
        .logout-btn{background:transparent;border:1px solid var(--border);color:var(--text-muted);padding:8px 16px;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:0.82rem;cursor:pointer;transition:all 0.2s;}
        .logout-btn:hover{border-color:var(--border-gold);color:var(--gold);}
        /* Stat cards */
        .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin-bottom:28px;}
        .stat-card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:26px 28px;}
        .stat-card__num{font-family:'Cormorant Garamond',serif;font-size:3rem;font-weight:500;color:var(--gold);line-height:1;}
        .stat-card__label{font-size:0.73rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.07em;margin-top:10px;}
        /* Charts */
        .chart-card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:26px;margin-bottom:20px;}
        .chart-card__title{font-family:'Cormorant Garamond',serif;font-size:1.15rem;font-weight:500;color:var(--gold);margin-bottom:20px;}
        .two-col{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;}
        @media(max-width:768px){.two-col{grid-template-columns:1fr;}}
        /* Table */
        table{width:100%;border-collapse:collapse;font-size:0.875rem;}
        thead th{text-align:left;padding:11px 14px;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-muted);border-bottom:1px solid var(--border);}
        tbody td{padding:13px 14px;border-bottom:1px solid var(--border);}
        tbody tr:hover{background:rgba(255,255,255,0.018);}
        tbody tr:last-child td{border-bottom:none;}
        .empty-state{text-align:center;padding:32px;color:var(--text-muted);font-size:0.875rem;}
        .back-link{display:inline-flex;align-items:center;gap:7px;color:var(--text-muted);text-decoration:none;font-size:0.8rem;letter-spacing:0.04em;transition:color 0.2s;margin-top:32px;}
        .back-link:hover{color:var(--gold);}
        .back-link::before{content:'←';}
        .return{margin:-50px 0px 20px 0px}
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__title">Статистика</div>
            
        </div>
        <div class="return"> 
            <a href="{{ route('admin.dashboard') }}" class="back-link">Вернуться в панель управления</a>
        </div>
        <!-- KPI cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card__num">{{ $totalActiveBookings }}</div>
                <div class="stat-card__label">Активных броней</div>
            </div>
            <div class="stat-card">
                <div class="stat-card__num">{{ round($avgGuests, 1) }}</div>
                <div class="stat-card__label">Средний размер группы</div>
            </div>
            <div class="stat-card">
                <div class="stat-card__num">{{ $popularHours->first()->hour ?? 0 }}:00</div>
                <div class="stat-card__label">Самое популярное время</div>
            </div>
        </div>

        <!-- Daily chart -->
        <div class="chart-card">
            <div class="chart-card__title">Бронирования за последние 30 дней</div>
            <canvas id="dailyChart" height="90"></canvas>
        </div>

        <!-- Status + Hours -->
        <div class="two-col">
            <div class="chart-card">
                <div class="chart-card__title">Статусы бронирований</div>
                <canvas id="statusChart" height="220"></canvas>
            </div>
            <div class="chart-card">
                <div class="chart-card__title">Популярные часы</div>
                <canvas id="hoursChart" height="220"></canvas>
            </div>
        </div>

        <!-- Popular dates table -->
        <div class="chart-card">
    <div class="chart-card__title">Самые популярные даты</div>
    <div style="font-size: 0.7rem; color: #7a7670; margin-bottom: 12px;">(Новые + Подтверждены + Гость на месте + Выполнены)</div>
    @if($popularDates->isEmpty())
        <div class="empty-state">Нет данных</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Количество броней</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($popularDates as $date)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($date->date)->format('d.m.Y') }}</td>
                            <td>{{ $date->count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <script>
    const gridColor = 'rgba(255,255,255,0.05)';
    const tickColor = '#7a7670';
    const gold = '#c9a84c';

    Chart.defaults.font.family = "'DM Sans', sans-serif";

    // Daily chart
    new Chart(document.getElementById('dailyChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode($bookingsByDay->pluck('day')->map(function($d){ return \Carbon\Carbon::parse($d)->format('d.m'); })) !!},
            datasets: [{
                label: 'Бронирований',
                data: {!! json_encode($bookingsByDay->pluck('count')) !!},
                borderColor: gold,
                backgroundColor: 'rgba(201,168,76,0.07)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: gold,
                pointRadius: 3,
                pointHoverRadius: 5,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { labels: { color: tickColor, font: { size: 12 } } } },
            scales: {
                y: { ticks: { color: tickColor }, grid: { color: gridColor }, border: { color: 'transparent' } },
                x: { ticks: { color: tickColor }, grid: { color: gridColor }, border: { color: 'transparent' } }
            }
        }
    });

    // Status doughnut
    new Chart(document.getElementById('statusChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($statusStats->pluck('status')->map(function($s){
                return ['new'=>'Новые','confirmed'=>'Подтверждены','cancelled'=>'Отменены','completed'=>'Выполнены','guest_on_place'=>'Гость на месте'][$s] ?? $s;
            })) !!},
            datasets: [{
                data: {!! json_encode($statusStats->pluck('count')) !!},
                backgroundColor: ['rgba(230,126,34,0.7)', 'rgba(46,204,113,0.7)', 'rgba(192,57,43,0.7)', 'rgba(52,152,219,0.7)', 'rgba(155,89,182,0.7)'],
                borderColor: '#111110',
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            cutout: '60%',
            plugins: { legend: { labels: { color: tickColor, font: { size: 12 }, padding: 16 }, position: 'bottom' } }
        }
    });

    // Hours bar
    new Chart(document.getElementById('hoursChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($popularHours->pluck('hour')->map(function($h){ return $h.':00'; })) !!},
            datasets: [{
                label: 'Броней',
                data: {!! json_encode($popularHours->pluck('count')) !!},
                backgroundColor: 'rgba(201,168,76,0.55)',
                borderColor: gold,
                borderWidth: 1,
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { labels: { color: tickColor, font: { size: 12 } } } },
            scales: {
                y: { ticks: { color: tickColor }, grid: { color: gridColor }, border: { color: 'transparent' } },
                x: { ticks: { color: tickColor }, grid: { display: false }, border: { color: 'transparent' } }
            }
        }
    });
    </script>
</body>
</html>