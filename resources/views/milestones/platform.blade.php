@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2><i class="fab fa-windows"></i> {{ $milestone->osname }} {{ $milestone->name }}<small>version {{ $milestone->version }}</small></h2>
        <p class="lead">{{ $milestone->description }}</p>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('milestones/'.$milestone->id) }}">
                    Overview
                </a>
            </li>
            @foreach ($platforms as $platform)
                <li class="nav-item">
                    <a class="nav-link {{ $platform_id == $platform->platform ? 'active' : '' }}" href="{{ URL::to('milestones/'.$milestone->id.'/'.$platform->platform) }}">
                        {{ getPlatformById($platform->platform) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-6">
        @if ($previous)
            <a href="{{ URL::to('milestones/'.$previous->id) }}" class="milestone-navigation" style="background-color: #{{ $previous->color }}">
                <i class="fal fa-fw fa-angle-double-left"></i> <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $previous->osname }}</span> {{ $previous->name }}
            </a>
        @endif
    </div>
    <div class="col-6">
        @if ($next)
            <a href="{{ URL::to('milestones/'.$next->id) }}" class="milestone-navigation" style="background-color: #{{ $next->color }}">
                <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $next->osname }}</span> {{ $next->name }} <i class="fal fa-fw fa-angle-double-right"></i>
            </a>
        @endif
    </div>
    <div class="spacing-10"></div>
    <div class="col">
        <div class="timeline">
            @foreach ($timeline as $build => $rings)
                <div class="timeline-row">
                    <a class="row" href="{{ URL::to('build/'.explode('.', $build)[0].'/'.$platform_id) }}">
                        <div class="col-6 col-md-2 build"><img src="{{ asset('img/platform/'.getPlatformImage($platform_id)) }}" class="img-platform img-jump" alt="{{ getPlatformById($platform_id) }}" />{{ $build }}</div>
                        @if (in_array($platform_id, [1, 3]))
                        <div class="col ring">
                            <span class="label skip">{{ array_key_exists('1', $rings) ? $rings['1'] : '' }}</span>
                        </div>
                        @endif
                        @if (in_array($platform_id, [1, 2, 3]))
                        <div class="col ring">
                            <span class="label fast">{{ array_key_exists('2', $rings) ? $rings['2'] : '' }}</span>
                        </div>
                        @endif
                        @if (in_array($platform_id, [1, 2, 3, 4, 5, 6, 7]))
                        <div class="col ring">
                            <span class="label slow">{{ array_key_exists('3', $rings) ? $rings['3'] : '' }}</span>
                        </div>
                        @endif
                        @if (in_array($platform_id, [3]))
                        <div class="col ring">
                            <span class="label preview">{{ array_key_exists('4', $rings) ? $rings['4'] : '' }}</span>
                        </div>
                        @endif
                        @if (in_array($platform_id, [1, 2, 3]))
                        <div class="col ring">
                            <span class="label release">{{ array_key_exists('5', $rings) ? $rings['5'] : '' }}</span>
                        </div>
                        @endif
                        <div class="col ring">
                            <span class="label targeted">{{ array_key_exists('6', $rings) ? $rings['6'] : '' }}</span>
                        </div>
                        @if (in_array($platform_id, [1, 2, 5, 6, 7]))
                        <div class="col ring">
                            <span class="label broad">{{ array_key_exists('7', $rings) ? $rings['7'] : '' }}</span>
                        </div>
                        @endif
                        @if (in_array($platform_id, [1, 4, 5]))
                        <div class="col ring">
                            <span class="label ltsc">{{ array_key_exists('8', $rings) ? $rings['8'] : '' }}</span>
                        </div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection