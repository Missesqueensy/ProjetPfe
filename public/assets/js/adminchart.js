// resources/js/admin-dashboard-charts.js

document.addEventListener('DOMContentLoaded', function() {
    // Graphique des inscriptions
    const enrollmentCtx = document.getElementById('enrollmentChart');
    if (enrollmentCtx) {
        new Chart(enrollmentCtx, {
            type: 'line',
            data: {
                labels: JSON.parse(enrollmentCtx.dataset.labels),
                datasets: [{
                    label: 'Inscriptions',
                    data: JSON.parse(enrollmentCtx.dataset.values),
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)'
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Graphique de répartition des utilisateurs
    const userDistCtx = document.getElementById('userDistributionChart');
    if (userDistCtx) {
        new Chart(userDistCtx, {
            type: 'doughnut',
            data: {
                labels: ['Enseignants', 'Étudiants', 'Admins'],
                datasets: [{
                    data: [
                        userDistCtx.dataset.enseignants,
                        userDistCtx.dataset.etudiants,
                        userDistCtx.dataset.admins
                    ],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                cutout: '70%',
            },
        });
    }
});