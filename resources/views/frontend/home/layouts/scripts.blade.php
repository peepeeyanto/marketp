<script>
    $(document).ready(function () {
        $.ajaxSetup({
            "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
        });

        $('.shopping-cart-form').on('submit', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                method: 'POST',
                data: formData,
                url: '{{ route('add2cart') }}',
                success: function(data){
                    if(data.status == 'success'){
                        getCartCount();
                        fetchSideCart();
                        $('.minicart_action').removeClass('d-none');
                        toastr.success(data.message);
                    }
                    else if(data.status == 'stock_out'){
                        toastr.error(data.message);
                    }
                },
                error: function(data){

                }
            })
        })

        function getCartCount(){
            $.ajax({
               method:'GET',
               url:'{{ route('cart-count') }}',
               success:function(data){
                   $('#cart-count').text(data);
               },
               error:function(data){

               }

           })
        }

        function fetchSideCart(){
            $.ajax({
                url: "{{ route('cart-product') }}",
                method: "get",
                success : function (data) {
                    console.log(data);
                    $('.sidecart').html('');
                    var html = "";
                    for(let item in data){
                        let product = data[item];
                        html += (`
                            <li id="minicart_${product.rowId}">
                                <div class="wsus__cart_img">
                                    <a href="#"><img src="{{ asset('/') }}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                                    <a class="wsis__del_icon del_product" data-rid="${product.rowId}" href="#"><i class="fas fa-minus-circle"></i></a>
                                </div>
                                <div class="wsus__cart_text">
                                    <a class="wsus__cart_title" href="{{ url('product-detail') }}/${product.options.slug}">${product.name}</a>
                                    <p>Rp${product.price}</p>
                                    <small>Tambahan: Rp${product.options.variants_total}</small>
                                    <br>
                                    <small>qty: ${product.qty}</small>
                                </div>
                            </li>
                        `)
                    }
                    $('.sidecart').html(html);
                    getSideCartSubTotal();
                },
                error : function (data){
                    console.log(data);
                }
            })
        }

        $('body').on('click', '.del_product', function(e){
            e.preventDefault();
            let rowId = $(this).data('rid');
            $.ajax({
                url : "{{ route('cart-removeSideProduct') }}",
                method: "post",
                data:{
                    rowId : rowId
                },
                success  : function(data){
                    let productId ='minicart_' + rowId;
                    $('#'+productId).remove();
                    getSideCartSubTotal();
                    if($('.sidecart').find('li').length == 0){
                        $('.sidecart').html('<li class="text-center">Keranjang kosong</li>');
                        $('.minicart_action').addClass('d-none')
                    }
                    toastr.success(data.message);
                },
                error :function (data){
                    console.log(data);
                }
            })
        })

        function getSideCartSubTotal(){
            $.ajax({
                url : "{{ route('cart-subtotal') }}",
                method:"get",
                success  :function (data){
                    $('#stotal').text("Rp" + data);
                },
                error : function (data){
                    console.log(data)
                }
            })
        }


    })
</script>
