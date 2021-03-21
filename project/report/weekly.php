<!DOCTYPE html>
<html lang="en">

<head>
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="./js/sidebar.js"></script>
    <link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <link rel="stylesheet" href="../css/style.css" />

</head>
<style>
    .top {

        float: right;

    }

    .glyphicon {
        font-size: 30px;
        float: right;
    }

</style>

<body>
    <div class="container">
        <div class="col-md-10">
            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
            <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>

        </div>
    </div>
    <div class="container">
        <div id="calender" class="col-md-4">
            <div class="year-month"></div>
            <div class="dates"></div>
        </div>
        <div id="image" class="col-md-3">
            <img src="noimage.png" width="250px" alt="이미지 없음">
        </div>
        <div id="score" class="col-md-3">
            <span class="mScore">이번 주 나의 점수
                <input type="text" name=weeklyScore>
                점</span>

        </div>
    </div>
    <div class="container">
        <div class="col-md-10">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="container bottom">
        <div id="good" class="col-md-5">
            <p>칭찬</p>
            <textarea name="good"></textarea>
        </div>
        <div id="bad" class="col-md-5">
            <p>반성</p>
            <textarea name="bad"></textarea>
        </div>

    </div>




</body>

</html>
<script>
    var chBar = document.getElementById("myChart");
    var chartData = {
        labels: ["월", "화", "수", "목", "금", "토", "일"],
        datasets: [{
            data: [70, 50, 60, 80, 100, 100, 40],
            backgroundColor: '#ff1f78'
        }, {
            data: [30, 20, 40, 80, 70, 60, 0],
            backgroundColor: '#ff1f78'
        }]
    };
    var myChart = new Chart(chBar, { // 챠트 종류를 선택 
        type: 'bar', // 챠트를 그릴 데이타 
        data: chartData, // 옵션 
        options: {
            legend: {
                display: false
            }
        }
    });

    const date = new Date();

    const viewYear = date.getFullYear();
    const viewMonth = date.getMonth();

    document.querySelector('.year-month').textContent = `${viewMonth + 1}月`;
    const prevLast = new Date(viewYear, viewMonth, 0);
    const thisLast = new Date(viewYear, viewMonth + 1, 0);

    const PLDate = prevLast.getDate();
    const PLDay = prevLast.getDay();

    const TLDate = thisLast.getDate();
    const TLDay = thisLast.getDay();
    const prevDates = [];
    const thisDates = [...Array(TLDate + 1).keys()].slice(1);
    const nextDates = [];



    if (PLDay !== 6) {
        for (let i = 0; i < PLDay + 1; i++) {
            prevDates.unshift(PLDate - i);
        }
    }

    for (let i = 1; i < 7 - TLDay; i++) {
        nextDates.push(i);
    }

    const dates = prevDates.concat(thisDates, nextDates);

    dates.forEach((date, i) => {
        dates[i] = `<div class="date">${date}</div>`;
    })

    document.querySelector('.dates').innerHTML = dates.join('');

</script>
