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

    Swal.fire({
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

export const cancelAlert = (
    uri = "/",
    title = "Are you sure?",
    html = "unsaved work will lost forever.",
    confirmButtonText = "Yes, leave now.",

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
            Inertia.visit(uri)
        }
    })
}

export const notify2 = {
    redirect: (
        watching = null,
        uri = "/",
        title = "Are you sure?",
        html = "unsaved work will lost forever.",
        confirmButtonText = "Yes, leave now.",
    ) => {

        if (watching.length === 0) {
            Inertia.visit(uri);
        }
        else {
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
                    Inertia.visit(uri)
                }
            })
        }
    },
    delete: (
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
    },
    alert: (message = "Action performed successfully", type = 'success', duration = 3000) => {

        const BG_SUCCESS = "#16a34a";
        const BG_ERROR = "#b91c1c";

        let background;

        switch (type) {
            case "error":
                background = BG_ERROR;
                duration = 60000;
                break;
            default:
                background = BG_SUCCESS;
                break;
        }

        Swal.fire({
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
    },
    confirm: (
        callback,
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
                callback();
            }
        })
    },
}