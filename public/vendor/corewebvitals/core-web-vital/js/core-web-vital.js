let clsValue = lcpValue = fcpValue = fidValue = 0;
let clsEntries = [];

let sessionValue = 0;
let sessionEntries = [];
let setCLS = setLCP = setFID = setFCP = sentData = false;
new PerformanceObserver((entryList) => {
    for (const entry of entryList.getEntries()) {
        // Only count layout shifts without recent user input.
        if (!entry.hadRecentInput) {
            const firstSessionEntry = sessionEntries[0];
            const lastSessionEntry = sessionEntries[sessionEntries.length - 1];

            // If the entry occurred less than 1 second after the previous entry and
            // less than 5 seconds after the first entry in the session, include the
            // entry in the current session. Otherwise, start a new session.
            if (sessionValue &&
                entry.startTime - lastSessionEntry.startTime < 1000 &&
                entry.startTime - firstSessionEntry.startTime < 5000) {
                sessionValue += entry.value;
                sessionEntries.push(entry);
            } else {
                sessionValue = entry.value;
                sessionEntries = [entry];
            }

            // If the current session value is larger than the current CLS value,
            // update CLS and the entries contributing to it.
            if (sessionValue > clsValue) {
                clsValue = sessionValue;
                clsEntries = sessionEntries;
                setCLS = true;
                // Log the updated value (and its entries) to the console.
                // console.log('CLS:', clsValue, clsEntries)
            }
        }
    }
}).observe({type: 'layout-shift', buffered: true});

new PerformanceObserver((entryList) => {
    for (const entry of entryList.getEntries()) {
        fidValue = entry.processingStart - entry.startTime;
        setFID = true;
        // console.log('FID candidate:', delay, entry);
    }
}).observe({type: 'first-input', buffered: true});

new PerformanceObserver((entryList) => {
    for (const entry of entryList.getEntries()) {
        lcpValue = entry.startTime;
        setLCP = true;
        // console.log('LCP candidate:', entry.startTime, entry);
    }
}).observe({type: 'largest-contentful-paint', buffered: true});

new PerformanceObserver((entryList) => {
    for (const entry of entryList.getEntriesByName('first-contentful-paint')) {
        fcpValue = entry.startTime
        setFCP = true;
        // console.log('FCP candidate:', entry.startTime, entry);
    }
}).observe({type: 'paint', buffered: true});

setInterval(() => {
    if (setLCP && setFCP) {
        if (!sentData) {
            sendDataCWV();
        }
    }
}, 5000)

function sendDataCWV() {
    let isMobile;
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        // true for mobile device
        isMobile = 1;
    } else {
        // false for not mobile device
        isMobile = 0;
    }

    var http = new XMLHttpRequest();
    var url = window.cwv_path;
    var current_url = window.location.href;
    var params = '_token=' + window.token + '&url=' + current_url + '&cls=' + clsValue + '&lcp=' + lcpValue + '&fcp=' + fcpValue + '&fdi=' + fidValue + '&is_mobile=' + isMobile;
    http.open('POST', url, true);

//Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function () {//Call a function when the state changes.
        if (http.readyState == 4 && http.status == 200) {
            sentData = true;
            // alert(http.responseText);
        }
    }
    http.send(params);
}
