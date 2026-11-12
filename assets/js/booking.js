/**
 * Mumer Room - Booking JavaScript
 * Booking form functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    initBookingForm();
});

/**
 * Initialize booking form
 */
function initBookingForm() {
    const bookingForm = document.getElementById('bookingForm');

    if (!bookingForm) return;

    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const durationInput = document.getElementById('duration');
    const roomSelect = document.getElementById('room');
    const guestsSelect = document.getElementById('guests');
    const bookingSummary = document.getElementById('bookingSummary');

    // Set minimum dates
    const today = new Date().toISOString().split('T')[0];
    const tomorrow = new Date(Date.now() + 86400000).toISOString().split('T')[0];

    if (checkInInput) {
        checkInInput.min = today;
    }

    if (checkOutInput) {
        checkOutInput.min = tomorrow;
    }

    // Update check-out minimum when check-in changes
    if (checkInInput && checkOutInput) {
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            const minCheckOut = new Date(checkInDate.getTime() + 86400000);
            checkOutInput.min = minCheckOut.toISOString().split('T')[0];

            // If check-out is before new minimum, reset it
            if (checkOutInput.value && new Date(checkOutInput.value) <= checkInDate) {
                checkOutInput.value = minCheckOut.toISOString().split('T')[0];
            }

            updateDuration();
            updateSummary();
        });
    }

    // Update duration when check-out changes
    if (checkOutInput) {
        checkOutInput.addEventListener('change', function() {
            updateDuration();
            updateSummary();
        });
    }

    // Update summary when form fields change
    const formInputs = bookingForm.querySelectorAll('input, select');
    formInputs.forEach(input => {
        input.addEventListener('change', updateSummary);
    });

    // Form validation and submission
    bookingForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (validateBookingForm()) {
            processBooking();
        }
    });

    /**
     * Update duration display
     */
    function updateDuration() {
        if (!checkInInput.value || !checkOutInput.value) {
            if (durationInput) {
                durationInput.value = '';
            }
            return;
        }

        const days = calculateDays(checkInInput.value, checkOutInput.value);
        if (durationInput) {
            durationInput.value = days + ' day' + (days > 1 ? 's' : '');
        }
    }

    /**
     * Update booking summary
     */
    function updateSummary() {
        if (!bookingSummary) return;

        const summaryRoom = document.getElementById('summaryRoom');
        const summaryCheckIn = document.getElementById('summaryCheckIn');
        const summaryCheckOut = document.getElementById('summaryCheckOut');
        const summaryDuration = document.getElementById('summaryDuration');
        const summaryGuests = document.getElementById('summaryGuests');

        let hasData = false;

        if (roomSelect && roomSelect.value) {
            summaryRoom.textContent = roomSelect.options[roomSelect.selectedIndex].text;
            hasData = true;
        } else {
            summaryRoom.textContent = '-';
        }

        if (checkInInput && checkInInput.value) {
            summaryCheckIn.textContent = formatDate(checkInInput.value);
            hasData = true;
        } else {
            summaryCheckIn.textContent = '-';
        }

        if (checkOutInput && checkOutInput.value) {
            summaryCheckOut.textContent = formatDate(checkOutInput.value);
            hasData = true;
        } else {
            summaryCheckOut.textContent = '-';
        }

        if (durationInput && durationInput.value) {
            summaryDuration.textContent = durationInput.value;
            hasData = true;
        } else {
            summaryDuration.textContent = '-';
        }

        if (guestsSelect && guestsSelect.value) {
            summaryGuests.textContent = guestsSelect.value + ' guest' + (guestsSelect.value > 1 ? 's' : '');
            hasData = true;
        } else {
            summaryGuests.textContent = '-';
        }

        bookingSummary.style.display = hasData ? 'block' : 'none';
    }

    /**
     * Validate booking form
     */
    function validateBookingForm() {
        let isValid = true;
        let firstError = null;

        // Reset previous errors
        const errorElements = bookingForm.querySelectorAll('.form-error');
        errorElements.forEach(el => el.remove());

        // Validate room selection
        if (!roomSelect.value) {
            showFieldError(roomSelect, 'Please select a room');
            isValid = false;
            if (!firstError) firstError = roomSelect;
        }

        // Validate check-in date
        if (!checkInInput.value) {
            showFieldError(checkInInput, 'Please select check-in date');
            isValid = false;
            if (!firstError) firstError = checkInInput;
        } else {
            const checkInDate = new Date(checkInInput.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (checkInDate < today) {
                showFieldError(checkInInput, 'Check-in date cannot be in the past');
                isValid = false;
                if (!firstError) firstError = checkInInput;
            }
        }

        // Validate check-out date
        if (!checkOutInput.value) {
            showFieldError(checkOutInput, 'Please select check-out date');
            isValid = false;
            if (!firstError) firstError = checkOutInput;
        } else if (checkInInput.value) {
            const checkInDate = new Date(checkInInput.value);
            const checkOutDate = new Date(checkOutInput.value);

            if (checkOutDate <= checkInDate) {
                showFieldError(checkOutInput, 'Check-out date must be after check-in date');
                isValid = false;
                if (!firstError) firstError = checkOutInput;
            }
        }

        // Validate guests
        if (!guestsSelect.value) {
            showFieldError(guestsSelect, 'Please select number of guests');
            isValid = false;
            if (!firstError) firstError = guestsSelect;
        }

        // Validate name
        const nameInput = document.getElementById('name');
        if (nameInput && !nameInput.value.trim()) {
            showFieldError(nameInput, 'Please enter your name');
            isValid = false;
            if (!firstError) firstError = nameInput;
        }

        // Validate phone
        const phoneInput = document.getElementById('phone');
        if (phoneInput && !phoneInput.value.trim()) {
            showFieldError(phoneInput, 'Please enter your WhatsApp number');
            isValid = false;
            if (!firstError) firstError = phoneInput;
        } else if (phoneInput && !validateIndonesianPhone(phoneInput.value)) {
            showFieldError(phoneInput, 'Please enter a valid Indonesian phone number');
            isValid = false;
            if (!firstError) firstError = phoneInput;
        }

        // Validate email if provided
        const emailInput = document.getElementById('email');
        if (emailInput && emailInput.value.trim()) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                showFieldError(emailInput, 'Please enter a valid email address');
                isValid = false;
                if (!firstError) firstError = emailInput;
            }
        }

        // Scroll to first error
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }

        return isValid;
    }

    /**
     * Show field error
     */
    function showFieldError(field, message) {
        const error = document.createElement('div');
        error.className = 'form-error';
        error.textContent = message;

        field.parentNode.appendChild(error);
        field.classList.add('error');
    }

    /**
     * Process booking
     */
    function processBooking() {
        const submitButton = bookingForm.querySelector('button[type="submit"]');
        setButtonLoading(submitButton, true);

        // Collect form data
        const bookingData = {
            room: roomSelect.value,
            check_in: checkInInput.value,
            check_out: checkOutInput.value,
            guests: guestsSelect.value,
            duration: calculateDays(checkInInput.value, checkOutInput.value),
            name: document.getElementById('name').value,
            phone: document.getElementById('phone').value,
            email: document.getElementById('email').value || '',
            notes: document.getElementById('notes').value || ''
        };

        // The form will submit to PHP backend
        // This is just for the loading state
        setTimeout(() => {
            setButtonLoading(submitButton, false);
        }, 1000);
    }
}

/**
 * Helper: Calculate days between dates
 */
function calculateDays(checkIn, checkOut) {
    const inDate = new Date(checkIn);
    const outDate = new Date(checkOut);
    const diffTime = Math.abs(outDate - inDate);
    return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
}

/**
 * Helper: Format date
 */
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

/**
 * Helper: Validate Indonesian phone
 */
function validateIndonesianPhone(phone) {
    const cleaned = phone.replace(/[\s\-\(\)]/g, '');
    return /^(\+62|62|0)[0-9]{9,13}$/.test(cleaned);
}

/**
 * Helper: Set button loading state
 */
function setButtonLoading(button, isLoading) {
    if (isLoading) {
        button.disabled = true;
        button.dataset.originalText = button.textContent;
        button.textContent = 'Processing...';
    } else {
        button.disabled = false;
        button.textContent = button.dataset.originalText || button.textContent;
    }
}
