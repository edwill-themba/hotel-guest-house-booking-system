var start_date = document.getElementById('start_date');
var end_date = document.getElementById('end_date');

//start_date.addEventListener("change",getNumberOfDays);
end_date.addEventListener("change",getNumberOfDays);

function getNumberOfDays(){
    let start = start_date.value;
    let end = end_date.value;
    var noOfDays = 0;

    // get the booking start date
    let booking_start = parseFloat(start.substring(8)) || 0;
    let booking_end =  parseFloat(end.substring(8)) || 0;
  
    if(booking_start > booking_end){
      noOfDays = (booking_start + booking_end) - booking_start;
    }else{
      noOfDays = booking_end - booking_start;
    }
   document.getElementById('no_of_Days').value = noOfDays;
}