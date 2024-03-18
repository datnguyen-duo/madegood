(function ($) {
    //document ready
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    //Create today full date in format 2021/January/2
    let today = new Date();
    let todayDay = today.getDate();
    let todayMonth = today.getMonth();
    let todayYear = today.getFullYear();
    let todayFullDate = todayYear + '/' + monthNames[todayMonth] + '/' + todayDay;
    //Create today full date in format 2021/January/2 END

    function setFirstAvailableDate() {
        //Get first available date in calender and create full date in same format as today date 2021/January/2
        let firstDayAvailable = $('td.bookable').not('.not_bookable, .ui-state-disabled, .ui-datepicker-unselectable').eq(0).text(); //Select first active date text
        let firstMonthAvailable = $('.ui-datepicker-month').text();
        let firstYearAvailable = $('.ui-datepicker-year').text();
        let firstFullDateAvailable = firstYearAvailable + '/' + firstMonthAvailable + '/' + firstDayAvailable;

        //Compare todayFullDate and firstFullDateAvailable
        //If they are not the same then show info when is first day available
        if( todayFullDate !== firstFullDateAvailable ) {
            $('.first_availability').slideDown().find('span').text(firstMonthAvailable + ' ' + firstDayAvailable);
        } else {
            $('.first_availability').slideUp();
        }
    }

    $(window).on("load", function () {
        //Set timeout until the calendar is loaded
        setTimeout(function () {
            setFirstAvailableDate();
        }, 400);
        //Set timeout until the calendar is loaded END
    });

    let bookingFormOpener = $('.calendar_opener');
    let bookingForm = $('#wc-bookings-booking-form');

    //Wrap calendar and create all elements for calendar popup
    bookingForm.wrap('<div class="wc-bookings-booking-form-holder"></div>').wrapInner('<div class="wc-bookings-booking-form-content"></div>');
    let bookingFormHolder = $('.wc-bookings-booking-form-holder');
    let bookingFormContent = $('.wc-bookings-booking-form-content');
    bookingFormContent.prepend(
        '<h2 class="close_calendar_button">Close</h2>' +
        '<h2 class="calendar_title">Rental Calendar</h2>' +
        '<p class="calendar_description">Lorem ipsum dolor sit amet, consectetur adipiscing. Lorem ipsum dolor sit amet, consectetur adipiscing. Lorem ipsum dolor sit amet, consectetur adipiscing.</p>'
    );
    bookingFormContent.append(
        '<div class="inputs_holder">' +
        '<div class="input_holder"><input type="text" name="user_name_clone" data-target="user_name" placeholder="name" autocomplete="on" required></div>' +
        '<div class="input_holder"><input type="email" name="user_email_clone" data-target="user_email" placeholder="email" autocomplete="on" required></div>' +
        '</div>' +
        '<div class="calendar_popup_book_button_holder">' +
        '<button class="calendar_popup_book_button book_button">Rent Item</button>' +
        '</div>' +
        '<p class="selected_rental_period">Rental Period: <span>0 days</span></p>'
    );
    //Wrap calendar and create all elements for calendar popup END

    //Calendar popup opening and closing functionality
    bookingFormOpener.on('click', function(){
        bookingFormHolder.fadeIn();
    });

    $(document).on('click', '.close_calendar_button', function() {
        bookingFormHolder.fadeOut();
    });
    //Calendar popup opening and closing functionality END

    //Count selected dates(rental period)
    let startDateMonth = $('input[name=wc_bookings_field_start_date_month]');
    let startDateDay = $('input[name=wc_bookings_field_start_date_day]');
    let startDateYear = $('input[name=wc_bookings_field_start_date_year]');

    let endDateMonth = $('input[name=wc_bookings_field_start_date_to_month]');
    let endDateDay = $('input[name=wc_bookings_field_start_date_to_day]');
    let endDateYear = $('input[name=wc_bookings_field_start_date_to_year]');

    $('.wc-bookings-date-picker-date-fields input').change(function(e){
        let oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        let firstDate = new Date(startDateYear.val(), startDateMonth.val(), startDateDay.val());
        let secondDate;

        if( !endDateDay.val() ) {
            secondDate = firstDate;
        } else {
            secondDate = new Date(endDateYear.val(), endDateMonth.val(), endDateDay.val());
        }

        const rentalPeriod = Math.round(Math.abs((firstDate - secondDate) / oneDay)) + 1;
        let word = ( rentalPeriod > 1 ) ? ' days' : ' day';
        $('.selected_rental_period span').text(rentalPeriod + word);
    });
    //Count selected dates(rental period) END


    // $("#wc-bookings-booking-form fieldset").on('date-selected', function( event, fdate ) {
    //     // console.log( 'Timestamp in seconds: ' + event.timeStamp ); // the selected date timestamp
    //     // console.log( 'Formatted chosen date: ' + fdate ); // The selected formated date in "YYYY-MM-DD" format
    //     var date  = new Date(Date.parse(fdate)), // The selected DATE Object
    //         year  = date.getFullYear(), // Year in numeric value with 4 digits
    //         month = date.getMonth(), // Month in numeric value from 0 to 11
    //         day   = date.getDate(), // Day in numeric value from 1 to 31
    //         wDay  = date.getDay(); // Week day in numeric value from 0 to 6
    //     // console.log('Year: '+year+' | month: '+month+' | day: '+day+' | week day: '+wDay);
    // });
    //

    //Custom fields functionality - populate custom fields with cloned fields created with js in popup
    let userNameInputClone = $('input[name=user_name_clone]');
    let userNameInput = $('input[name=user_name]');
    let userEmailInputClone = $('input[name=user_email_clone]');
    let userEmailInput = $('input[name=user_email]');

    userNameInputClone.on('input',function(){
        userNameInput.val($(this).val());
    });

    userEmailInputClone.on('input',function(){
        userEmailInput.val($(this).val());
    });
    //Custom fields functionality END

    $(".cart").validate({
        messages: {},
        submitHandler: function (form) {
            //Insert into the cart item

            if( !endDateDay.val() ) {
                //If end date is empty
                //If user only select one day without double clicking on it, trigger another click on the same date
                //in order to fill end date with same start date info and like that avoid bug after adding the booking into the cart
                $('.ui-datepicker-current-day').trigger('click').trigger('click');
            }

            var formData = $('.cart').serialize();

            $.ajax({
                // url: '/',
                data: formData,
                type: "POST", // POST
                beforeSend: function (xhr) {
                    $('.cart')[0].reset();
                    userEmailInput.val('');userNameInput.val('');
                    $('.selected_rental_period span').text('0 days');
                },
                success: function (data) {
                    wc_bookings_booking_form.wc_bookings_date_picker.init();
                    bookingFormHolder.fadeOut();
                },
                complete: function (xhr, status) {
                    $('body').trigger('added_to_cart');

                    //Set active class on next available date in current or next month after booking
                    setTimeout(function() {
                        $('.fully_booked').removeClass('ui-datepicker-current-day');
                        let firstAvailableDayInMonth = $('td').not('.not_bookable, .ui-state-disabled, .ui-datepicker-unselectable').eq(0);

                        //Check if available date exists in current month after user booking
                        if( firstAvailableDayInMonth.length ) {
                            //If do exist check if day belongs to the next month
                            if( firstAvailableDayInMonth.hasClass('ui-datepicker-other-month') ) {

                                //If day is part of the next month open next month
                                $('.ui-datepicker-next').trigger('click');

                                setTimeout(function(){
                                    //Set timeout until the new month is loaded and select first available date
                                    $('td').not('.not_bookable, .ui-state-disabled, .ui-datepicker-unselectable').eq(0).addClass('ui-datepicker-current-day');
                                },300);
                            } else {
                                firstAvailableDayInMonth.addClass('ui-datepicker-current-day');
                            }
                        } else {
                            //If there is no available date in current month change the month
                            $('.ui-datepicker-next').trigger('click');

                            setTimeout(function(){
                                //Set timeout until the new month is loaded and select first available date
                                $('td').not('.not_bookable, .ui-state-disabled, .ui-datepicker-unselectable').eq(0).addClass('ui-datepicker-current-day');
                            },300);
                        }

                        setFirstAvailableDate();
                        //Set active class on next available date in current or next month after booking END
                    }, 500);
                },
            });
            //Insert into the cart item END
        },
        errorElement: "small",
        // errorLabelContainer: "#errordiv",
    });
    //Booking Validation END

    //add to cart request
    $('.book_button').on('click', function(event){
        event.preventDefault();
        $('.single_add_to_cart_button').trigger('click');
    });
    //add to cart request END

    $(document).on('click', '.remove_item',function(){
        setTimeout(function(){
            setFirstAvailableDate();
        },1000);
    });
})(jQuery);