import Swal from "sweetalert2";
import { Inertia } from '@inertiajs/inertia'

export const notify = (message = "Action performed successfully", type = 'success', duration = 3000) => {

    const BG_SUCCESS = "#16a34a";
    const BG_ERROR = "#b91c1c";

    let background;

    switch (type) {
        case "error":
            background = BG_ERROR;
            break;
        default:
            background = BG_SUCCESS;
            break;
    }

    swal.fire({
        position: 'top-end',
        toast: true,
        icon: type,
        title: message,
        showConfirmButton: false,
        background: background,
        color: "#fff",
        iconColor: "#fff",
        timer: duration
    });
}

export const confirm = (
    uri = "/",
    title = "Are you sure?",
    html = "You won't be able to revert this!",
    confirmButtonText = "Yes, delete it!"
) => {
    Swal.fire({
        title: title,
        html: html,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmButtonText
    }).then((result) => {
        if (result.isConfirmed) {
           Inertia.delete(uri)
        }
    })
}