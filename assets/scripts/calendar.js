function updateCalendar(year, month) {
    const today = new Date();
    const firstDayOfMonth = new Date(year, month - 1, 1);
    const lastDayOfMonth = new Date(year, month, 0);
    const numDaysInMonth = lastDayOfMonth.getDate();
    let dayOfWeek = firstDayOfMonth.getDay() === 0 ? 7 : firstDayOfMonth.getDay();
  
    let tableRows = [];
    let row = Array(7).fill('');
  
    if (dayOfWeek !== 1) {
      row.fill('<td></td>', 0, dayOfWeek - 1);
    }
  
    for (let day = 1; day <= numDaysInMonth; day++) {
      const date = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
      const isBooked = bookedDates.includes(date);
      const isPast = new Date(date) < today;
      const cellContent = `<a href="https://enos.itcollege.ee/~mgoroz/ics0008_group_project/pages/private/booking_form.php?date=${encodeURIComponent(date)}">${day}</a>`;
      const cellClass = isBooked ? ' class="booked"' : (isPast ? ' class="past"' : '');
  
      row[dayOfWeek - 1] = `<td${cellClass}>${cellContent}</td>`;
      if (dayOfWeek === 7 || day === numDaysInMonth) {
        tableRows.push(`<tr>${row.join('')}</tr>`);
        row.fill('');
      }
  
      if (dayOfWeek === 7) {
        dayOfWeek = 1;
      } else {
        dayOfWeek++;
      }
    }
  
    document.querySelector('.calendar').innerHTML = `
      <table>
        <caption>${formatMonthName(firstDayOfMonth)} ${year}</caption>
        <thead>
          <tr>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
          </tr>
        </thead>
        <tbody>
          ${tableRows.join('')}
        </tbody>
      </table>
    `;
  }
  
  function getMonthIndex(monthName) {
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    return monthNames.indexOf(monthName);
  }
  
  function changeMonth(offset) {
    const currentCaption = document.querySelector('.calendar caption');
    const [currentMonthName, currentYear] = currentCaption.textContent.split(' ');
    const currentMonthIndex = getMonthIndex(currentMonthName);
    const currentDate = new Date(parseInt(currentYear), currentMonthIndex);
    const targetDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + offset, 1);
    updateCalendar(targetDate.getFullYear(), targetDate.getMonth() + 1, bookedDates);
  }
  
  function formatMonthName(date) {
    return new Intl.DateTimeFormat('en-US', { month: 'long' }).format(date);
  }  
  
  
  document.addEventListener('DOMContentLoaded', () => {
    const today = new Date();
    updateCalendar(today.getFullYear(), today.getMonth() + 1);
});
  