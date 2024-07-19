document.addEventListener('DOMContentLoaded', function() {
    showCalendar();
});

function showList() {
    // List Border color styles
    let listActive = document.getElementById('list-active');
    let calendarActive = document.getElementById('calendar-active');
    let calendarContainer = document.getElementById('calendar-container');
    let cardList = document.querySelector('.card-list');
    let cardListFilters = document.querySelector('.card-list-filters');
    let cardCalendar = document.querySelector('.card-calendar');

    listActive.style.border = '2px solid #33b75f';
    listActive.style.borderRadius = '15px';
    listActive.style.transform = 'scale(1.3)';

    // Calendar Border color styles
    calendarActive.style.border = 'none';
    calendarActive.style.borderRadius = '0px';
    calendarActive.style.transform = 'scale(1)';

    calendarContainer.style.display = 'none';
    cardList.style.display = 'block';
    cardListFilters.style.display = 'block';
    cardCalendar.style.display = 'none';
}

function showCalendar() {
    // List Border color styles
    let listActive = document.getElementById('list-active');
    let calendarActive = document.getElementById('calendar-active');
    let calendarContainer = document.getElementById('calendar-container');
    let cardList = document.querySelector('.card-list');
    let cardListFilters = document.querySelector('.card-list-filters');
    let cardCalendar = document.querySelector('.card-calendar');

    listActive.style.border = 'none';
    listActive.style.borderRadius = '0px';
    listActive.style.transform = 'scale(1)';

    // Calendar Border color styles
    calendarActive.style.border = '2px solid #33b75f';
    calendarActive.style.borderRadius = '15px';
    calendarActive.style.transform = 'scale(1.3)';

    cardList.style.display = 'none';
    cardListFilters.style.display = 'none';
    cardCalendar.style.display = 'block';
    calendarContainer.style.display = 'block';
}
