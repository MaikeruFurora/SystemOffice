<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">


<div class="row">
    <div class="col-3 text-center">
        {{-- <img class="mt-4" src="{{ asset('img/a.png') }}" alt="" width="30%"> --}}
    </div>
    <div class="col-6">
        <div class="text-center mt-5">
            <h1 class="lead">{{$header}}</h1>
            <small>Official list for the month of {{$mydate}}, 20{{$year}}</small>
        </div>
    </div>
    <div class="col-3">

    </div>
</div>
<table class="table table-bordered table-striped mt-5">
    <thead>
        <tr>
            <td>ID No.</td>
            <td>Full name</td>
            <td>Kapisanan</td>
            <td>Lokal</td>
            @if ($status=="In")
            <td>Lcode</td>
            @endif
            <td>Distrito</td>
            @if ($status=="In")
            <td>Dcode</td>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($printData as $print)
        <tr>
            <td>{{$print->t_id}}</td>
            <td>{{$print->t_lname}}, {{$print->t_fname}} {{$print->t_mname}}</td>
            <td>{{$print->t_kapisanan}}</td>
            <td>{{$print->t_lokal}}</td>
            @if ($status=="In")
            <td>{{$print->t_lcode}}</td>
            @endif
            <td>{{$print->t_distrito}}</td>
            @if ($status=="In")
            <td>{{$print->t_dcode}}</td>
            @endif
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="7">
                No Data
            </td>
        </tr>
        @endforelse
    </tbody>
</table>