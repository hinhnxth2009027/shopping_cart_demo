<!DOCTYPE html>
<html>
@include('.client.layout.head')
<body>
<!-- HEADER =============================-->
@include('.client.layout.header')
<!-- CONTENT =============================-->
<section class="item content">
    <div class="container toparea">
        <div class="underlined-title">
            <div class="editContent">
                <h1 class="text-center latestitems">ORDER</h1>
            </div>
            <div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
            </div>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">email</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày order</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th>{{$order->id}}</th>
                        <td>{{$order->ship_name}}</td>
                        <td>{{$order->ship_phone}}</td>
                        <td>{{$order->ship_email}}</td>
                        <td>Đã vứt</td>
                        <td>{{$order->created_at->format('d/m/Y')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr>
        </div>
    </div>
</section>
@csrf
<!-- FOOTER =============================-->
@include('.client.layout.footer')
<!-- Load JS here for greater good =============================-->
@include('.client.layout.script')

</body>
</html>
