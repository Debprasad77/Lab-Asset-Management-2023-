// _kalyan*****************************************

function addClick() {
    document.querySelector('.form_section').style.display = 'flex';
}
document.getElementById('close').addEventListener('click', function () {
    document.querySelector('.form_section').style.display = 'none';

    if(document.getElementById('product').value != '' || document.getElementById('file').value != ''){
        window.location.reload();
    }
});

function remove(vlu) {
    Swal.fire({
        title: 'Are you sure?',
        text: "All records of this product will be DELETED permanently!!!\nYou won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "../php/_delete_lab1_pro_1.php?id=" + vlu;
        }
    })
}

function Srepair(vlu) {
    (async () => {

        const { value: formValues } = await Swal.fire({
            title: 'Multiple inputs',
            html:
                '<input type="hidden" id="swal-input4">' +
                '<label class="response" for="swal-input1">Repair Center Name:</label>' +
                '<input type="text" id="swal-input1" class="swal2-input">' +

                '<label class="response" for="swal-input1">Send for Repair Date:</label>' +
                '<input type="date" id="swal-input2" class="swal2-input">' +

                '<label class="response" for="swal-input2">Expected Receive Date:</label>' +
                '<input type="date" id="swal-input3" class="swal2-input">',
            focusConfirm: false,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                    document.getElementById('swal-input2').value,
                    document.getElementById('swal-input3').value,
                    document.getElementById('swal-input4').innerHTML = vlu
                ]
            }
        })
        // if (formValues) {
        //     window.location.href = "../php/_updateStatus.php?id=" + vlu;
        //   }
        if (formValues) {
            $.post('../php/_lab1_pro_1_updateStatus.php?id=', {
                repair_info: formValues
            }, function (data) {
                if (data == '1') {
                    window.location.reload();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Status Not Updated!'
                      })
                }
            }
            )
        }
    })()
}