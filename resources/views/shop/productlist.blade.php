@extends('layouts.app')

@section('title', 'Product List')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('css/loader.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('css/box.css') }}">
<div class="loading">Loading&#8230;</div>
<div class="row">
    <div class="col-sm-8">
        <div class="row" id='productList'> 
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <article class="card-group-item">
                <header class="card-header">
                    <h6 class="title">Filters </h6>
                </header>
                <div class="filter-content">
                    <div class="card-body">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                    <label>Min $</label>
                    <input type="text" class="form-control" id="min_price" placeholder="$0">
                    </div>
                    <div class="form-group col-md-6 text-right">
                    <label>Max $</label>
                    <input type="text" class="form-control" id="max_price" placeholder="$1,0000">
                    </div>
                    </div>
                    </div> <!-- card-body.// -->
                </div>
            </article> <!-- card-group-item.// -->
            <div id='filterList'>
            </div>
        </div> <!-- card.// -->
    </div>
</div>
<script>
    class ListProducts {
        static buildListProducts(products)
        {
            let action_in_cart = '';
            console.log(products)
            products.forEach(function(item) {
                if (item.is_in_cart) {
                    action_in_cart = '<a href="/shoppingcart/show" class="btn btn-danger btn-sm" data-item-id="'+item.id+'" role="button">In Cart</a>'
                } else {
                    action_in_cart = '<a href="#" class="btn btn-danger btn-sm add_in_cart" data-item-id="'+item.product_id+'" role="button">Add In Cart</a>'
                }
                item = '<div class="col-sm-4 column productbox">'+
                    '<img width="120px"  src="'+item.photo+'" class="img-responsive">'+
                    '<div class="producttitle"><a target="_blank" href="/product/'+item.product_id+'">'+item.product_name+'</a></div>'+
                    '<div class="productprice"><div class="pull-right">'+action_in_cart +'</div><div class="pricetext">$'+parseFloat(item.price).toFixed(2)+'</div></div>'+
                '</div>'
                $('#productList').append(item)
            })

            $('.add_in_cart').on('click', function(e) {
                e.preventDefault();
                $('.loading').show();
                var that = this
                
                const promise = new Promise((resolve, reject) => {
                
                    const fd = new FormData;
                    fd.append('product_id', $(e.currentTarget).data('item-id'));
                    $.ajax({
                        url:  '/shoppingcart/add/',
                        data: fd,
                        processData: false,
                        contentType: false, 
                        type: 'POST',
                        success: function (data) {
                            $(that).text('In Cart');
                            $(that).removeClass('add_in_cart');
                            $(that).off('click');
                            that.href = '/shoppingcart/show'
                            resolve(data)    
                        }
                    });
                }).finally(function(){
                    let shopping_cart_item_count = $('#shopping_cart_item_count').html();
                    
                    shopping_cart_item_count++;
                    $('#shopping_cart_item_count').html(shopping_cart_item_count);
                    $('.loading').hide();
                });
            })
        }
    }

    class Filters {
        constructor(filters)
        {
            this._filters = filters
            this._url = window.location.href
            
            this.bildPriceCondition();
            this.bildListFilters(filters);
            this.fetchData()
        }

        clear()
        {
            let myNode = document.getElementById("productList");
            myNode.innerHTML = '';
        }

        bildPriceCondition()
        {
            let min_price = document.getElementById('min_price')
            let max_price = document.getElementById('max_price')
            let that = this

            let searchParams = new URLSearchParams(window.location.search)
        
            if (searchParams.get('min_price') > 0) {
                $('#min_price').val(searchParams.get('min_price'));
            }

            if (searchParams.get('max_price') > 0) {
                $('#max_price').val(searchParams.get('max_price'));
            }

            min_price.addEventListener('change', function() {
                let searchParams = new URLSearchParams(window.location.search)
                searchParams.set('min_price', min_price.value); 
             
                that._url = location.origin + location.pathname + '?' + searchParams.toString();
                history.pushState({}, null, that._url );
                that.clear();
                that.fetchData();
            });

            max_price.addEventListener('change', function() {
                let searchParams = new URLSearchParams(window.location.search)
                searchParams.set('max_price', max_price.value);
                that._url = location.origin + location.pathname + '?' + searchParams.toString();
                history.pushState({}, null, that._url );
                that.clear();
                that.fetchData();
            });
        }

        fetchData()
        {
            $('.loading').show();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var that = this;

            const promise = new Promise((resolve, reject) => {
                
                const fd = new FormData;
                //fd.append('total_price', totalPrice);
                //fd.append('payment_service_id', this.payment_service_id);
                $.ajax({
                    url:  this._url,
                    data: fd,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (data) {
                        resolve(data)    
                    }
                });
            }).then(function(result){
                ListProducts.buildListProducts(result.products);
                return(result)
            }).finally(function(){
                $('.loading').hide();
            });
        }

        bildListFilters(filters)
        {
            let filter_item = '';
            
            $.each(filters, function(category_name, category_filter) {
                filter_item = '<article class="card-group-item">'+
                    '<header class="card-header">'+
                        '<h6 class="title">' + category_name + '</h6>'
                    '</header>'+
                    '<div class="filter-content">'+
                        '<div class="card-body">';
                            category_filter.forEach(function(filter) {
                                filter_item +=  
                                '<div class="custom-control custom-checkbox">'+
                                    '<input data-attribute-slug="' + filter.attribute_slug + '" data-attribute-value-id="' + filter.attribute_value_id + '" id="FilterValue_'+ filter.attribute_value_id +'" type="checkbox" class="custom-control-input" class="filter_item_checkbox">'+
                                    '<label class="custom-control-label" for="FilterValue_'+filter.attribute_value_id+'">'+ filter.attribute_value +'</label>'+
                                '</div>'
                            })
                            filter_item +='</div>'+
                    '</div>'+
                '</article>';
                $('#filterList').append(filter_item)
            })

            var that = this;

            let searchParams = new URLSearchParams(window.location.search)
            searchParams.forEach(function(value, name) {
                $.each(value.split(','), function(index, attribute_value_id) {
                    $('#FilterValue_'+ attribute_value_id).prop('checked', true);
                })
            })

            var checkboxes = document.querySelectorAll("input[type=checkbox]");
            if (checkboxes == null) return(1)

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    let searchParams = new URLSearchParams(window.location.search)
                    let slug = $(this).attr('data-attribute-slug')
                    let value = $(this).attr('data-attribute-value-id')
                    
                    if (this.checked) {
                        if(that._url.indexOf(slug) == -1) {
                            searchParams.set(slug, value)
                        } else {
                            let existed_value = searchParams.get(slug)
                            searchParams.set(slug, existed_value + ',' + value);
                        }

                        that._url = location.origin + location.pathname + '?' + searchParams.toString();
                    } else {
                        let existed_value = searchParams.get(slug)
                        if (existed_value) {
                            let existed_value_arr = existed_value.split(',')
                            if (existed_value_arr.indexOf($(this).attr('data-attribute-value-id')) != -1) {
                                if (existed_value_arr.length > 1) {
                                    existed_value_arr.splice(existed_value_arr.indexOf($(this).attr('data-attribute-value-id')), 1)
                                    existed_value = existed_value_arr.join(',')
                                    searchParams.set(slug, existed_value);
                                } else {
                                    searchParams.delete(slug)
                                }
                            }
                        }
                        
                        
                        that._url = location.origin + location.pathname + '?' + searchParams.toString();
                    }
                    

                    history.pushState({}, null, that._url );
                    that.clear();
                    that.fetchData();
                })
            });
        }
    }

    var filters = @json($filters);

    $f = new Filters(filters);
</script>
@endsection