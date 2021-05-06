<!-- Modal -->
<div class="modal fade animated fadeIn" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h5 class="modal-title lead ml-2" id="staticBackdropLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="updateContent">
                    <form id="formEdit">
                        @csrf
                        <input type="hidden" name="dateMe" id="dateMe">
                        <input type="hidden" name="id" id="t_cid">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail4" style="font-size:12px">ID Number</label>
                                <input type="text" class="form-control form-control-sm" name="t_id" id="t_id"
                                    style="height:calc(1em + .5rem + 2px)">
                            </div>
                            <div class="form-group col-md-2">
                                <label style="font-size:12px">First name</label>
                                <input type="text" class="form-control form-control-sm" name="t_fname" id="t_fname"
                                    style="height:calc(1em + .5rem + 2px)">
                            </div>
                            <div class="form-group col-md-2">
                                <label style="font-size:12px">Middle name</label>
                                <input type="text" class="form-control form-control-sm" name="t_mname" id="t_mname"
                                    style="height:calc(1em + .5rem + 2px)">
                            </div>
                            <div class="form-group col-md-2">
                                <label style="font-size:12px">Last name</label>
                                <input type="text" class="form-control form-control-sm" name="t_lname" id="t_lname"
                                    style="height:calc(1em + .5rem + 2px)">
                            </div>
                            <div class="form-group col-md-2">
                                <label style="font-size:12px">Spouse name</label>
                                <input type="text" class="form-control form-control-sm" name="t_sname" id="t_sname"
                                    style="height:calc(1em + .5rem + 2px)">
                            </div>
                            <div class="form-group col-md-2">
                                <label style="font-size:12px">Date</label>
                                <input type="text" class="form-control form-control-sm" name="t_date" id="t_date"
                                    style="height:calc(1em + .5rem + 2px)">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label style="font-size:12px">Kapisanan</label>
                                <select class="form-control form-control-sm"
                                    style="height:calc(1em + .5rem + 2px);padding-top:0px" required name="t_kapisanan"
                                    id="t_kapisanan">
                                    <option value="">~ Select option ~</option>
                                    <option value="Buklod">Buklod</option>
                                    <option value="kadiwa">kadiwa</option>
                                    <option value="Binhi">Binhi</option>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label style="font-size:12px">Lokal</label>
                                        <input type="text" class="form-control form-control-sm" name="t_lokal"
                                            id="t_lokal" style="height:calc(1em + .5rem + 2px)">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label style="font-size:12px">LCode</label>
                                        <input type="text" class="form-control form-control-sm" name="t_lcode"
                                            id="t_lcode" style="height:calc(1em + .5rem + 2px)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label style="font-size:12px">Distrito</label>
                                        <input type="text" class="form-control form-control-sm" name="t_distrito"
                                            id="t_distrito" style="height:calc(1em + .5rem + 2px)">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label style="font-size:12px">DCode</label>
                                        <input type="text" class="form-control form-control-sm" name="t_dcode"
                                            id="t_dcode" style="height:calc(1em + .5rem + 2px)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label style="font-size:12px">Gender</label>
                                <select class="form-control form-control-sm"
                                    style="height:calc(1em + .5rem + 2px);padding-top:0px" required name="t_gender"
                                    id="t_gender">
                                    <option value="">~ Select option ~</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label style="font-size:12px">Transfer Status</label>
                                <select class="form-control form-control-sm t_status"
                                    style="height:calc(1em + .5rem + 2px);padding-top:0px" required name="t_status"
                                    id="t_status">
                                    <option value="">~ Select option ~</option>
                                    <option value="In">Transfer In</option>
                                    <option value="Out">Transfer Out</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label style="font-size:12px">&nbsp;</label>
                                        <button type="button" class="btn btn-warning btn-sm btn-block" id="cancelBtn"
                                            style="font-size:10px">Cancel
                                        </button>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label style="font-size:12px">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-sm btn-block"
                                            style="font-size:10px">Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="btn-group shadow float-left" role="group" aria-label="Basic example">
                            <button type="button" id="In" class="printReport btn btn-sm btn-secondary"
                                style="font-size: 13px">Transfer
                                <b>IN</b></button>
                            <button type="button" id="Out" class="printReport btn btn-sm btn-secondary"
                                style="font-size: 13px">Transfer
                                <b>OUT</b></button>
                        </div>
                        <table id="example"
                            class="mt-0 table table-striped table-bordered dt-responsive nowrap lead shadow"
                            style="width:100%;font-size:12px">
                            <thead>
                                <tr>
                                    <th scope="col">ID No.</th>
                                    <th scope="col">Full name</th>
                                    <th scope="col">Spouse name</th>
                                    <th scope="col">Kapisanan</th>
                                    <th scope="col">Lokal</th>
                                    <th scope="col">Lcode</th>
                                    <th scope="col">Distrito</th>
                                    <th scope="col">Dcode</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>