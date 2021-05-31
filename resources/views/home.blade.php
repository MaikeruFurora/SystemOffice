@extends('layouts.app')
@section('content')
<div class="container">
        <div class="centerSpinner spinner-grow text-info" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    <div class="row">
        <div class="col-md-6 mt-4" style="font-size:12px">
            <p>Total Numbers of Transfer In: <span id="totalNumberOfInPerYear" class="badge badge-secondary"></span> and Out: <span id="totalNumberOfOutPerYear" class="badge badge-secondary"></span> of the year</p>
        </div>
        <div id="" class="col-md-3 offset-md-3">
            <select name="" id="dropdownYear" class="form-control-sm form-control mt-2 mb-2">
            </select>
        </div>
    </div>
    <div class="row mt-3">
       
        <div class="col-lg-4 col-md-12 col-sm-12">
            <form id="transferForm">
                <div id="cardForm" class="card shadow">
                    <div class="card-body pb-0">
                        <small class="mb-5">* For the Month of
                            <em><b>{{$monthName = date('F', mktime(0, 0, 0, date("m"), 10))}}</b>
                            </em>only</small>
                        @csrf
                        <div class="form-group">
                            <label style="font-size: 12px">ID Number</label>
                            <input type="number" style="border: 1px solid #EDD3DC" class="form-control form-control-sm"
                                required name="t_id">
                        </div>
                        <div class="form-row">
                            <input type="hidden" required name="id">
                            <input type="hidden" required name="t_date" value="{{ date("m/d/y") }}">
                            <div class="form-group col-md-6">
                                <label style="font-size: 12px">First name</label>
                                <input type="text" style="border: 1px solid #EDD3DC"
                                    class="form-control form-control-sm" required name="t_fname">
                            </div>
                            <div class="form-group col-md-6">
                                <label style="font-size: 12px">Middle name</label>
                                <input type="text" style="border: 1px solid #EDD3DC"
                                    class="form-control form-control-sm" required name="t_mname">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label style="font-size: 12px">Last name</label>
                                <input type="text" style="border: 1px solid #EDD3DC"
                                    class="form-control form-control-sm" required name="t_lname">
                            </div>
                            <div class="form-group col-md-6">
                                <label style="font-size: 12px">Spouse name</label>
                                <input type="text" style="border: 1px solid #EDD3DC"
                                    class="form-control form-control-sm" required name="t_sname">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label style="font-size: 12px">Kapisanan</label>
                                <select style="border: 1px solid #EDD3DC" class="form-control form-control-sm" required
                                    name="t_kapisanan">
                                    <option value="">~ Select option ~</option>
                                    <option value="Buklod">Buklod</option>
                                    <option value="kadiwa">kadiwa</option>
                                    <option value="Binhi">Binhi</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label style="font-size: 12px">Gender</label>
                                <select style="border: 1px solid #EDD3DC" class="form-control form-control-sm" required
                                    name="t_gender">
                                    <option value="">~ Select option ~</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="font-size: 12px">Transfer Status</label>
                            <select style="border: 1px solid #EDD3DC" class="form-control form-control-sm homet_status"
                                required name="t_status">
                                <option value="">~ Select option ~</option>
                                <option value="In">Transfer In</option>
                                <option value="Out">Transfer Out</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label style="font-size: 12px">Lokal</label>
                                <input type="text" style="border: 1px solid #EDD3DC"
                                    class="form-control form-control-sm" required name="t_lokal">
                            </div>
                            <div class="form-group col-md-6">
                                <label style="font-size: 12px">Distrito</label>
                                <input type="text" style="border: 1px solid #EDD3DC"
                                    class="form-control form-control-sm" required name="t_distrito">
                            </div>
                        </div>
                        <div class="form-row" id="code">
                            <div class="form-group col-md-6">
                                <label style="font-size: 12px">LCode</label>
                                <input type="text" style="border: 1px solid #EDD3DC"
                                    class="form-control form-control-sm" name="t_lcode">
                            </div>
                            <div class="form-group col-md-6">
                                <label style="font-size: 12px">DCode</label>
                                <input type="text" style="border: 1px solid #EDD3DC"
                                    class="form-control form-control-sm" name="t_dcode">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                        <button type="submit" class="btn btn-secondary btn-sm btn-block btnc">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="benefit" class="col-lg-8 col-md-12 col-sm-12">
            
            <div class="row" id="showMonth"></div>

        </div>
    </div>
</div>
@include('layouts.modal')
@endsection