@extends('layout.master')
@section('content')
    {{-- <div class="row">
        <div class="col-2">
            <select name="" class="form-control language_switcher" id="">
                <option value="">{{ Config::get('language')[App::getLocale()] }}</option>
                @foreach (Config::get('language') as $lang => $language)
                    @if ($lang != App::getLocale())
                        <option value="{{ $lang }}">
                            <a href="">{{ $language }}</a>
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div> --}}

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
                        <h2>মোট বাচ্চা</h2>
                        <p>{{ numberCountingFormat(0) }}</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <button><i class="fa-solid fa-caret-down"></i></button>
                </div>

                <div class="item-menu-info">
                    <p>
                        0
                    </p>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/polti.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>মোট পোল্টি</h2>
                        <p>{{ numberCountingFormat($poltis > 0 ? $poltis : '0') }}</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <button><i class="fa-solid fa-caret-down"></i></button>
                </div>

                <div class="item-menu-info">
                    <p>
                        {{ ($poltis > 0) ? $poltis : '0' }}
                    </p>
                </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
                <div class="d-flex custom-col">
                    <div class="dashboard_menu">
                        <img src="{{ asset('custom/logos/deth polti.png') }}" alt="polti image">
                    </div>
                    <div class="dashboard_item">
                        <h2>মৃত পোল্টি</h2>
                        <p>dynamic</p>
                    </div>
                </div>
                <div class="item-foot-head">
                    <button><i class="fa-solid fa-caret-down"></i></button>
                </div>

                <div class="item-menu-info">
                    <p>
                        dynamic
                    </p>
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
                    <button><i class="fa-solid fa-caret-down"></i></button>
                </div>

                <div class="item-menu-info">
                    <p>
                        dynamic
                    </p>
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
                    <button><i class="fa-solid fa-caret-down"></i></button>
                </div>

                <div class="item-menu-info">
                    <p>
                        {{ number_format($permanetCost, 2) . ' Tk' }}
                    </p>
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
                    <button><i class="fa-solid fa-caret-down"></i></button>
                </div>

                <div class="item-menu-info">
                    <p>
                        {{ number_format($farmCosts + $farm1Cost + $staffSalaryAmount, 2) . ' Tk' }}
                    </p>
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
                        <button><i class="fa-solid fa-caret-down"></i></button>
                    </div>

                    <div class="item-menu-info">
                        <p>
                            Dynamic
                        </p>
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
                    <button><i class="fa-solid fa-caret-down"></i></button>
                </div>

                <div class="item-menu-info">
                    <p>
                        Dynamic
                    </p>
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
                    <button><i class="fa-solid fa-caret-down"></i></button>
                </div>

                <div class="item-menu-info">
                    <p>
                        Dynamic
                    </p>
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
                    <button><i class="fa-solid fa-caret-down"></i></button>
                </div>

                <div class="item-menu-info">
                    <p>
                        {{ numberCountingFormat($staffs) }}
                    </p>
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
                        <button><i class="fa-solid fa-caret-down"></i></button>
                    </div>

                    <div class="item-menu-info">
                        <p>
                            {{ number_format($staffSalaryAmount, 2) }}
                        </p>
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
