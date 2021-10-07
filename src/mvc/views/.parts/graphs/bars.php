<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Graphic Sample
 */
?>

<script src="/js/chart.js"></script>
<canvas id="myChart" class="" width="100%" height="100%"></canvas>
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: 
        {
            labels: [''],
            datasets: [
                {
                    label: 'Item 1',
                    data: [ 15 ],
                    backgroundColor: [ 'rgba(255, 99, 132, 0.2)' ],
                    borderColor: [ 'rgba(255, 99, 132, 1)' ],
                    borderWidth: 1
                }, 
                {
                    label: 'Item 2',
                    data: [ 24 ],
                    backgroundColor: [ 'rgba(54, 162, 235, 0.2)' ],
                    borderColor: [ 'rgba(54, 162, 235, 1)' ],
                    borderWidth: 1
                }, 
                {
                    label: 'Item 3',
                    data: [ 10 ],
                    backgroundColor: [ 'rgba(255, 206, 86, 0.2)' ],
                    borderColor: [ 'rgba(255, 206, 86, 1)' ],
                    borderWidth: 1
                }, 
                {
                    label: 'Item 4',
                    data: [ 4 ],
                    backgroundColor: [ 'rgba(75, 192, 192, 0.2)' ],
                    borderColor: [ 'rgba(75, 192, 192, 1)' ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>