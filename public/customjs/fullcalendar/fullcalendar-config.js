document.addEventListener('DOMContentLoaded', function() {
    showCalendar();
});

function showList() {
    // List Border color styles
    let btnList = document.getElementById('btn-list');
    let btnCalendar = document.getElementById('btn-calendar');
    let listActive = document.getElementById('list-active');
    let calendarActive = document.getElementById('calendar-active');
    let calendarContainer = document.getElementById('calendar-container');
    let cardList = document.querySelector('.card-list');
    let cardListFilters = document.querySelector('.card-list-filters');
    let cardCalendar = document.querySelector('.card-calendar');

    listActive.style.transform = 'scale(1.3)';
    listActive.style.opacity = '1'; // Establecer opacidad al 100% para el elemento activo

    // Calendar Border color styles
    calendarActive.style.border = 'none';
    btnCalendar.style.border = 'none';
    btnList.style.border = '1px solid #ffffff7a';
    calendarActive.style.borderRadius = '0px';
    calendarActive.style.transform = 'scale(1)';
    calendarActive.style.opacity = '0.6'; // Establecer opacidad al 60% para el elemento inactivo

    calendarContainer.style.display = 'none';
    cardList.style.display = 'block';
    cardListFilters.style.display = 'block';
    cardCalendar.style.display = 'none';
}

function showCalendar() {
    // List Border color styles
    let btnList = document.getElementById('btn-list');
    let btnCalendar = document.getElementById('btn-calendar');
    let listActive = document.getElementById('list-active');
    let calendarActive = document.getElementById('calendar-active');
    let calendarContainer = document.getElementById('calendar-container');
    let cardList = document.querySelector('.card-list');
    let cardListFilters = document.querySelector('.card-list-filters');
    let cardCalendar = document.querySelector('.card-calendar');

    listActive.style.transform = 'scale(1)';
    listActive.style.opacity = '0.6'; // Establecer opacidad al 60% para el elemento inactivo

    // Calendar Border color styles
    btnList.style.border = 'none';
    btnCalendar.style.border = '1px solid #ffffff7a';
    calendarActive.style.transform = 'scale(1.3)';
    calendarActive.style.opacity = '1'; // Establecer opacidad al 100% para el elemento activo

    cardList.style.display = 'none';
    cardListFilters.style.display = 'none';
    cardCalendar.style.display = 'block';
    calendarContainer.style.display = 'block';
}