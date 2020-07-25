<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ $data->shop_name }}</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/ >


  <!-- Custom styles for this template -->
  <link href="{{ asset('css/shop-homepage.css') }}" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">

</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/shop">{{ $data->shop_name }}</a>
      <a class="nav-link shoping_cart" href="#"><i class="fa fa-shopping-cart"></i> (<span id="cart_count">0</span>)</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-search"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <form class="form-inline">
          <div class="input-group">
              <input class="form-control" type="text" value="{{ @$value }}" id="search" placeholder="Buscar" />
              <div class="input-group-append">
                <button class="btn btn-success" id="apply_search" type="button"><i class="fa fa-search"></i></button>
              </div>
          </div>
        </form>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container" style="margin-top: 10px !important;">

    <div class="row">

      <div class="col-lg-3 d-none d-lg-block d-block-md">
        <h4>Categorias</h4>
        <hr />
        <ul class="list-group">
          @foreach($categories as $category)
            <li class="list-group-item"><a href="/shop/category/{{ strtolower(str_replace(' ','-',$category->name)) }}-{{ $category->id }}">{{ $category->name }}</a> <span class="badge badge-success">{{ $category->products->count() }}</span></li>
          @endforeach
        </ul>
        <br />
      </div>

      <div class="col-lg-3 d-block d-lg-none">
        <div class="form-group">
          <label>Categorias:</label>
          <select class="form-control" id="mobile_category">
            <option value="">-</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" @if(@$category_id == $category->id) selected='selected' @endif data-id="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
      </div>


      <div class="col-lg-9">
        <div class="row">
          @foreach($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card">
                @if(!empty($product->photo))
                  <a href="#"><img class="card-img-top" src="{{ asset('storage/products/'.explode('/',$product->photo)[2]) }}" alt="{{ $product->name }}"></a>
                @endif
                <div class="card-body">
                  <h5>{{ $product->name }}</h5>
                  <p class="card-text">{{ $product->prices }}$</p>
                </div>
                <div class="card-footer">
                  <div class="input-group">
                    <input class="form-control" id="product_{{$product->id}}_input" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->prices }}" value="1" min="1" type="number"/>
                    <div class="input-group-append">
                      <button class="btn btn-success item" data-input="product_{{$product->id}}_input" type="button"><i class="fa fa-shopping-cart"></i>+</button>
                    </div>
                </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <div class="row fixed-bottom" id="total_buttom">
    <div class="col-md-12">
        <a class="btn btn-success btn-block shoping_cart"style="padding:20px 0px !important;" href="#">Enviar Pedido a WhatsApp <span id="total_amount">0$</span></a>
    </div>
  </div>

  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; {{ $data->shop_name }} 2020</p>
    </div>
    <!-- /.container -->
  </footer>


  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detalle de la Orden</h4>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-header">
              <h4>Lista de Productos</h4>
            </div>
            {!! Form::open(['route' => 'site.save_order', 'method' => 'POST']) !!}
            <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Nombre Cliente:</label>
                      <input type="text" name="customer_name" required="required" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Email Cliente:</label>
                      <input type="email" name="customer_email" required="required" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Telefono Cliente:</label>
                      <input type="tel" name="customer_phone" required="required" class="form-control">
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cant</th>
                    <th>Total</th>
                  </thead>
                  <tbody id="load_shopping_cart"></tbody>
                </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Enviar Orden</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>


  <script src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){

      $("#apply_search").click(function(){
        let key = $("#search").val();
        document.location = '/shop/search/'+key;
      });

      updateCountCart();

      $("button.item").click(function(){
        var element = $(this).attr("data-input");
        var _obj = $("#"+element);

        var id = _obj.attr('data-id');
        var name =  _obj.attr('data-name');
        var price = parseFloat(_obj.attr('data-price'));
        var count = parseInt(_obj.val());
        var total = parseFloat((price * count));

        var cart = [];
        var item = { "id":id, "name":name, "price":price, "count":count, "total":total };

        if(window.localStorage.getItem("cart")){
          saveDataLocalStorage(item);
        }else{
          cart.push(item);
          window.localStorage.setItem("cart", JSON.stringify(cart));
          updateCountCart();
        }

      });

      $(".shoping_cart").click(function(){

        $("#myModal").modal("show");

        var data = JSON.parse(window.localStorage.getItem("cart")) || [];
        var grandtotal = 0;
        var html = "";
        for(var i=0; i < data.length; i++){
          html+="<tr>";
            html+="<td>"+data[i].name+"</td>";
            html+="<td>"+data[i].price+"$</td>";
            html+="<td>"+data[i].count+"</td>";
            html+="<td>"+data[i].total+"$</td>";
            html+="<input type='hidden' name='order_details[]' value='"+data[i].id+"#"+data[i].count+"#"+data[i].total+"'/>";
          html+="</tr>";
          grandtotal = parseFloat(grandtotal + data[i].total);
        }
        html+="<tr><td><button type='button' class='trash_cart btn btn-danger'><i class='fa fa-shopping-cart'></i> -</button></td><td colspan='2' align='right'>TOTAL:</td><td><input type='hidden' name='grandtotal' value='"+grandtotal+"' /> "+grandtotal+"$</td></tr>";

        $("#load_shopping_cart").html(html);
        grandtotal = 0;
      });  

      $("#mobile_category").change(function(){
        let data = $(this).children("option:selected").attr("data-id");
        let name = $(this).children("option:selected").text().replace(" ","-").toLowerCase();
        if($(this).val()){
          location.href = "/shop/category/"+name+"-"+data;
        }else{
          location.href ='/shop';
        }
        
      });

      $("body").on('click','.trash_cart', function(){
        if(window.localStorage.getItem("cart")){
          window.localStorage.removeItem('cart');
          updateCountCart();
        }

        $("#myModal").modal('hide');
      });

    });

    function saveDataLocalStorage(data){
        var a = [];
        a = JSON.parse(window.localStorage.getItem("cart")) || [];
        a.push(data);
        window.localStorage.setItem("cart", JSON.stringify(a));
        updateCountCart();
    }

    function updateCountCart(){
      var data = JSON.parse(window.localStorage.getItem("cart")) || [];
      var total = 0;

      for(var i = 0; i < data.length; i++){
        total = total+data[i].total;
      }

      if(total > 0){
        $("#total_buttom").show();
        $("#total_amount").text(total+"$");
      }else{
         $("#total_buttom").hide();
      }

      
      $("#cart_count").html(data.length);
    } 

    @if(session('msg') == 'success')
      window.localStorage.removeItem('cart');
      updateCountCart();
    @endif 
  </script>
</body>
</html>
