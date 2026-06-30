@extends('layouts.app')



@section('content')

<x-navbar />

<div class="pt-24"></div>

<x-hero />


<x-category />

<x-catalog :accounts="$accounts"/>

<x-stats />

<x-testimonials :testimonials="$testimonials" />

@endsection