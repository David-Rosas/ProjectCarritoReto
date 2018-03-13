$(document).ready(function () {

    $('.pay').click(function () {
        var payment_method = $('.payment select').val();

        $.ajax(
            {
                type: "POST",
                url: 'index.php?action=pay',
                dataType: 'json',
                cache: false,
                success: function (data) {

                    // Dont seletected payment method
                    if (payment_method == null) {
                        alert('Select Payment Method');
                        return;
                    }

                    // Shopping cart empty
                    if (data.total_to_pay == 0) {
                        alert('Shopping Cart Empty');
                        return;
                    }

                    // Insufficient  balance
                    if (data.current_balance < data.total_to_pay) {
                        alert('Insufficient Current Balance');
                        return;
                    }

                    $.ajax(
                        {
                            type: 'POST',
                            url: 'index.php?action=paid',
                            data: {
                                payment_method: payment_method,
                                total_to_pay: data.total_to_pay
                            },
                            cache: false,
                            success: function () {
                                alert('Paid');
                                window.location = 'index.php';
                            }
                        }
                    );

                }
            });
    });

});