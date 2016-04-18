function upquantity(productid) {
    $.ajax({
        type: 'POST',
        url: '/cart/upquantity/',
        data: {id: productid},
        success: function (data) {
            if (data !== 'nok') {
                $('#product_' + productid + '.quantity').text('Количество: ' + data[0]);
                $('#cartcounter').text('Корзина (' + data[1] + ')');
                $('.totalsum').text('Общая сумма заказа: ' + data[2]);
            }
        }
    });
}

function downquantity(productid) {
    $.ajax({
        type: 'POST',
        url: '/cart/downquantity/',
        data: {id: productid},
        success: function (data) {
            if (data !== 'nok') {
                $('#product_' + productid + '.quantity').text('Количество: ' + data[0]);
                $('#cartcounter').text('Корзина (' + data[1] + ')');
                $('.totalsum').text('Общая сумма заказа: ' + data[2]);
                if (data[0] === 0) {
                    $('#product_' + productid + '.product').remove();
                }
                if (data[1] === 0) {
                    location.reload();
                }
            }
        }
    });
}

function deleteproduct(productid) {
    $.ajax({
        type: 'POST',
        url: '/cart/delete/',
        data: {id: productid},
        success: function (data) {
            if (data[0] !== 'nok') {
                $('#cartcounter').text('Корзина (' + data[0] + ')');
                $('#product_' + productid + '.product').remove();
                $('.totalsum').text('Общая сумма заказа: ' + data[1]);
                if (data[0] === 0) {
                    location.reload();
                }
            }
        }
    });
}
