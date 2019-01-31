var labels=new Array();
var data1=new Array();
var data2=new Array();
var labels2=[];
$(document).ready(function () {
    labels_chart = $('#labels_chart').val();
    labels_chart = labels_chart.split('||');

    var datasets1 = $('#datasets1').val();
    datasets1 = datasets1.split('||');

    var datasets2 = $('#datasets2').val();
    datasets2 = datasets2.split('||');


    $.each( labels_chart, function( key, value ) {
      labels.push(value);
    });

    $.each( datasets1, function( key, value ) {
      data1.push( parseFloat(value) ) ;
    });

    $.each( datasets2, function( key, value ) {
      data2.push( parseFloat(value) );
    });

    console.log(labels);
    console.log(data1);
    console.log(data2);

    var ctx = document.getElementById("report_chart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'ตั้งไว้ ',
                data: data1,
                backgroundColor: "#26B99A",
            },
            {
                label: 'ใช้ไป',
                data: data2,
                backgroundColor: "#008080",
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function (value, index, values) {
                            return number_format(value);
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel, 2);
                    }
                }
            }
        }
    });
});


document.getElementById("chart_download").addEventListener("click", function () {
    var url_base64 = document.getElementById("report_chart").toDataURL("image/jpg");
    this.href = url_base64;
});


function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}