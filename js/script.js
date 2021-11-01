function toggleProfileFields() {
    // enables/disables fields on the account detail updating page

    const inputs = document.querySelectorAll('form input');
    const btn = document.querySelector('form button');

    // toggle all fields' enabled/disabled state
    for (let input of inputs) {
        input.disabled = !input.disabled;
    }

    if (inputs[0].disabled) {
        // all fields were just toggled to the disabled state
        // which means user just saved their profile, so we can update database
        let url = 'php/update_profile.php';

        let data = new FormData();
        data.append('name', document.getElementById('name').value);
        data.append('nric', document.getElementById('nric').value);
        data.append('phone', document.getElementById('phone').value);
        data.append('email', document.getElementById('email').value);

        // make post request and check response to see if we are successful
        fetch(url, {
            method: 'POST',
            header: {"Content-type": "application/x-www-form-urlencoded; charset=UTF-8"},
            body: data
        })
        .then(response => response.text())
        .then(response => {
            console.log(response);
        })
        .catch(err => console.log(err));

        // reset button text to default
        btn.textContent = 'Update';
    } else {
        btn.textContent = 'Save';
    }
}

function validateProfileFields(){
    // todo: write this
    return true;
}

function validateNewAccount(){
    // we also check that passwords are the same in php / server side
    // but doing it on the client side lets us notify the user without having to make a http request

    const pw1 = document.getElementById('password');
    const pw2 = document.getElementById('password2');

    if (pw1.value !== pw2.value) {
        alert('Passwords do not match')
        return false;
    } else {
        return true;
    }
}

function setAppointmentTimes(data) {
    // updates the timeslot options when the user browses the different days for booking

    const doc_name = document.getElementById('appt-doctor').value;
    const selected_date = document.getElementById('appt-dates').value;
    const appt_times = document.getElementById('appt-times');

    const default_timeslots = ['10:00', '11:00', '13:00', '14:00', '15:00', '16:00', '17:00'];

    // each valid appt date has a known set of default timeslots
    // booking.php should include occupied timeslots generated in a script tag
    // we stored it in a var called data
    // there's probably a better way to do this
    const doc_schedule = data[doc_name];
    const invalid_dates = (doc_schedule[selected_date] === undefined) ? [] : doc_schedule[selected_date]; 

    const valid_timeslots = default_timeslots.filter(x => !invalid_dates.includes(x));
    appt_times.innerHTML = ''; // clear all timeslots

    for (timeslot of valid_timeslots) {
        // set the available timeslots
        appt_times.add(new Option(timeslot, timeslot + ':00'));
    }
}

function deleteAppointment(row_num) {
    // delete appointment identified by its timeslot

    const appt_times = document.getElementsByClassName('appt-time');
    const time = appt_times[row_num].textContent;

    const url = 'php/delete_booking.php';
    const data = new FormData();
    data.append('time', time);

    // make post request and check response to see if we are successful
    fetch(url, {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(response => {
        if (response == 1) {
            // deletion confirmed, remove row from future appts table
            const future_appts = document.querySelectorAll('tbody tr.future-appt');
            future_appts[row_num].remove();
        }
    })
    .catch(err => console.log(err));
}