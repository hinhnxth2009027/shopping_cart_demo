<!DOCTYPE html>
<html>
@include('.client.layout.head')
<body>
<!-- HEADER =============================-->
@include('.client.layout.header')
<!-- CONTENT =============================-->
<section class="item content">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('save_order')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ship information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Fullname</label>
                                <input type="text" placeholder="Enter fullname" class="form-control" name="ship_name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Phone number</label>
                                <input type="text" placeholder="Enter your phone number" class="form-control"
                                       name="ship_phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Email</label>
                                <input type="text" placeholder="Enter your email" class="form-control"
                                       name="ship_email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Address</label>
                                <input type="text" placeholder="Enter your address" class="form-control"
                                       name="ship_address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Note</label>
                                <input type="text" placeholder="Enter note" class="form-control" name="note">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit order</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container toparea">
        <div class="underlined-title">
            <div class="editContent">
                <h1 class="text-center latestitems">SHOPPing CART</h1>
            </div>
            <div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
            </div>
        </div>

        <div class="row">
            @if(sizeof($list) < 1)
                <h3 style="margin-bottom: 40px;">Giỏ hàng của bạn đang chống <a href="{{route('show_all_product')}}">đi đến mua sắm</a></h3>
            @endif
            @foreach($list as $item)
                <div id="cart_item{{$item->id}}" class="col-12"
                     style="height: 160px;margin-bottom: 8px;box-shadow: 1px 3px 6px">
                    <div class="show_thumbnail" style="height: 100%;width: 160px;float: left;">
                        <img style="width: 100%;height: 100%;object-fit: cover"
                             src="{{$item->thumbnail}}"
                             alt="...">
                    </div>
                    <div class="col row" style="height: 100%">
                        <div class="col-md-8">
                            <strong style="font-size: 14px;margin-bottom: 2px">#{{$item->id}}</strong><br>
                            <p style="font-size: 14px;margin-bottom: 2px"><strong>Product name
                                    :</strong> {{$item->product_name}}</p>
                            <p style="margin-bottom: 2px;margin-top: 0;font-size: 14px"><strong>Price / 1product
                                    :</strong> <span style="color: #f44848;font-weight: bold">${{$item->price}}</span>
                            </p>
                            <p style="font-size: 14px;margin-bottom: 2px"><strong>Quantity : </strong><input
                                    class="{{$item->id}}"
                                    style="font-weight: bold;border: none;box-shadow: 0 0 3px;border-radius: 5px"
                                    type="number" min="1" max="10000" step="1" value="{{$item->quantity}}"></p>
                            <p style="font-size: 14px;margin-bottom: 2px"><strong>Total price for the product
                                    : </strong><span
                                    style="font-weight: bold;color: #f44848"
                                    class="price{{$item->id}}">${{$item->quantity*$item->price}}</span>
                            </p>
                            <p style="font-size: 14px ;margin-bottom: 2px; width: 100%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap">
                                <strong>Description</strong> : {{$item->description}}?</p>
                        </div>
                        <div style="height: 100%">
                            <button slot="{{$item->id}}" class="btn btn-info update_cart"
                                    style="display: block;margin:10px auto;width: 120px">Update
                            </button>
                            {{--                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-warning" style="display: block;margin:10px auto;width: 120px">Buy--}}
                            {{--                            </button>--}}
                            <button slot="{{$item->id}}" class="btn btn-danger btn_remove_item"
                                    style="display: block;margin:10px auto;width: 120px">Remove
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
            <div style="margin-top: 10px">
                <h4>Total price : <span style="color: red" class="total_price">${{$total_price }}</span></h4>
                <button data-toggle="modal" data-target="#exampleModal"
                        style="display: flex;width: 170px;height: 50px;justify-content: center;align-items: center"
                        class="btn btn-warning">Order
                </button>
            </div>
        </div>
    </div>
    @csrf
</section>
<!-- FOOTER =============================-->
@include('.client.layout.footer')
<!-- Load JS here for greater good =============================-->
@include('.client.layout.script')
</body>
</html>
