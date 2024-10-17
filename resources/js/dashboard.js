// resources/js/dashboard.js

import Chart from 'chart.js/auto';

const typeOfAssistanceCtx = document.getElementById('typeOfAssistanceChart').getContext('2d');
new Chart(typeOfAssistanceCtx, {
    type: 'pie',
    data: {
        labels: ['Medical', 'Funeral', 'Food'],
        datasets: [{
            data: [2856355, 435400, 201850],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
        }]
    }
});

const sexDistributionCtx = document.getElementById('sexDistributionChart').getContext('2d');
new Chart(sexDistributionCtx, {
    type: 'pie',
    data: {
        labels: ['Female', 'Male'],
        datasets: [{
            data: [120, 71],
            backgroundColor: ['#FF6384', '#36A2EB'],
        }]
    }
});
