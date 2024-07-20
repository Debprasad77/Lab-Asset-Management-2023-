src = "jquery.min.js";

function addClick() {
  document.querySelector(".form_section").style.display = "flex";
}
document.getElementById("close").addEventListener("click", function () {
  document.querySelector(".form_section").style.display = "none";

  //_kalyan******************************************
  if (
    document.getElementById("product").value != "" ||
    document.getElementById("file").value != ""
  ) {
    
    window.location.reload();
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const row = document.querySelectorAll("td[data-href]");
  row.forEach((row) => {
    row.addEventListener("click", () => {
      window.location.href = row.dataset.href;
    });
  });
});

let input = document.querySelector("#file");
let span = document.querySelector("#file_err");
let btnshow = document.querySelector("#btn");

input.addEventListener("change", () => {
  let files = input.files;

  if (files.length > 0) {
    if (files[0].size > 1 * 1024 * 1024) {
      span.innerText = "File Size Exceeds 1MB";

      btnshow.disabled = true;
      return;
    }
  }

  span.innerText = "";
  btnshow.disabled = false;
});

function remove(vlu) {
  (async () => {
    const { value: password } = await Swal.fire({
      title: "Enter your password",
      input: "password",
      inputLabel: "Password",
      inputPlaceholder: "Enter your password",
      inputAttributes: {
        autocapitalize: "off",
        autocorrect: "off",
      },
    });
    if (password) {
      $.post(
        "../php/delete_per.php",
        {
          ChPassword: password,
        },
        function (data) {
          if (data == '1') {
            window.location.href = "../php/_delete_lab1_product.php?id=" + vlu;
          } else {
            Swal.fire("Wrong password.");
          }
        }
      );
    } else {
      Swal.fire(`Entered password.`);
    }
  })();
}

// function remove(vlu) {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "All records of this product will be DELETED permanently!!!\nYou won't be able to revert this!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete it!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location.href = "../php/_delete_lab1_product.php?id=" + vlu;
//         }
//     })
// }
