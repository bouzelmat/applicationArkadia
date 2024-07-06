// ce fichier est utilisé pour afficher le graphique sur l'interface admin
document.addEventListener("DOMContentLoaded", function() {
    console.log('DOM loaded, creating chart');
    var ctx = document.getElementById('clicsChart').getContext('2d');
    
    var gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
    gradientFill.addColorStop(0, 'rgba(55, 162, 255, 0.7)');
    gradientFill.addColorStop(1, 'rgba(116, 21, 219, 0.7)');

    var clicsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de clics',
                data: clics,
                backgroundColor: gradientFill,
                borderColor: 'rgba(255, 255, 255, 0.8)',
                borderWidth: 2,
                borderRadius: 8,
                barThickness: 'flex',
                maxBarThickness: 30
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Statistiques des clics',
                    font: {
                        size: 20,
                        family: "'Poppins', sans-serif",
                        weight: 'bold'
                    },
                    color: '#333'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif"
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif"
                        }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            }
        }
    });
    
    console.log('Chart created');
});