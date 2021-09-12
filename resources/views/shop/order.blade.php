@extends('layouts.app')

@section('title', 'Order')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ url('css/loader.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('css/cards.css') }}">
<div class="container-fluid mt-3 mb-4">

<div class="col-lg-12">
    <div class="row">
        <h3>Order</h3>
    </div>
    <form id="form_order">
        <div class="row">
            <div class="col-4 col-lg-3 col-xl-2 p-0 qty">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="user_name" aria-describedby="" placeholder="Your Name *" required>
                    </div>
            </div>
        </div>
        <div class="row" style="margin-bottom:10px">
            <div class="col-4 col-lg-3 col-xl-2 p-0 qty">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="user_phone" aria-describedby="" placeholder="Your Phone *" required>
                    </div>
            </div>
        </div>
        <div class="row" style="margin-bottom:10px">
            <div class="col-4 col-lg-3 col-xl-2 p-0 qty">
                    <div class="input-group">
                        <input type="email" class="form-control form-control-sm" id="user_email" aria-describedby="" placeholder="Your Email">
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 px-0 pr-lg-2 mb-2 mb-lg-0">
                <div class="card border-light bg-white card proviewcard shadow-sm">
                    <div class="card-body">
                    
                    </div>
                    <div class="card-footer border-light cart-panel-foo-fix">
                        <a href="/" class="btn btn-add-con">Cancel</a>
                        <input href="/order/makeorder" id="makeorder" class="btn btn-cust" value="Approve Order" type="submit">
                    </div>
                </div>
            </div>
        </div>
</form>
</div>

</div>
<script>
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
                                                '<span class="amt">$'+item.price+' x '+item.count+' = Total: $'+parseFloat(item.price * item.count).toFixed(2)+'</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row">'+
                                        '<div class="col-4 col-lg-3 col-xl-2 p-0 qty">'+
                                            '<div class="input-group">'+
                                                '<input type="text" class="form-control form-control-sm text-center item_count" id="" data-product-id="'+item.product_id+'" aria-describedby="" value="'+item.count+'" readonly required>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                $('.card-body').append(item)
            })
        }
    }

    var cart_items = @json($shopping_cart_items);
    ListCartItems.buildListCartItems(cart_items);
    

    $(document).ready(function(){

        $('#form_order').submit(function(e) {
            e.preventDefault();
            $('.loading').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const promise = new Promise((resolve, reject) => {
                
                const fd = new FormData;
                fd.append('name', $('#user_name').val())
                fd.append('phone', $('#user_phone').val())
                fd.append('email', $('#user_email').val())
                $.ajax({
                    url:  '/order/makeorder/',
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
                alert('Order has been sent');
                window.location.href = '/'
            });
            console.log('teest')
        })
    })
</script>
@endsection