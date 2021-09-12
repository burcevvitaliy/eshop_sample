@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('css/loader.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('css/cards.css') }}">
<div class="loading">Loading&#8230;</div>
<div class="container-fluid mt-3 mb-4">

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-9 px-0 pr-lg-2 mb-2 mb-lg-0">
            <div class="card border-light bg-white card proviewcard shadow-sm">
                <div class="card-header">My Cart</div>
                <div class="card-body">
                   
                </div>
                <div class="card-footer border-light cart-panel-foo-fix">
                    <a href="/" class="btn btn-add-con continue_shopping">Continue Shopping</a>
                    <a href="/order/prepareorder" class="btn btn-cust">Place Order</a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<script>
    $('.loading').hide();
    class ListCartItems
    {
        static buildListCartItems(cart_items)
        {
            console.log(cart_items);
            cart_items.forEach(function(item) {
                item = '<div class="col-lg-12 p-3 cardlist">'+
                        '<div class="col-lg-12">'+
                            '<div class="row">'+
                                '<div class="col-lg-12">'+
                                    '<div class="row">'+
                                        '<div class="col-4 col-lg-3 col-xl-2">'+
                                            '<div class="row">'+
                                                '<img src="'+item.photo+'" class="mx-auto d-block mb-1 addcartimg">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-8 col-lg-9 col-xl-10">'+
                                            '<div class="d-block text-truncate mb-1">'+
                                                '<a href="cateview.php" class="cartproname">'+item.name+'</a>'+
                                            '</div>'+
                                            '<div class="cartviewprice d-block">'+
                                                '<span class="amt">$'+item.price+'</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row">'+
                                        '<div class="col-4 col-lg-3 col-xl-2 p-0 qty">'+
                                            '<div class="input-group">'+
                                                '<input type="text" class="form-control form-control-sm text-center item_count" id="" data-product-id="'+item.product_id+'" aria-describedby="" value="'+item.count+'" required>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-lg-3 col-5"><a href="" data-item-id="'+item.id+'" class="addcardrmv">Remove</a></div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                $('.card-body').append(item)
            })

            $('.item_count').on('change', function() {
                $('.loading').show();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let count = this.value;
              
                let product_id = $(this).data('productId')

                const promise = new Promise((resolve, reject) => {
                
                    const fd = new FormData;
                    fd.append('count', count);
                    fd.append('product_id', product_id);
                    $.ajax({
                        url:  '/shoppingcart/changeitemcount/',
                        data: fd,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function (data) {
                            resolve(data)    
                        }
                    });
                }).finally(function(){
                    $('.loading').hide();
                });
            });

            $('.addcardrmv').on('click', function(e) {
                e.preventDefault();
               
                $('.loading').show();
     
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(this).closest('.cardlist').remove();

                const promise = new Promise((resolve, reject) => {
                
                    const fd = new FormData;
                    fd.append('product_id', $(e.currentTarget).data('item-id'));
                    $.ajax({
                        url:  '/shoppingcart/remove/',
                        data: fd,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function (data) {
                            resolve(data)    
                        }
                    });
                }).finally(function(){
                    $('.loading').hide();
                });
            });
        }
    }

    $('.continue_shopping').click(function(e){
        e.preventDefault();
        window.location.href = document.referrer;
    })

    var cart_items = @json($shopping_cart_items);
    ListCartItems.buildListCartItems(cart_items);
</script>
@endsection