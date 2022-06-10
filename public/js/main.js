/* Search */
var products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: path + '/search/typeahead?query=%QUERY'
    }
});

products.initialize();

$("#typeahead").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'products',
    display: 'title',
    limit: 10,
    source: products
});

$('#typeahead').bind('typeahead:select', function(ev, suggestion) {
    window.location = path + '/search/?s=' + encodeURIComponent(suggestion.title);
});
/* Search */

/* Cart */
$('body').on('click', '.add-to-cart-link', function (e) {
    e.preventDefault();
    const id = $(this).data('id');
    const qty = $('.quantity input').val() ? $('.quantity input').val() : 1;
    const mod = $('.available select').val();
    $.ajax({
        url: '/cart/add',
        data: {id: id, qty: qty, mod: mod},
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function (res) {
            alert('Ошибка! Попробуйте позже...');
        }
    })
});

$('#cart .modal-body').on('click', '.del-item', function () {
    const id = $(this).data('id');
    $.ajax({
        url: '/cart/delete',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('Не удалось удалить элемент. Попробуйте еще раз...');
        },
    });
});

function showCart(cart) {
    if ($.trim(cart) == '<h3>Корзина пуста</h3>') {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none')
    } else {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block')
    }

    $('#cart .modal-body').html(cart);
    $('#cart').modal();

    if ($('.cart-sum').text()) {
        $('.simpleCart_total').html($('#cart .cart-sum').text());
    } else {
        $('.simpleCart_total').text('Empty Cart');
    }
}

function getCart() {
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function (res) {
            alert('Ошибка! Попробуйте позже...');
        }
    })
}

function clearCart() {
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function(res) {
            showCart(res);
        },
        error: function() {
            alert('Ошибка! Поробуйте еще раз...');
        }
    });
}


$('#currency').change(function () {
    window.location = 'currency/change?curr=' + $(this).val();
});

$('.available select').on('change', function() {
    const modId = $(this).val();
    const color = $(this).find('option').filter(':selected').data('title');
    const price = $(this).find('option').filter(':selected').data('price');
    const basePrice = $('#base-price').data('base');

    if (price) {
        $('#base-price').text(symbolLeft +  ' ' + price + symbolRight);
    } else {
        $('#base-price').text(symbolLeft + ' ' +  basePrice + symbolRight);
    }
})

/* Cart */