<div>
    <div>
        <div id="calendar">
            <script>
                function generateCalendar(events) {
                    const now = new Date();
                    const month = now.getMonth();
                    const year = now.getFullYear();

       
                    const firstDay = new Date(year, month, 1).getDay();
                    const daysInMonth = new Date(year, month + 1, 0).getDate();


                    const monthNames = ["January", "February", "March", "April", "May", "June",
                                       "July", "August", "September", "October", "November", "December"];


                    const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];


                    let calendarHTML = `
                        <div style="font-family: Arial, sans-serif; width: 100%; max-width: 2000px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                            <!-- Calendar Title -->
                            <div style="text-align: center; margin-bottom: 15px;">
                                <h1 style="font-size: 1.8em; color: #333; margin-bottom: 5px;">Appointment and Follow Up Schedule</h1>
                                <div style="font-size: 1.5em; font-weight: bold; color: #555;">
                                    ${monthNames[month]} ${year}
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 8px;">
                    `;

                    // Add day headers with larger size
                    dayNames.forEach(day => {
                        calendarHTML += `<div style="text-align: center; font-weight: bold; padding: 10px; background: #f0f0f0; font-size: 1.1em;">${day}</div>`;
                    });

                    // Add empty cells for days before the 1st
                    for (let i = 0; i < firstDay; i++) {
                        calendarHTML += `<div style="background-color: #f9f9f9; padding: 10px; min-height: 80px;"></div>`;
                    }

                    // Add days of the month with larger cells
                    for (let day = 1; day <= daysInMonth; day++) {
                        const currentDate = new Date(year, month, day);
                        const dateString = formatDateForComparison(currentDate);
                        const isToday = now.getDate() === day && now.getMonth() === month && now.getFullYear() === year;

                        // Get events for this day
                        const dayEvents = events.filter(event => event.start === dateString);
                        const hasRegular = dayEvents.some(e => e.type === 'regular');
                        const hasFollowup = dayEvents.some(e => e.type === 'followup');

                        // Determine background color (priority: today > followup > regular)
                        let bgColor = '';
                        if (isToday) {
                            bgColor = 'background-color: #4285f4; color: white;';
                        } else if (hasFollowup) {
                            bgColor = 'background-color: #006400; color: white;'; // Dark green
                        } else if (hasRegular) {
                            bgColor = 'background-color: #FFD700; color: black;'; // Yellow with black text
                        }

                        calendarHTML += `
                            <div style="text-align: center; padding: 10px; border: 1px solid #eee; min-height: 100px; position: relative; ${bgColor}">
                                <div style="font-weight: bold; font-size: 1.2em; margin-bottom: 5px;">${day}</div>
                                ${dayEvents.map(event => `
                                    <div style="font-size: 0.9em; margin-top: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding: 2px 0;">
                                        ${event.time} ${event.type === 'followup' ? '(F)' : ''}
                                    </div>
                                `).join('')}
                            </div>
                        `;
                    }

                    calendarHTML += `
                            </div>
                            <!-- Legend -->
                            <div style="display: flex; justify-content: center; margin-top: 20px; gap: 20px;">
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 20px; height: 20px; background-color: #FFD700; margin-right: 5px; border: 1px solid #ddd;"></div>
                                    <span>Appointment</span>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 20px; height: 20px; background-color: #006400; margin-right: 5px; border: 1px solid #ddd;"></div>
                                    <span>Follow Up</span>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 20px; height: 20px; background-color: #4285f4; margin-right: 5px; border: 1px solid #ddd;"></div>
                                    <span>Today</span>
                                </div>
                            </div>
                        </div>
                    `;

                    // Insert into the div
                    document.getElementById('calendar').innerHTML = calendarHTML;
                }

                // Helper function to format dates consistently
                function formatDateForComparison(date) {
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }

                // Get all events from Livewire
                const allEvents = @json($allEvents);

                // Generate calendar when page loads
                document.addEventListener('DOMContentLoaded', function() {
                    generateCalendar(allEvents);
                });
            </script>
        </div>
    </div>

</div>
