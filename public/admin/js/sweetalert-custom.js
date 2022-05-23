//===================== Delete ===========================//
$(document).on("click", "#delete", function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Re-Confirm!',
                'Are you really want to delete?',
                'success'
            ).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            })
        }
    })

});


//===================== Cancel Order ===========================//
$(document).on("click", "#orderCancel", function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
        title: "Are you sure To Cancel?",
        text: "Once Canceled, you will not go Back Step Again!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Canceled!'
    })
    .then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;

        } 

    });
});


//===================== Confirm Order ===========================//
$(document).on("click", "#orderConfirm", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
    
        Swal.fire({
            title: "Are you sure To Confirm?",
            text: "Once Confirmed, you will not go Back Step Again!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirmed!'
        })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;

            } 

        });
});



//===================== Processing Order ===========================//
$(document).on("click", "#orderProcessing", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
    
        Swal.fire({
            title: "Are you sure To Processing?",
            text: "Once Processed, you will not go Back Step Again!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Picked!'
        })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;

            } 

        });
});



//===================== Processing Order ===========================//
$(document).on("click", "#orderPicked", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
    
        Swal.fire({
            title: "Are you sure To Picked?",
            text: "Once Picked, you will not go Back Step Again!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Picked!'
        })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;

            } 

        });
});



//===================== Processing Order ===========================//
$(document).on("click", "#orderShipped", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
    
        Swal.fire({
            title: "Are you sure To Shipped?",
            text: "Once Shipped, you will not go Back Step Again!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Shipped!'
        })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;

            } 

        });
});



//===================== Processing Order ===========================//
$(document).on("click", "#orderDelivered", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
    
        Swal.fire({
            title: "Are you sure To Delivered?",
            text: "Once Delivered, you will not go Back Step Again!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delivered!'
        })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;

            } 

        });
});

