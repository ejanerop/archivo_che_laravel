
    $(function () {
        $('li.li').removeClass('active');
        $('li#log').addClass('active');
        $('li#logStats').addClass('active');
    });

    function toggleTabType(tab) {
        var tab1 = $('#liType1');
        var tab2 = $('#liType2');
        switch (tab) {
            case 1:
            tab1.addClass('active');
            tab2.removeClass('active');
            break;
            case 2:
            tab1.removeClass('active');
            tab2.addClass('active');
            break;
        }
    }
    function toggleTabTopic(tab) {
        var tab1 = $('#liTopic1');
        var tab2 = $('#liTopic2');
        switch (tab) {
            case 1:
            tab1.addClass('active');
            tab2.removeClass('active');
            break;
            case 2:
            tab1.removeClass('active');
            tab2.addClass('active');
            break;
        }
    }



    var backgroundColor = 'white';
    Chart.plugins.register({
        beforeDraw: function(c) {
            var ctx = c.chart.ctx;
            ctx.fillStyle = backgroundColor;
            ctx.fillRect(0, 0, c.chart.width, c.chart.height);
        }
    });

    var ctx = document.getElementById('typesWithAccess').getContext('2d');
    var typesWithAccess = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
            @foreach (\Stats::typesWithAccess()->keys() as $item)
            "{{ $item }}",
            @endforeach
            ],
            datasets: [{
                label: 'Cantidad de accesos',
                data: {{\Stats::typesWithAccess()->values()}},
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
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

    $('#saveTypes').click(function() {
        if ($('#liType1').hasClass('active')) {
            var graph = document.getElementById('typesWithAccess');
        } else {
            var graph = document.getElementById('typesWithCant');
        }
        graph.toBlob(function(blob) {
        saveAs(blob, "Gráfico.png");
    });
    });
