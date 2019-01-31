var ctx = document.getElementById("receive_main").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["หมวดภาษีอากร", "หมวดภาษีจัดสรร", "หมวดค่าธรรมเนียม ค่าปรับ และใบอนุญาต", "หมวดรายได้จากทรัพย์สิน", "หมวดรายได้สาธารณูปโภคและสาธารณสุขฯ", "หมวดรายได้เบ็ดเตล็ด", "หมวดเงินอุดหนุน"],
        datasets: [{
            label: 'รายรับทั้งหมด',
            data: [5886022.31, 20931025.00, 2235487.00, 363235.95, 1673215.00, 236658.40, 33636024.21],
            backgroundColor: "#26B99A",
        }, ]
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


var ctx = document.getElementById("expenditure_main").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["ตุลาคม", "พฤศจิกายน", "ธันวาคม", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน"],
        datasets: [{
            label: 'รายจ่ายทั้งหมด',
            data: [1506761.63, 2640413.01, 3776773.77, 13931025.00, 631025.00, 563235.95, 169317.93, 0.00, 0.00, 0.00, 0.00, 0.00],
            backgroundColor: "#26B99A",
        }, ]
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