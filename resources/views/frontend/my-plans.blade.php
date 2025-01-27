@extends('frontend.partial.master')

@section('page-css')
    <style>
        .btn-downgrade {
            background-color: #49bce2;
            /* Light blue color */
            color: white;
            /* Adjust text color if needed */
            pointer-events: none;
            /* Make it non-clickable */
            opacity: 0.6;
            /* Slightly transparent to indicate disabled state */
            cursor: not-allowed;
            /* Show not-allowed cursor */
        }
    </style>
@endsection

@section('content')
    <div class="subscription-section">
        {{-- <h2 class="subscription-head">subscriptions </h2> --}}
        <div class="row">
            <div class="col-md-1"></div> <!-- Blank column on the left -->
            <div class="col-md-10">
                <div class="grid-subscription">
                    @foreach ($subscriptions as $key => $value)
                        <div class="home-subscrit-card-item">
                            <div class="subscrit-card-item">
                                <p class="subscrit-free-btn">
                                    {{ $value->title }}
                                </p>
                                <div class="subscrit-free-datatext">
                                    <span class="free-month-text"><span class="euro-text"><i
                                                class="fa-solid fa-euro-sign"></i>
                                            {{ $value->price }}</span>
                                        {{ $value->model_type == '1' ? 'Month' : 'Year' }}</span>

                                    <div class="subcribtion-height">
                                        @foreach ($value->SubscriptionDescription as $list)
                                            @if ($list->description != '')
                                                <p> {{ $list->description }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                    @auth
                                        @php
                                            $user = Auth::user();
                                            $isCurrentPlan = $user->subscription_id == $value->id;
                                            $currentPlanPrice = $user->subscription->price; // Assuming $user->subscription holds the current subscription plan
                                        @endphp

                                        @if ($isCurrentPlan)
                                            <a href="javascript:void(0);" class="card-subscription-btn btn-disabled btn-downgrade">
                                                {{ __('messages.subscribed') }}
                                            </a>
                                        @else
                                            @php
                                                $buttonText =
                                                    $value->price < $currentPlanPrice ? 'DOWNGRADE' : 'UPGRADE';
                                            @endphp
                                            <a href="{{ route('payment', ['subscription' => $value->id]) }}"
                                                class="card-subscription-btn">
                                                {{ $buttonText }}
                                            </a>
                                        @endif
                                    @else
                                        <a class="navbar-sign-upbtn unlog-subscription-btn" href="javascript:void(0);"
                                            data-bs-toggle="modal" data-bs-target="#siguploginModal"
                                            onclick="clearErrors()">{{ __('messages.subscribe_now') }}
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection
