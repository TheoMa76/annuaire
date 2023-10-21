
    function sortTable(n, type) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.querySelector("table");
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("td")[n];
                y = rows[i + 1].getElementsByTagName("td")[n];
                if (dir == "asc") {
                    if (type === 'numeric') {
                        if (Number(x.innerHTML) > Number(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                } else if (dir == "desc") {
                    if (type === 'numeric') {
                        if (Number(x.innerHTML) < Number(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
        var headers = document.querySelectorAll("th:not(:last-child)");
        headers.forEach(function (header, index) {
            if (index === n) {
                header.classList.toggle("asc", dir === "asc");
                header.classList.toggle("desc", dir === "desc");
            } else {
                header.classList.remove("asc");
                header.classList.remove("desc");
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
    var headers = document.querySelectorAll("th:not(:last-child)");
    var clickCounters = [0, 0, 0, 0, 0];
    var originalOrder = Array.from(document.querySelectorAll("tr")).slice(1);

    headers.forEach(function (header, index) {
        header.addEventListener("click", function () {
            var type = index === 2 ? 'numeric' : 'alphabetic';
            sortTable(index, type);

            clickCounters[index]++;

            if (clickCounters[index] === 3) {
                clickCounters[index] = 0;
                headers.forEach(function (h) {
                    h.classList.remove("asc");
                    h.classList.remove("desc");
                });
                resetToOriginalOrder();
            }
        });
    });

    function resetToOriginalOrder() {
        var table = document.querySelector("table");
        originalOrder.forEach(function (row) {
            table.appendChild(row);
        });
    }
});