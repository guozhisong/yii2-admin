$(function(){
    var startCreated_at = $('#startCreated_at').val();
    var endCreated_at = $('#endCreated_at').val();
    var startCreated = new Date(startCreated_at.replace("-", "/").replace("-", "/"));
    var endCreated = new Date(endCreated_at.replace("-", "/").replace("-", "/"));
    if( endCreated <= startCreated && startCreated_at != 0  && endCreated_at != 0 ) {
        alert('终止时间必须大于开始时间!');
        $('#startCreated_at').val('0');
        $('#endCreated_at').val('0');
    }
})
