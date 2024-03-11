@extends('layout.master')
@section('content')

    <div class="row" style="display: inline-block;">
        <div class="tile_count">

            <div class="welcome_text">
                <h2>Welcome To {{ $branchName->branch_name }}</h2>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/baccha.png') }}"
                            alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>মোট বাচ্চা/ পোল্টি</h2>
                        <p>{{ $poltiInfo['polti_all'] }}</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <a href="{{ route('polti.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/deth polti.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>মৃত বাচ্চা/পোল্টি</h2>
                        <p>{{ $poltiInfo['polti_deth'] }}</p>
                    </div>
                </div>

                
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/polti.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>মোট পোল্টি বিক্রয়</h2>
                        <p>{{ $poltiInfo['polti_sell_delivered'] }}</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <a href="{{ route('polti_sell.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/polti.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>মোট পোল্টি বুকিং</h2>
                        <p>{{ $poltiInfo['polti_sell_booking'] }}</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <a href="{{ route('polti_sell.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/today expance.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>আজকের খরচ</h2>
                        <p>dynamic</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <a href="{{ route('polti.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                </div>

                
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/total expance.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>স্থায়ী খরচ</h2>
                        <p>{{ numberCountingFormat($permanetCost) . ' Tk' }}</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <a href="{{ route('polti.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/firm expance.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>ফার্ম খরচ</h2>
                        <p>{{ numberCountingFormat($farmCosts + $farm1Cost + $staffSalaryAmount) . ' Tk' }}</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <a href="{{ route('polti.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/today earn.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>আজকের আয়</h2>
                        <p>Dynamic</p>
                    </div>
                    <div class="item-foot-head">
                        <a href="{{ route('polti.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/total earn.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>মোট আয়</h2>
                        <p> Dynamic </p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <a href="{{ route('polti.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                </div>

                
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/total due.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>মোট বাকি</h2>
                        <p>Dynamic</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <a href="{{ route('polti.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                </div>

                
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/dd-removebg-preview.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>কর্মচারী</h2>
                        <p>{{ numberCountingFormat($staffs) }}</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <a href="{{ route('polti.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/staff expance.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>কর্মচারীর বেতন</h2>
                        <p>{{ numberCountingFormat($staffSalaryAmount) }}</p>
                    </div>
                    <div class="item-foot-head">
                        <a href="{{ route('polti.list') }}"><i class="fa-solid fa-caret-down"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Slim CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>

    <script>
        $("body").on('change', '.language_switcher', function(event) {
            event.preventDefault();
            var lang = $(this).val();
            var url = "{{ route('lang.switch', ':lang') }}"
            url = url.replace(':lang', lang);

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    if (response.success) {
                        console.log("Language changed successfully", response);
                        window.location.reload();
                    } else {
                        console.log("Language change failed", response.message);
                        window.location.reload();
                    }
                },
                error: function(error) {
                    console.log("Error changing language", error);
                    window.location.reload();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.item-foot-head').click(function(){
                // Find the corresponding .item-menu-info within the parent .tile_stats_count
                var menuInfo = $(this).closest('.tile_stats_count').find('.item-menu-info');

                // Toggle the visibility of the found .item-menu-info element
                menuInfo.toggle();
            });
        });
    </script>
@endsection
