$(function () {
    const date = new Date();
    const currentMonth = date.getMonth();
    const currentYear = date.getFullYear();
    const getlistYear = [];
    const getListMonth = [];
    // const formInOut = $("#formInOut").hide();

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
    // <img src="http://127.0.0.1:8000/img/1.png" class="card-img-top" alt="...">
    // <a href="#" class="btn btn-primary btn-sm pt-0 pb-0">Total Number : <span class="badge badge-secondary">23</span></a>

    // monthNames.forEach((e, i) => {

    // });

    /**
     *
     * Transfer Form Event and action
     *
     */

    $("#transferForm").on("submit", function (e) {
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
                console.log(data);
                $("#transferForm")[0].reset();
                tableMonth.ajax.reload();
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
            });
    });

    const tableMonth = $("#example").DataTable({
        lengthChange: false,
        pageLenth: 6,
        processing: true,
        language: {
            processing: `
            <div class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">Loading...</span>
          </div>`,
        },
        ajax: "/transfer",
        columns: [
            { data: "t_fname" },
            { data: "t_kapisanan" },
            { data: "t_lokal" },
            { data: "t_distrito" },
            { data: "t_gender" },
        ],
    });

    $("#dropdownYear").on("change", function () {
        let yearChange = $(this).val();
        fetchYear(yearChange);
    });

    let fillTheDropDown = () => {
        $.ajax({
            url: "transfer-year",
            type: "GET",
            dataType: "json",
        })
            .done(function (data) {
                const twoDigit = "20",
                    a = [];
                let dropdownYearHold = "";
                data.forEach((val) => {
                    y = val.t_date.split("/");
                    a.push(y[2]);
                });
                const filtered = a.filter((val, i, arr) => {
                    return arr.indexOf(val) == i;
                });
                filtered.sort().forEach((val) => {
                    if (val == currentYear.toString().substr(-2)) {
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
    fillTheDropDown();
    let spreadMonth = (month, year) => {
        let hold = "";
        if (year == currentYear.toString().substr(-2)) {
            t;
        } else {
            month.filter((val) => {
                hold += `<div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 hvr-grow mt-2 mb-3 animated bounceIn" style="cursor:pointer">
                            <div class="card processClick" id="${val - 1}">
                            <div class="card-body">
                                <h5 class="card-title lead">${
                                    monthNames[val - 1]
                                }</h5>
                                <p style="font-size:13px;margin:1px" class="card-text">Transfer In <span class="badge badge-primary">423</span> | Out <span class="badge badge-primary">423</span></p>
                            </div>
                            </div>
                        </div>`;
            });
        }
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
                const fitleredAndSorted = array_months
                    .sort()
                    .filter((val, i, arr) => arr.indexOf(val) == i);

                spreadMonth(fitleredAndSorted, yearChange);
            })
            .fail(function (jqxHR, textStatus, errorTHrown) {
                console.log(jqxHR, textStatus, errorTHrown);
            });
    };
    fetchYear(currentYear.toString().substr(-2));
    $(document).on("click", ".processClick", function () {
        const param = $(this).attr("id");
        modalModule(monthNames[param]);
    });

    const modalModule = (title) => {
        $("#staticBackdropLabel").text(title);
        $("#staticBackdrop").modal("show");
    };

    $(document).on("click", ".btnAction", function () {
        let action = $(this).attr("id");
        let separate = action.split("_");
        modalMonth(separate[0], separate[1]);
    });

    let modalMonth = (m, action) => {
        $("#modalForMonthLabel").text(m);
        $("#modalForMonth").modal("show");
        switch (action) {
            case "list":
                $(".modal-dialog").removeClass("modal-md").addClass("modal-lg");
                tableList();
                break;
            case "add":
                $(".modal-dialog").removeClass("modal-lg").addClass("modal-md");
                formInOut.show(2000);
                break;
            default:
                alert("No Available Command");
                break;
        }
    };

    let tableList = () => {
        let HTMLTable = "";
    };
});
