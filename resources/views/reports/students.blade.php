@extends('layouts.app')

@section('content')
<div class="report-section" id="report-content" style="padding: 30px; background-color: #fff;">
    <h2 style="text-align: center;">Student Age Report</h2>
    <p style="text-align: center;"><strong>Total Students:</strong> {{ $totalStudents }}</p>

    <canvas id="ageChart" style="max-width: 600px; margin: 30px auto;"></canvas>
</div>

<div style="text-align: center; margin-top: 20px;">
    <button onclick="exportPDF()" style="background-color: #81C784; border: none; color: white; padding: 10px 20px; border-radius: 6px;">
        Export to PDF
    </button>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    const ageLabels = @json($byAge->pluck('age'));
    const ageCounts = @json($byAge->pluck('total'));
    const pastelColors = ['#F8BBD0', '#C8E6C9', '#F48FB1', '#B2DFDB'];
    const ctx = document.getElementById('ageChart').getContext('2d');
    const ageChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ageLabels,
            datasets: [{
                label: 'Number of Students',
                data: ageCounts,
                backgroundColor: pastelColors,
                borderRadius: 6
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }, 
                    title: { display: true, text: 'Student Count' }
                },
                x: {
                    title: { display: true, text: 'Age' }
                }
            },
            plugins: { legend: { display: false } }
        }
    });


    async function exportPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const content = document.getElementById('report-content');
        await html2canvas(content, { scale: 2 }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const imgProps = doc.getImageProperties(imgData);
            const pdfWidth = doc.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            doc.addImage(imgData, 'PNG', 0, 10, pdfWidth, pdfHeight);
            doc.save('student-age-report.pdf');
        });
    }
</script>
@endsection
