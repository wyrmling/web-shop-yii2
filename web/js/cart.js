function upquantity(productid) {
        $.ajax({
            type: 'POST',
            url: '/cart/upquantity/',
            data: {id: productid},
             success: function(data) {
                if (data !== 'nok') {
                    $('#product_'+productid+'.quantity').text('Количество: '+data[0]);
                    $('#cartcounter').text('Корзина ('+data[1]+')');
                    $('.totalsum').text('Общая сумма заказа: '+data[2]);
                }
            }
        });
    }

function downquantity(productid) {
        var newvalue = Number($('#product_'+productid+'.quantity').html().substring(12)) - 1;
        $.ajax({
            type: 'POST',
            url: '/cart/downquantity/',
            data: {id: productid},
             success: function(data) {
                if (JSON.parse(data) !== 'nok') {
                    $('#cartcounter').text('Корзина ('+JSON.parse(data)+')');
                    $('#product_'+productid+'.quantity').text('Количество: '+newvalue);
                    if (newvalue == '0') {
                    $('#product_'+productid+'.product').remove();
                    }
                    if (JSON.parse(data) == '0') {
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
             success: function(data) {
                if (JSON.parse(data) !== 'nok') {
                    $('#cartcounter').text('Корзина ('+JSON.parse(data)+')');
                    $('#product_'+productid+'.product').remove();
                    if (JSON.parse(data) == '0') {
                    location.reload();
                    }
                }
            }
        });
    }


