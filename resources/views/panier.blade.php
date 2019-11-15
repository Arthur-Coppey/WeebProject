@extends('layouts.index')
@section('navbar')

     @include('layouts/partials/_navbar')
     

@endsection('navbar')
@section('main')

@guest 
@if (Route::has('register'))

    @include('layouts/partials/_notconnected')

@endif
{{-- connecter --}}
@else

<table class="list-articles" width="60%">
    @php
        $currentID = \Auth::user()->id;  
        $nbrFor = (App\Basket::where('user_id', $currentID)->get());
        
    @endphp

    @foreach($nbrFor as $k=>$value)
        <thead class="categories-panier">
            <th scope="col" class="txt-cate cate-photo">Photo</th>
            <th scope="col" class="txt-cate on-right">Nom</th>
            <th scope="col" class="txt-cate on-right">Prix Unitaire</th>
            <th scope="col" class="txt-cate on-right">Nombre d'articles</th>
            <th scope="col" class="txt-cate on-right">Prix total</th>
        </thead>
        <tbody>
            <tr class="article">
                <td class="icon-article-cell">
                    <img class="article-icon" src="img/boof.png">
                </td>
                <td class="nom-article on-right">
                    <a class="text-articles-panier text-nom">
                        @php    
                            $currentID = \Auth::user()->id;  
                            $product_id = $value->product_id;
                            $product_name = (App\Product::where('id', $product_id)->first()->label);
                            echo $product_name;
                        @endphp

                    </a>
                </td>
                <td class="prix-unitaire on-right">
                    @php
                        $product_price = (App\Product::where('id', $product_id)->first())->price;
                        echo ($product_price.'€');
                    @endphp
                </td>
                <td class="quantite-article on-right">
                    @php
                        $product_amount = $value->amount;
                        echo $product_amount;
                        $totalArticle[$k] = $product_amount;                 
                    @endphp
                </td>
                <td class="prix-total-article on-right">
                    @php
                        $totalProduct = $product_amount*$product_price; 
                        echo ($totalProduct);
                        $totalToPay[$k] = $totalProduct;
                    @endphp
                </td>
            </tr>
    
        </tbody>
    @endforeach
</table>

<table class="totaux" width="60%">
    <tbody>
        <tr class="infos-panier">
            <td class="padding-total" width="60%">
            </td>
            <td class="txt-totaux total on-right">
                <a class="text-articles-panier text-total">TOTAL :</a>
            </td>
            <td class="txt-totaux total-article on-right" width="9%">
                <a class="text-articles-panier nb-total-article">
                    @php
                        $addTotalProduct = 0;
                        for($i=0;$i< count($nbrFor);$i++){
                            $addTotalProduct = $addTotalProduct + $totalArticle[$i];
                        }
                        echo $addTotalProduct;

                    @endphp
                </a>
            </td>
            <td class="txt-totaux total-article on-right" width="16%">

                <a class="text-articles-panier prix-total-panier">                   
                    @php
                        $addPay = 0;
                        for($i=0;$i< count($nbrFor);$i++){
                            $addPay = $addPay + $totalToPay[$i];
                        }
                        echo $addPay.'€';
                            
                    @endphp
                </a>

            </td>
        </tr>
    </tbody>
</table>

<div class="payer">
    <div class="payer-box">
            <a class="payer-text" href="/send-mail" style="text-decoration: none; color: white;">
                PAYER
            </a>
    </div>
</div>

@endguest


@endsection('main')
