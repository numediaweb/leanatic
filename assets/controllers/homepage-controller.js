import {Controller} from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="homepage" attribute will cause
 * this controller to be executed. The name "admin_users" comes from the filename:
 * admin_users_controller.js -> "admin_users"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        // Refresh data each 5 seconds
        const REFRESH_INTERVAL = 5000; // 5 seconds

        let myHeaders = new Headers();
        myHeaders.append("Accept", "application/json");

        let requestOptions = {
            method: 'GET', headers: myHeaders, redirect: 'follow'
        };

        // Fetch first results
        fetchIt();

        // Set delays
        setInterval(function () {
            fetchIt();
        }, REFRESH_INTERVAL);

        // Update UI
        function fetchIt() {
            fetch("quick_json", requestOptions)
                .then(response => response.text())
                .then(result => {
                    updateUi(JSON.parse(result));
                })
                .catch(error => console.log('error', error));
        }

        // Update UI
        function updateUi(result) {
            for (const [key, value] of Object.entries(result)) {
                document.getElementById('event-type-' + key).innerHTML = value.length;
            }
        }
    }
}
