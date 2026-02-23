$.fn.dataTableExt.afnFiltering.push(
function( oSettings, aData, iDataIndex ) {

    var grab_daterange = $("#date_range").val();
    var give_results_daterange = grab_daterange.split(" to ");
    var filterstart = give_results_daterange[0];
    var filterend = give_results_daterange[1];
    var iStartDateCol = 5; //using column 2 in this instance
    var iEndDateCol = 5;
    var tabledatestart = aData[iStartDateCol];
    var tabledateend= aData[iEndDateCol];

    if ( !filterstart && !filterend )
    {
    return true;
    }
    else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && filterend === "")
    {
        return true;
    }
    else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isAfter(tabledatestart)) && filterstart === "")
    {
        return true;
    }
    else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && (moment(filterend).isSame(tabledateend) || moment(filterend).isAfter(tabledateend)))
    {
        return true;
    }
    return false;
}
);