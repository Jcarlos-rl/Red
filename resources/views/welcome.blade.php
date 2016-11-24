@extends('layouts.app')

@section('slideshow')
<div class="container">
    <div class="col-md-12">
        <div id="Carousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#Carousel" data-slide-to="0" class="active"></li>
            <li data-target="#Carousel" data-slide-to="1"></li>
            <li data-target="#Carousel" data-slide-to="2"></li>
          </ol>

          <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="wallpaper1.jpg" class=" slideshow">
                <div class="carousel-caption">
                    <h3>Slideshow #1</h3>
                </div>
            </div>

            <div class="item">
                <img src="wallpaper2.jpg" class=" slideshow">
                <div class="carousel-caption">
                    <h3>Slideshow #2</h3>
                </div>
            </div>

            <div class="item">
                <img src="wallpaper3.jpg" class="slideshow">
                <div class="carousel-caption">
                    <h3>Slideshow #3</h3>
                </div>
            </div>

          <a class="left carousel-control" href="#Carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
          </a>

          <a class="right carousel-control" href="#Carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Siguinte</span>
          </a>
        </div>
    </div>
</div>
@endsection

