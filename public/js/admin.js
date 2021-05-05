$(function () {
    const date = new Date();
    const currentMonth = date.getUTCMonth();
    const currentYear = date.getFullYear();
    const twoDigit = "20";
    const oneDigit = "0";
    const a = [];
    let yearChange = currentYear.toString().substr(-2);
    const monthNames = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];
    const popupCenter = ({ url, title, w, h }) => {
        const dualScreenLeft =
            window.screenLeft !== undefined
                ? window.screenLeft
                : window.screenX;
        const dualScreenTop =
            window.screenTop !== undefined ? window.screenTop : window.screenY;

        const width = window.innerWidth
            ? window.innerWidth
            : document.documentElement.clientWidth
            ? document.documentElement.clientWidth
            : screen.width;
        const height = window.innerHeight
            ? window.innerHeight
            : document.documentElement.clientHeight
            ? document.documentElement.clientHeight
            : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left = (width - w) / 2 / systemZoom + dualScreenLeft;
        const top = (height - h) / 2 / systemZoom + dualScreenTop;
        const newWindow = window.open(
            url,
            title,
            `
          scrollbars=yes,
          width=${w / systemZoom}, 
          height=${h / systemZoom}, 
          top=${top}, 
          left=${left}
          `
        );
        newWindow;
    };
    const modalModule = (title) => {
        $("#staticBackdropLabel").text(title);
        $("#staticBackdrop").modal("show");
    };
    const fillTheDropDown = () => {
        let dropdownYearHold = "";
        $.ajax({
            url: "transfer-year",
            type: "GET",
            dataType: "json",
        })
            .done(function (data) {
                data.forEach((val) => {
                    y = val.t_date.split("/");
                    a.push(y[2]);
                    if (Math.max(...a) != currentYear.toString().substr(-2))
                        a.push(currentYear.toString().substr(-2));
                });
                const filtered = a.filter((val, i, arr) => {
                    return arr.indexOf(val) == i;
                });
                filtered.sort().forEach((val, i) => {
                    // console.log(val);
                    if (Math.max(val)) {
                        dropdownYearHold += `<option value="${val.substr(
                            -2
                        )}" selected>${twoDigit.concat(val)}</option>`;
                    } else {
                        dropdownYearHold += `<option value="${val.substr(
                            -2
                        )}">${twoDigit.concat(val)}</option>`;
                    }
                });
                $("#dropdownYear").html(dropdownYearHold);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
            });
    };
    $("#code").hide();
    let codeInput = (status) => {
        status === "In" ? $("#code").slideDown(1000) : $("#code").slideUp(1000);
    };
    let tableForEveryMonth = (month, year) => {
        console.log(month, year);
        if (/^\d$/.test(month)) {
            month = oneDigit.concat(month);
        } else {
            month = month;
        }
        $(".printReport").attr("value", month + "_" + year);
        $("#example").dataTable().fnDestroy();
        $("#example").DataTable({
            lengthChange: false,
            pageLenth: 6,
            processing: true,
            language: {
                processing: `
                <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>`,
            },

            ajax: `/transfer/${month}/${year}`,
            columns: [
                { data: "t_id" },
                {
                    data: null,
                    render: function (data) {
                        return `${data.t_lname}, ${data.t_fname} ${data.t_mname}`;
                    },
                },
                {
                    data: null,
                    render: function (data) {
                        return data.t_sname == "" ? "------" : data.t_sname;
                    },
                },
                { data: "t_kapisanan" },
                { data: "t_lokal" },
                {
                    data: null,
                    render: function (data) {
                        return data.t_status == "Out" ? "------" : data.t_lcode;
                    },
                },
                { data: "t_distrito" },
                {
                    data: null,
                    render: function (data) {
                        return data.t_status == "Out" ? "------" : data.t_dcode;
                    },
                },
                { data: "t_gender" },
                { data: "t_status" },
                { data: "t_date" },
                {
                    data: null,
                    render: function (data) {
                        return `<button type="button" class="btn btn-sm btn-danger csdelete pt-0 pb-0 pl-2 pr-2" id="${data.id}_${month}">
                        <span style="font-size:17px" class="float-right hvr-grow material-icons">
                        delete_forever
                            </span>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning csedit pt-0 pb-0 pl-2 pr-2" id="${data.id}_${month}">
                        <span style="font-size:17px" class="float-right hvr-grow material-icons">
                        edit
                            </span>
                        </button>`;
                    },
                },
            ],
        });
    };

    let spreadMonth = (month) => {
        let hold = "";
        month
            .sort((a, b) => a - b)
            .forEach((val, i) => {
                // $(".display").attr("id", "example_" + val);

                hold += `<div class="col-md-4 col-sm-12 mt-3">
                            <div class="card cards processClick hvr-grow shadow" style="cursor:pointer;width:100%;" id="${
                                val - 1
                            }">
                            <span style="font-size:20px;color:#ccccb3" class="float-right hvr-grow m-0 p-0 material-icons">
                            flip_to_front
                            </span>
                            <div class="card-body p-3">
                                <p>${
                                    monthNames[val - 1]
                                }</p>
                                <p class="card-text" id="countEveryMonth_${i}"><span class="spinner-border spinner-border-sm text-success" style="width:.6em;height:.6em" role="status" aria-hidden="true"></span><small> Loading...</small> </p>
                            </div>
                            
                            </div>
                        </div>`;
                // setTimeout(() => {
                countPerMonth(val, yearChange, i);
                // }, 1000);
            });
        $("#showMonth").html(hold);
    };

    let fetchYear = (yearChange) => {
        $.ajax({
            url: "transfer-filterYear/" + yearChange,
            type: "GET",
            dataType: "json",
        })
            .done(function (data) {
                const array_months = [];
                data.forEach((val) => {
                    y = val.t_date.split("/");
                    array_months.push(y[0]);
                });
                const fitleredAndSorted = array_months.filter(
                    (val, i, arr) => arr.indexOf(val) == i
                );
                if (fitleredAndSorted.length == 0) {
                    $("#showMonth")
                        .html(`<div class="col-md-4 offset-md-5 py-5">
                                   <em><small class="">No Available Data</small></em>
                                </div>`);
                } else {
                    $("#showMonth")
                        .html(`<div class="col-md-1 offset-md-5 py-5">
                                <div class="spinner-border spinner-border-sm text-info" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>`);
                    setTimeout(() => {
                        spreadMonth(fitleredAndSorted);
                    }, 1000);
                }
            })
            .fail(function (jqxHR, textStatus, errorTHrown) {
                console.log(jqxHR, textStatus, errorTHrown);
            });
    };
    fillTheDropDown();
    fetchYear(currentYear.toString().substr(-2));

    /**
     *
     *  Count All Total IN and Out
     *
     */
    const countWholeYear = (year) => {
        $("#totalNumberPerYear").html(``);
        setTimeout(() => {
            $.ajax({
                url: "transfer-wholeYear/" + year,
                type: "GET",
                dataType: "json",
            })
                .done(function (data) {
                    if (data[1] == undefined && data[0] == undefined) {
                        $("#totalNumberPerYear").html("");
                    } else {
                        $("#totalNumberPerYear")
                            .html(`Total Numbers of Transfer In: <span
                        class="badge badge-secondary">${
                            data[1] == undefined ? 0 : data[1].total
                        }</span> and Out:
                    <span class="badge badge-secondary">${
                        data[0] == undefined ? 0 : data[0].total
                    }</span> of the year
                    20${year}`);
                    }
                })
                .fail(function (jqxHR, textStatus, errorTHrown) {
                    console.log(jqxHR, textStatus, errorTHrown);
                });
        }, 1000);
    };
    countWholeYear(currentYear.toString().substr(-2));

    /**
     *
     *  Count all in and out per Month
     *
     */
    const countPerMonth = (month, year, index) => {
        $.ajax({
            url: "transfer-perMonth/" + month + "/" + year,
            type: "GET",
            dataType: "json",
        })
            .done(function (data) {
                data.forEach((val, i) => {
                    console.log(val[0], val[1]);
                    $("#countEveryMonth_" + index)
                        .html(`<small class="text-muted" style="font-size:11px">Transfer In: <span
                    class="badge badge-secondary">${
                        val[1] == undefined ? 0 : val[1].total
                    }</span> | Transfer Out: <span
                    class="badge badge-secondary">${
                        val[0] == undefined ? 0 : val[0].total
                    }</span></small>`);
                });
            })
            .fail(function (jqxHR, textStatus, errorTHrown) {
                console.log(jqxHR, textStatus, errorTHrown);
            });
    };
    $("#dropdownYear").on("change", function () {
        yearChange = $(this).val();
        fetchYear(yearChange);
        countWholeYear(yearChange);
        if (parseInt(currentYear.toString().substr(-2)) == yearChange) {
            $("#cardForm").show("right");
            $("#benefit").removeClass("col-lg-12").addClass("col-lg-8");
        } else {
            $("#cardForm").hide("left");
            $("#benefit").removeClass("col-lg-8").addClass("col-lg-12");
        }
    });

    $(".homet_status").on("change", function () {
        codeInput($(this).val());
    });

    $("#transferForm").on("submit", function (e) {
        e.preventDefault();
        $(".btnc").html(
            ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
        );
        setTimeout(() => {
            $.ajax({
                url: "/transfer-post",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
            })
                .done(function (data) {
                    $("#transferForm")[0].reset();
                    $("#code").slideUp(1000);
                    fetchYear(yearChange);
                    fillTheDropDown();
                    countWholeYear(currentYear.toString().substr(-2));
                    $(".btnc").html(`Submit`);
                    let dateMes = $("input[name='t_date']").val();
                    let seperated = dateMes.split("/");
                    tableForEveryMonth(seperated[0], parseInt(yearChange));
                })
                .fail(function (jqxHR, textStatus, errorThrown) {
                    console.log(jqxHR, textStatus, errorThrown);
                });
        }, 1000);
    });
    $(document).on("click", ".processClick", function () {
        const param = $(this).attr("id");
        console.log(param);
        modalModule(monthNames[param] + " - " + twoDigit.concat(yearChange));
        tableForEveryMonth(parseInt(param) + 1, parseInt(yearChange));
        $("#dateMe").val(parseInt(param) + 1);
    });

    $(document).on("click", ".csdelete", function () {
        let delData = $(this).attr("id");
        let deleted = delData.split("_");
        if (confirm("Are you sure? ")) {
            $.ajax({
                url: "transfer-delete/" + deleted[0],
                type: "DELETE",
                data: { _token: $('input[name="_token"]').val() },
            })
                .done(function (data) {
                    countWholeYear(currentYear.toString().substr(-2));
                    fillTheDropDown();
                    fetchYear(yearChange);
                    tableForEveryMonth(
                        parseInt(deleted[1]),
                        parseInt(yearChange)
                    );
                })
                .fail(function (jqxHR, textStatus, errorThrown) {
                    console.log(jqxHR, textStatus, errorThrown);
                });
        } else {
            return false;
        }
    });
    $("#updateContent").hide();
    $("#cancelBtn").on("click", function () {
        $("#updateContent").slideUp(900);
        $("#formEdit")[0].reset();
    });
    $(".t_status").on("change", function () {
        let statusData = $(this).val();
        console.log(statusData);
        if (statusData == "Out") {
            $("#t_lcode").attr("disabled", "disabled").val("");
            $("#t_dcode").attr("disabled", "disabled").val("");
        } else {
            $("#t_lcode").removeAttr("disabled");
            $("#t_dcode").removeAttr("disabled");
        }
    });
    $(document).on("click", ".csedit", function () {
        let editData = $(this).attr("id");
        let edit = editData.split("_");
        if (edit[0]) {
            $.ajax({
                url: "transfer-edit/" + edit[0],
                type: "PUT",
                data: { _token: $('input[name="_token"]').val() },
            })
                .done(function (data) {
                    $("#updateContent").slideDown(1000);
                    console.log(data);
                    $("#t_cid").val(data[0].id);
                    $("#t_id").val(data[0].t_id);
                    $("#t_fname").val(data[0].t_fname);
                    $("#t_mname").val(data[0].t_mname);
                    $("#t_lname").val(data[0].t_lname);
                    $("#t_sname").val(data[0].t_sname);
                    $("#t_date").val(data[0].t_date);
                    $("#t_kapisanan").val(data[0].t_kapisanan);
                    $("#t_lokal").val(data[0].t_lokal);
                    $("#t_lcode").val(data[0].t_lcode);
                    $("#t_distrito").val(data[0].t_distrito);
                    $("#t_dcode").val(data[0].t_dcode);
                    $("#t_gender").val(data[0].t_gender);
                    $("#t_status").val(data[0].t_status);

                    if (data[0].t_status == "Out") {
                        $("#t_lcode").attr("disabled", "disabled");
                        $("#t_dcode").attr("disabled", "disabled");
                    }
                })
                .fail(function (jqxHR, textStatus, errorThrown) {
                    console.log(jqxHR, textStatus, errorThrown);
                });
        } else {
            alert("Warning! fetch data Identification!", edit[0]);
        }
    });

    $("#formEdit").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "/transfer-post",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
        })
            .done(function (data) {
                $("#updateContent").slideUp(600);
                let dateMe = $("#dateMe").val();
                tableForEveryMonth(dateMe, parseInt(yearChange));
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
            });
    });

    /**
     *
     * Print Report IN and OUT
     *
     */

    $(".printReport").on("click", function () {
        let ControlReport = $(this).attr("value");
        let ControlStatus = $(this).attr("id");
        let prints = ControlReport.split("_");
        let month = prints[0];
        let year = prints[1];
        $.ajax({
            url: "transfer-print/" + month + "/" + year + "/" + ControlStatus,
            type: "GET",
            data: {
                _token: $('input[name="_token"]').val(),
            },
        })
            .done(function (data) {
                if (ControlStatus == "In") {
                    $("#In").html(
                        ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                    );
                } else {
                    $("#Out").html(
                        ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                    );
                }

                setTimeout(() => {
                    popupCenter({
                        url:
                            "transfer-print/" +
                            month +
                            "/" +
                            year +
                            "/" +
                            ControlStatus,
                        title: "Print",
                        w: 1000,
                        h: 700,
                    });
                    if (ControlStatus == "In") {
                        $("#In").html(`Transfer In`);
                    } else {
                        $("#Out").html(`Transfer Out`);
                    }
                }, 1000);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
            });
    });

    $(".close").on("click", function () {
        $("#updateContent").slideUp(500);
        $("#formEdit")[0].reset();
    });
});

/**
 *
 * edit field
 */
