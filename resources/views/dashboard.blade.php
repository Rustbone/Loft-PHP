{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboardwww') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged indhjh!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.app')

@section('content')
<? /** @var \App\Good $good */ ?>
<div class="content-middle">
    <div class="content-head__container">
      <div class="content-head__title-wrap">
        <? /** @var \App\Category $currentCategory */ ?>
        @if (isset($currentCategory))
         <div class="content-head__title-wrap__title bcg-title">Товары в категории {{$currentCategory->title}}</div>
        @else
         <div class="content-head__title-wrap__title bcg-title">Последние товары</div>
        @endif        
      </div>
      <div class="content-head__search-block">
        <div class="search-container">
          <form class="search-container__form">
            <input type="text" class="search-container__form__input">
            <button class="search-container__form__btn">search</button>
          </form>
        </div>
      </div>
    </div>
    <div class="content-main__container">
      <div class="products-columns">
        <? /** @var \App\Good $good */ ?>
        @foreach($goods as $good)
          <div class="products-columns__item">
             <div class="products-columns__item__title-product"><a href="{{ route('good', ['id' => $good->id]) }}" class="products-columns__item__title-product__link">{{ $good->title }}</a></div>
             <div class="products-columns__item__thumbnail"><a href="{{ route('good', ['id' => $good->id]) }}" class="products-columns__item__thumbnail__link"><img src="/img/cover/game-{{ $good->getImageId() }}.jpg" alt="Preview-image" class="products-columns__item__thumbnail__img"></a></div>
             <div class="products-columns__item__description"><span class="products-price">{{$good->price}}</span><a href="#" class="btn btn-blue">Купить</a></div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="content-footer__container">
      <ul class="page-nav">
        <li class="page-nav__item"><a href="#" class="page-nav__item__link"><i class="fa fa-angle-double-left"></i></a></li>
        <li class="page-nav__item"><a href="#" class="page-nav__item__link">1</a></li>
        <li class="page-nav__item"><a href="#" class="page-nav__item__link">2</a></li>
        <li class="page-nav__item"><a href="#" class="page-nav__item__link">3</a></li>
        <li class="page-nav__item"><a href="#" class="page-nav__item__link">4</a></li>
        <li class="page-nav__item"><a href="#" class="page-nav__item__link">5</a></li>
        <li class="page-nav__item"><a href="#" class="page-nav__item__link"><i class="fa fa-angle-double-right"></i></a></li>
      </ul>
    </div>
  </div>
@endsection