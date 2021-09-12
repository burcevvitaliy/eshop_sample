@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<style>

.card{
    border-radius: 0;
}
.card .card-header{
    background-color: #fff;
    font-size: 18px;
    padding: 10px 16px;
}
.proviewcard .card-body{
    padding: 0;
}
.cardlist{
    border-bottom: 1px solid #f0f0f0;
}
.cardlist:last-child{
    border: 0;
}
.addcartimg{
    height: 100px;
}
.cartproname{
    font-size: 15px;
    color: #212529;
    line-height: 1;
    display: inline;
}
.cartproname:hover{
    color: #c16302;
    text-decoration: none;
}
.seller{
    font-size: 12px;
    color: #666;
    margin-bottom: 5px;
    line-height: 1;
}
.cartviewprice{
    margin-bottom: 8px;
    line-height: 1;
}
.cartviewprice span{
    display: inline-block;
    padding-right: 10px;
    margin-bottom: 5px;
}
.cartviewprice .amt{
    font-size: 18px;
    font-weight: 600;
}
.cartviewprice .oldamt{
    color: #757575;
    font-weight: 600;
    text-decoration: line-through;
}
.cartviewprice .disamt{
    font-weight: 600;
    color: #c16302;
}
.qty .input-group{
    width: 100%;
    height: 25px;
}
.btn-qty{
    height: 25px;
    color: #fff !important;
    background-color: #555 !important; 
    border-color: #555 !important;
    padding: 0px 3px !important;
}
.qty input{
    height: 25px;
}
.addcardrmv{
    font-size: 14px;
    line-height: 1.8;
    text-transform: uppercase;
    color: #212529;
}
.addcardrmv:hover{
    color: #c16302;
    text-decoration: none;
    font-weight: 600;
}
.prostatus .del-time {
    font-size: 12px;
    color: #757575;
    margin-right: 10px;
}
.prostatus .del-time > span {
    font-weight: 600;
    color: #555;
}
.proviewcard .card-footer{
    text-align: center;
    box-shadow: rgba(0, 0, 0, 0.1) 0px -2px 10px 0px;
    padding: 8px 15px;
}
.btn-add-con{
    background-color: #fff;
    color: #212121;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 2px 2px 0px;
    font-size: 16px;
    font-weight: 500;
    padding: 8px 20px;
    border-radius: 2px;
    border-width: 1px;
    border-style: solid;
    border-color: #E0E0E0;
    border-image: initial;
    min-width: 185px;
}
.card .card-footer{
    background-color: #fff;
}

/*Card Footer Fixed*/
@supports (box-shadow: 2px 2px 2px black){
  .cart-panel-foo-fix{
    position: sticky;
    bottom: 0;
    z-index: 9;
  }
}

.btn-cust {
    background-color: #e96125 !important;
    color: #fff !important;
    font-size: 16px;
    padding: 8px 8px;
    min-width: 128px;
}
.btn-cust:hover {
    background-color: #c74b14 !important;
    color: #fff !important;
}
</style>
<link rel="stylesheet" type="text/css" href="{{ url('css/loader.css') }}">
<div class="container-fluid mt-3 mb-4">

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-9 px-0 pr-lg-2 mb-2 mb-lg-0">
            <div class="card border-light bg-white card proviewcard shadow-sm">
                <div class="card-header">My Cart</div>
                <div class="card-body">
                   
                </div>
                <div class="card-footer border-light cart-panel-foo-fix">
                    <a href="/" class="btn btn-add-con">Continue Shopping</a>
                    <a href="/order/makeorder" class="btn btn-cust">Place Order</a>
                </div>
            </div>
        </div>
    </div>
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

    var cart_items = @json($shopping_cart_items);
    ListCartItems.buildListCartItems(cart_items);
</script>
@endsection