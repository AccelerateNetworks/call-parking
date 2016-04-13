var columns = ['spot', 'caller_id_name', 'caller_id_number', 'RFC2822_DATE', 'answered_time', 'created_time'];
var calls = [];
function updateSpot(spot) {
    var row = document.getElementById(spot.call);
    if(row === null) {
        row = document.createElement('tr');
        row.setAttribute('id', spot.call);

        for(var i = 0; i < columns.length; i++) {
          var cell = document.createElement('td');
          cell.classList.add(spot.call);
          cell.classList.add(columns[i]);
          row.appendChild(cell);
        }
        document.getElementById("parkedcalls").appendChild(row);
        row.getElementsByClassName('spot')[0].textContent = spot.spot;
    }
    for(var j = 0; j < columns.length; j++) {
      row.getElementsByClassName(columns[j])[0].textContent = spot[columns[j]];
    }
    calls.push(spot.call);
}

function updateTable() {
    calls = [];
    var parkinglots = JSON.parse(this.responseText);
    for(var lot in parkinglots) {
      if(parkinglots.hasOwnProperty(lot)) {
        parkinglots[lot].each(updateSpot);
      }
    }
    var table = document.getElementById("parkedcalls");
    var rows = table.getElementsByTagName('tr');
    for(var i = 1; i < rows.length; i++) {
        if(calls.indexOf(rows[i].id) == -1) {
          table.removeChild(rows[i]);
        }
    }
}

function fetchUpdate() {
    var request = new XMLHttpRequest();
    request.addEventListener('load', updateTable);
    request.open("GET", "status-json.php");
    request.send();
}

setInterval(fetchUpdate, 1000);
